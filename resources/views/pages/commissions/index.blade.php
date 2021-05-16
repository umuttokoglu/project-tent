@extends('admin.layout.app')

@section('page-title') {{ __('page-title.commissions.list') }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item @if(\App\Http\Constants\UrlSegment::COMMISSIONS_SEGMENT_NAME === request()->segment(2)) active @endif">
        <a href="{{ route('commissions') }}"> {{ __('page-title.commissions.list') }} </a>
    </li>
@endsection

@section('content')
    <div class="col-lg-12">
        <a href="{{ route('commission-form') }}"
           class="btn btn-success btn-lg btn-block btn-rounded mb-4 mr-2">{{ __('commissions-page.add') }}</a>
    </div>
    @if($commissions->isSuccess())
        <div id="tableDropdown" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{ __('page-title.commissions.list') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                            <tr>
                                <th class="text-center">{{ __('commissions-page.table.th.action') }}</th>
                                <th class="text-center">{{ __('commissions-page.table.th.logo') }}</th>
                                <th>{{ __('commissions-page.table.th.name') }}</th>
                                <th class="text-center">{{ __('commissions-page.table.th.status') }}</th>
                                <th>{{ __('commissions-page.table.th.name_eng') }}</th>
                                <th>{{ __('commissions-page.table.th.details') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commissions->getData() as $commission)
                                <tr>
                                    <td class="text-center">
                                        <div class="dropdown custom-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <a class="dropdown-item"
                                                   href="{{ route('commission-form', [$commission->uuid]) }}">{{ __('commissions-page.edit') }}</a>
                                                <a class="dropdown-item delete-commission" id="{{ $commission->uuid }}" onsubmit="return false;"
                                                   href="javascript:void(0);">{{ __('commissions-page.delete') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"> @if(null !== $commission->logo_url) <img
                                            src="{{ config('app.url') . \App\Http\Constants\ImagePath::COMMISSIONS_LOGOS . $commission->logo_url }}"
                                            alt="{{ $commission->name }}"
                                            width="50"> @else {{ __('commissions-page.table.tr.empty') }} @endif</td>
                                    <td>{{ $commission->name }}</td>
                                    <td class="text-center">
                                        @if($commission->status)
                                            <span
                                                class="badge badge-success">{{ __('commissions-page.status.approved') }}</span>
                                        @else
                                            <span
                                                class="badge badge-danger">{{ __('commissions-page.status.unapproved') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ null !== $commission->name_eng ? $commission->name_eng  : __('commissions-page.table.tr.empty') }}</td>
                                    <td>{{ null !== $commission->details ? Illuminate\Mail\Markdown::parse(\App\Http\Helpers\GlobalHelpers::stringLimiter($commission->details, 50)) : __('commissions-page.table.tr.empty') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div id="mediaObjectNotationIcon" class="col-xs-12 col-md-12 col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row text-center">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{ __('commissions-page.empty')  }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('page-css')
    <link href="{{ asset('assets/admin/assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('assets/admin/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <link href="{{ asset('assets/admin/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-js')
    <script>
        let deleteRoute = "{{ route('delete-commission') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let deleteButton = $('.delete-commission');

        deleteButton.click(function () {
            let uuidFromElement = this.id;
            swal({
                title: 'Emin misiniz?',
                text: "Komisyonu kalıcı olarak sileceksiniz. Bu işlemi geri alamazsınız.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sil!',
                confirmButtonColor: 'red',
                cancelButtonText: 'İptal et!',
                allowOutsideClick: false,
                padding: '2em',
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type:'POST',
                        url: deleteRoute,
                        data: {
                            uuid:uuidFromElement
                        },
                        beforeSend: function () {
                            swal.fire({
                                html: '<h5>Komisyon siliniyor...</h5>',
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.isSuccess) {
                                swal(
                                    'Komisyon silindi!',
                                    'Komisyon başarıyla silindi.',
                                    'success'
                                );
                                location.reload();
                            } else {
                                swal(
                                    'Komisyon silinemedi!',
                                    'Komisyon silinemedi. Tekrar deneyin.',
                                    'warning'
                                );
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script src="{{ asset('assets/admin/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
@endsection


