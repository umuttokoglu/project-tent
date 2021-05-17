@extends('layout.app')

@section('page-title') @if(null !== $category->getData()) {{ __('admin/page-title.categories.update') }} @else {{ __('admin/page-title.categories.store') }} @endif @endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('categories') }}"> {{ __('admin/page-title.categories.table') }} </a>
    </li>
    <li class="breadcrumb-item @if(\App\Constants\UrlSegments::CATEGORIES_SEGMENT === request()->segment(1)) active @endif">
        @if(null !== $category->getData())
            <a href="{{ route('category-form', [$category->getData()->id]) }}"> {{ __('admin/page-title.categories.update') }} </a>
        @else
            <a href="{{ route('category-form') }}"> {{ __('admin/page-title.categories.store') }} </a>
        @endif
    </li>
@endsection

@section('content')
    <div id="tooltips" class="col-lg-12 layout-spacing col-md-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> @if(null !== $category->getData()) {{ __('admin/page-title.categories.update') }} @else {{ __('admin/page-title.categories.store') }} @endif <small
                                class="text-muted">{{ __('admin/page-title.required') }}</small></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('category-store-or-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ (null !== $category->getData()) ? $category->getData()->id : '' }}">
                    <div class="form-row">
                        <div class="col-md-6 mb-5">
                            <label for="category_name_tr">Kategori adı*</label>
                            <input type="text" class="form-control" name="category_name_tr" id="category_name_tr"
                                   placeholder="Kategori adı*" value="{{ (null !== $category->getData()) ? $category->getData()->name : old('category_name_tr') }}" required>
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="category_name_en">Kategori adı (İngilizce)</label>
                            <input type="text" class="form-control" name="category_name_en" id="category_name_en"
                                   placeholder="Kategori adı (İngilizce)" value="{{ (null !== $category->getData()) ? $category->getData()->name_en : old('category_name_en') }}">
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="category_detail_tr">Kategori açıklaması*</label>
                            <input type="text" class="form-control" name="category_detail_tr" id="category_detail_tr"
                                   placeholder="Kategori açıklaması*" value="{{ (null !== $category->getData()) ? $category->getData()->description : old('category_detail_tr') }}">
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="category_detail_en">Kategori açıklaması (İngilizce)</label>
                            <input type="text" class="form-control" name="category_detail_en" id="category_detail_en"
                                   placeholder="Kategori açıklaması (İngilizce)" value="{{ (null !== $category->getData()) ? $category->getData()->description_en : old('category_detail_en') }}">
                        </div>

                        <div class="custom-file-container mb-5 {{ (null !== $category->getData()) ? (null !== $category->getData()->img_url) ? 'col-md-8': 'col-md-12' : 'col-md-12' }}"
                             data-upload-id="category_img">
                            <label>Kategori ana görsel* <a href="javascript:void(0)"
                                                      class="custom-file-container__image-clear"
                                                      title="Başka bir ana görsel yükle">x</a></label>
                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input form-control"
                                       name="category_img" accept="image/*">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>

                        @if(null !== $category->getData())
                            @if(null !== $category->getData()->img_url)
                                <div class="col-md-4">
                                    <label class="mb-1">Güncel ana görsel</label>
                                    <br>
                                    <img class="img-fluid" src="{{$category->getData()->img_url}}" alt="{{ $category->getData()->name}}" />
                                </div>
                            @endif
                        @endif

                        <div class="col-md-12 mb-5">
                            <div class="col-md-12">
                                <label for="event_name">Kategori durumu</label>
                            </div>

                            <div class="col-md-7">
                                <label class="switch s-outline s-outline-success mr-4">
                                    <input value="checked" name="is_active"
                                           @if (null !== $category->getData() && $category->getData()->status)
                                           checked
                                           @else
                                           @if ('checked' === old('is_active')) checked @endif
                                           @endif type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-block btn-primary mt-2" type="submit">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
    <link href="{{ asset('assets/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/editors/markdown/simplemde.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">
@endsection

@section('page-js')
    <script src="{{ asset('assets/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/editors/markdown/simplemde.min.js') }}"></script>
    <script>
        //First upload
        const firstUpload = new FileUploadWithPreview('category_img')
        new SimpleMDE({
            element: document.getElementById("category_detail_tr"),
            spellChecker: false,
        });
        new SimpleMDE({
            element: document.getElementById("category_detail_en"),
            spellChecker: false,
        });
    </script>
@endsection
