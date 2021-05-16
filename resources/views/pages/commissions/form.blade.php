@extends('admin.layout.app')

@section('page-title') @if(null !== $commission->getData()) {{ __('page-title.commissions.form-edit') }} @else {{ __('page-title.commissions.form-new') }} @endif @endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('commissions') }}"> {{ __('page-title.commissions.list') }} </a>
    </li>
    <li class="breadcrumb-item @if(\App\Http\Constants\UrlSegment::COMMISSIONS_SEGMENT_NAME === request()->segment(2)) active @endif">
        @if(null !== $commission->getData())
            <a href="{{ route('commission-form', [$commission->getData()->uuid]) }}"> {{ __('page-title.commissions.form-edit') }} </a>
        @else
            <a href="{{ route('commission-form') }}"> {{ __('page-title.commissions.form-new') }} </a>
        @endif
    </li>
@endsection

@section('content')
    <div id="tooltips" class="col-lg-12 layout-spacing col-md-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> @if(null !== $commission->getData()) {{ __('commission-form.title.edit') }} @else {{ __('commission-form.title.add') }} @endif <small
                                class="text-muted">{{ __('commission-form.title.required') }}</small></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form class="needs-validation"
                      action="{{ (null !== $commission->getData()) ? route('update-commission', [$commission->getData()->uuid]) : route('commission-store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-5">
                            <label for="commission_name">Komisyon adı*</label>
                            <input type="text" class="form-control" name="commission_name" id="commission_name"
                                   placeholder="Komisyon adı*" value="{{ (null !== $commission->getData()) ? $commission->getData()->name : old('commission_name') }}" aria-describedby="commissionNameHelp">
                            <small id="commissionNameHelp" class="form-text text-muted"> Komisyon adını girebilirsiniz.
                                Herkese gösterilecek komisyon adıdır. </small>
                            @error('commission_name')
                            <div class="text-left mt-2">
                                <span class="badge badge-danger p-2">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="commission_eng_name">Komisyon İngilizce adı</label>
                            <input type="text" class="form-control" name="commission_eng_name" id="commission_eng_name"
                                   placeholder="Komisyon İngilizce adı" value="{{ (null !== $commission->getData()) ? $commission->getData()->name_eng : old('commission_eng_name') }}" aria-describedby="commissionEngNameHelp">
                            <small id="commissionEngNameHelp" class="form-text text-muted"> Komisyonun İngilizce adını girebilirsiniz.
                                İsterseniz ikinci bir dil siteye eklendiğinde gösterilmesi için komisyonun İngilizce adını belirleyebilirsiniz. </small>
                            @error('commission_eng_name')
                            <div class="text-left mt-2">
                                <span class="badge badge-danger p-2">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="custom-file-container {{ (null !== $commission->getData()) ? (null !== $commission->getData()->logo_url) ? 'col-md-4': 'col-md-6' : 'col-md-6' }} mb-5" data-upload-id="commission_logo_url">
                            <label>Komisyon logosu <a href="javascript:void(0)"
                                                      class="custom-file-container__image-clear"
                                                      title="Başka afiş yükle">x</a></label>
                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input form-control"
                                       name="commission_logo_url" accept="image/*" aria-describedby="commissionLogoHelp">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                <small id="commissionLogoHelp" class="form-text text-muted"> Komisyon logosu ekleyebilirsiniz. </small>
                            </label>
                            @error('commission_logo_url')
                            <div class="text-left mt-2">
                                <span class="badge badge-danger p-2">{{ $message }}</span>
                            </div>
                            @enderror
                            <div class="custom-file-container__image-preview"></div>
                        </div>

                        @if(null !== $commission->getData())
                            @if(null !== $commission->getData()->logo_url)
                                <div class="col-md-2">
                                    <label class="mb-1">Güncel Logo</label>
                                    <img src="{{ config('app.url') . \App\Http\Constants\ImagePath::COMMISSIONS_LOGOS . $commission->getData()->logo_url }}" alt="{{ $commission->getData()->name }}" width="100">
                                </div>
                            @endif
                        @endif

                        <div class="col-md-6 mb-5">
                            <label for="commission_details">Komisyon detayları*</label>
                            <textarea class="form-control"
                                      id="commission_details"
                                      name="commission_details"
                                      aria-describedby="commissionDetailsHelp"
                            >{{ (null !== $commission->getData()) ? $commission->getData()->details : old('commission_details') }}</textarea>
                            <small id="commissionDetailsHelp" class="form-text text-muted"> Komisyonu tanıtmak için
                                detayları belirtmelisiniz. Etkinlik detay sayfasınd gösterilecektir. </small>
                            @error('commission_details')
                                <div class="text-left mt-2">
                                    <span class="badge badge-danger p-2">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-5">
                            <div class="col-md-12">
                                <label for="event_name">Yaptığınız işlemleri onaylıyor musunuz?*</label>
                            </div>

                            <div class="col-md-7">
                                <label class="switch s-outline s-outline-success mr-4">
                                    <input value="checked" name="is_active"
                                           @if (null !== $commission->getData() && $commission->getData()->status)
                                               checked
                                           @else
                                               @if ('checked' === old('is_active')) checked @endif
                                           @endif type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                                <small id="commissionNameHelp" class="form-text text-muted"> Komisyonun aktif olarak gözükmesini onaylayıp onaylamadığınızı buradan belirtibelirsiniz. Seçim yapmazsanız onaylanmamış olarak kaydedilecektir. Daha sonra düzenleyip
                                    değişiklikleri onaylayabilir ve komisyonun gösterilebilmesini sağlayailirsiniz! </small>
                                @error('is_active')
                                <div class="text-left mt-2">
                                    <span class="badge badge-danger p-2">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-block btn-primary mt-2"
                            type="submit">{{ __('commission-form.button.save') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
    <link href="{{ asset('assets/admin/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/editors/markdown/simplemde.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/assets/css/forms/switches.css') }}">
@endsection

@section('page-js')
    <script src="{{ asset('assets/admin/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/editors/markdown/simplemde.min.js') }}"></script>
    <script>
        //First upload
        const firstUpload = new FileUploadWithPreview('commission_logo_url')
        new SimpleMDE({
            element: document.getElementById("commission_details"),
            spellChecker: false,
        });
    </script>
@endsection
