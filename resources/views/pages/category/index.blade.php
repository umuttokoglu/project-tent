@extends('layout.app')

@section('page-title') {{ __('admin/page-title.categories.table') }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item @if(\App\Constants\UrlSegments::CATEGORIES_SEGMENT === request()->segment(1)) active @endif">
        <a href="{{ route('categories') }}"> {{ __('admin/page-title.categories.table') }} </a>
    </li>
@endsection

@section('content')
    <div class="col-lg-12">
        <a href="{{ route('category-form') }}"
           class="btn btn-success btn-lg btn-block btn-rounded mb-4 mr-2">{{ __('admin/pages/category.add') }}</a>
    </div>
    @if($categories->isSuccess())
        <div id="tableDropdown" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{ __('admin/page-title.categories.table') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                            <tr>
                                <th class="text-center">{{ __('admin/pages/category.table.th.action') }}</th>
                                <th class="text-center">{{ __('admin/pages/category.table.th.logo') }}</th>
                                <th>{{ __('admin/pages/category.table.th.name') }}</th>
                                <th class="text-center">{{ __('admin/pages/category.table.th.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories->getData() as $category)
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
                                                   href="{{ route('category-form', [$category->id]) }}">{{ __('admin/pages/category.edit') }}</a>
                                                <a class="dropdown-item delete-category" id="{{ $category->id }}"
                                                   onsubmit="return false;"
                                                   href="javascript:void(0);">{{ __('admin/pages/category.delete') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><img src="{{ $category->img_url }}"
                                                                 alt="{{ $category->name }}" width="75"></td>
                                    <td><b>{{ $category->name }}</b></td>
                                    <td class="text-center">
                                        @if($category->status)
                                            <span
                                                class="badge badge-success">{{ __('admin/pages/category.status.approved') }}</span>
                                        @else
                                            <span
                                                class="badge badge-danger">{{ __('admin/pages/category.status.unapproved') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $categories->getData()->onEachSide(2)->links('shared.pagination') }}
    @else
        <div id="mediaObjectNotationIcon" class="col-xs-12 col-md-12 col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row text-center">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{ __('admin/pages/category.empty')  }}</h4>
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
        let deleteRoute = "{{ route('category-delete') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let deleteButton = $('.delete-category');

        deleteButton.click(function () {
            let categoryId = this.id;
            swal({
                title: 'Emin misiniz?',
                text: "Kategoriyi kalıcı olarak sileceksiniz. Bu işlemi geri alamazsınız. Sadece pasif hale getirmek istiyorsanız, düzenleme ekranını kullanınız.",
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
                            id: categoryId
                        },
                        beforeSend: function () {
                            swal.fire({
                                html: '<h5>Kategori siliniyor...</h5>',
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function (data) {
                            if (data.isSuccess) {
                                swal(
                                    'Kategori silindi!',
                                    'Kategori başarıyla silindi.',
                                    'success'
                                );
                                location.reload();
                            } else {
                                swal(
                                    'Kategori silinemedi!',
                                    'Kategori silinemedi. Tekrar deneyin.',
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
