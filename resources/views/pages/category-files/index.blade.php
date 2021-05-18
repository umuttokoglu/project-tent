@extends('layout.app')

@section('page-title') {{ __('admin/page-title.category-files.table') }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item @if(\App\Constants\UrlSegments::CATEGORY_FILES_SEGMENT === request()->segment(1)) active @endif">
        <a href="{{ route('category-files') }}"> {{ __('admin/page-title.category-files.table') }} </a>
    </li>
@endsection

@section('content')
    <div class="col-lg-12">
        <a href="{{ route('category-file-form') }}"
           class="btn btn-success btn-lg btn-block btn-rounded mb-4 mr-2">{{ __('admin/pages/category_files.add') }}</a>
    </div>
    @if($categoryFiles->isSuccess())
        <div id="tableDropdown" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{ __('admin/page-title.category-files.table') }}
                                <small class="text-muted">{{ __('admin/pages/category_files.show') }}</small>

                                @include('shared.session_error_output')
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                            <tr>
                                <th class="text-center">{{ __('admin/pages/category_files.table.th.action') }}</th>
                                <th class="text-center">{{ __('admin/pages/category_files.table.th.name') }}</th>
                                <th class="text-center">{{ __('admin/pages/category_files.table.th.category') }}</th>
                                <th class="text-center">{{ __('admin/pages/category_files.table.th.file-type') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categoryFiles->getData() as $categoryFile)
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
                                                   href="{{ route('category-file-form', [$categoryFile->id]) }}">{{ __('admin/pages/category_files.edit') }}</a>
                                                <a class="dropdown-item delete-category-file" id="{{ $categoryFile->id }}"
                                                   onsubmit="return false;"
                                                   href="javascript:void(0);">{{ __('admin/pages/category_files.delete') }}</a>
                                                <a class="dropdown-item"
                                                   href="{{ route('category-file-download', [$categoryFile->id]) }}">{{ __('admin/pages/category_files.download') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><b><a class="" href="{{ $categoryFile->path }}" target="_blank">{{ $categoryFile->name }}</a></b></td>
                                    <td class="text-center">{{ $categoryFile->category->name }}</td>
                                    <td class="text-center"> {{ $categoryFile->type }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $categoryFiles->getData()->onEachSide(2)->links('shared.pagination') }}
    @else
        <div id="mediaObjectNotationIcon" class="col-xs-12 col-md-12 col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row text-center">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{ __('admin/pages/category_files.empty')  }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('page-css')
    <link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('assets/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <link href="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('page-js')
    <script>
        let deleteRoute = "{{ route('category-file-delete') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let deleteButton = $('.delete-category-file');

        deleteButton.click(function () {
            let categoryFileId = this.id;
            swal({
                title: 'Emin misiniz?',
                text: "PDF dosyasını kalıcı olarak sileceksiniz. Bu işlemi geri alamazsınız. Daha sonra tekrar yüklemeniz gerecektir.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sil!',
                confirmButtonColor: 'red',
                cancelButtonText: 'İptal et!',
                allowOutsideClick: false,
                padding: '2em',
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: deleteRoute,
                        data: {
                            category_file_id: categoryFileId
                        },
                        beforeSend: function () {
                            swal.fire({
                                type: 'info',
                                html: '<h5>Dosya siliniyor...</h5>',
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function (data) {
                            if (data.success) {
                                swal(
                                    'Dosya silindi!',
                                    'Dosya başarıyla silindi.',
                                    'success'
                                );
                                location.reload();
                            } else {
                                swal(
                                    'Dosya silinemedi!',
                                    'Dosya silinemedi. Tekrar deneyin.',
                                    'warning'
                                );
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script src="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
@endsection
