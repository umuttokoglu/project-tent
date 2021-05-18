@extends('layout.app')

@section('page-title') @if(null !== $categoryFile->getData()) {{ __('admin/page-title.category-files.update') }} @else {{ __('admin/page-title.category-files.store') }} @endif @endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('categories') }}"> {{ __('admin/page-title.category-files.table') }} </a>
    </li>
    <li class="breadcrumb-item @if(\App\Constants\UrlSegments::CATEGORY_FILES_SEGMENT === request()->segment(1)) active @endif">
        @if(null !== $categoryFile->getData())
            <a href="{{ route('category-file-form', [$categoryFile->getData()->id]) }}"> {{ __('admin/page-title.category-files.update') }} </a>
        @else
            <a href="{{ route('category-file-form') }}"> {{ __('admin/page-title.category-files.store') }} </a>
        @endif
    </li>
@endsection

@section('content')
    <div id="tooltips" class="col-lg-12 layout-spacing col-md-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> @if(null !== $categoryFile->getData()) {{ __('admin/page-title.category-files.update') }} @else {{ __('admin/page-title.category-files.store') }} @endif <small
                                class="text-muted">{{ __('admin/page-title.required') }}</small></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('category-file-store-or-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="category_file_id" value="{{ (null !== $categoryFile->getData()) ? $categoryFile->getData()->id : '' }}">
                    <div class="form-row">
                        <div class="col-md-6 mb-5">
                            <label for="category_file_name">Dosya adı*</label>
                            <input type="text" class="form-control" name="category_file_name" id="category_file_name"
                                   placeholder="Dosya adı*" value="{{ (null !== $categoryFile->getData()) ? $categoryFile->getData()->name : old('category_file_name') }}" required>
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="category_file_category_id">Dosyanın görüntüleneceği kategori* <small> - Sadece aktif kategoriler görüntülenir</small></label>
                            <select id="category_file_category_id" name="category_file_category_id" class="category-select js-states form-control" required>
                                <option></option>
                                @forelse($categoryFile->getAdditionalData() as $category)
                                    <option value="{{ $category['id'] }}"
                                            @if(null !== $categoryFile->getData() && $category['id'] === $categoryFile->getData()->category_id) selected @endif>
                                        {{ $category['name'] }}
                                    </option>
                                @empty
                                    <option>İlk önce kategori ekleyiniz</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 custom-file-container mb-5" data-upload-id="category_file">
                            <label>
                                PDF dosyası*
                                <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Başka bir dosya yükle">x</a>
                            </label>
                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input form-control"
                                       name="category_file" accept="application/pdf">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
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
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-js')
    <script src="{{ asset('assets/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script>
        //First upload
        const firstUpload = new FileUploadWithPreview('category_file')
        $(".category-select").select2({
            placeholder: "Seçim yapınız...",
            allowClear: true
        });
    </script>
@endsection
