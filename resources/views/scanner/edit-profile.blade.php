@extends('scanner.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Edit Profile') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{ route('scanner.dashboard') }}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Edit Profile') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title">{{ __('Edit Profile') }}</div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row ">
            <div class="col-lg-8 mx-auto">
              <div class="alert alert-danger pb-1 dis-none" id="eventErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>

              <form id="eventForm" action="{{ route('scanner.update_profile') }}" method="POST"
                enctype="multipart/form-data">
                @csrf


                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">{{ __('Photo') . '*' }}</label>
                      <br>
                      <div class="thumb-preview">
                        @if (Auth::guard('scanner')->user()->photo != null)
                          <img
                            src="{{ asset('assets/admin/img/scanner-photo/' . Auth::guard('scanner')->user()->photo) }}"
                            alt="..." class="uploaded-img">
                        @else
                          <img src="{{ asset('assets/admin/img/noimage.jpg') }}" alt="..." class="uploaded-img">
                        @endif

                      </div>

                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          {{ __('Choose Photo') }}
                          <input type="file" class="img-input" id="img-input" name="photo">
                        </div>
                        @if ($errors->has('photo'))
                          <p class="mt-2 mb-0 text-danger">{{ $errors->first('photo') }}</p>
                        @endif
                        <p class="mt-1 mb-0 text-warning em">{{ __('Image Size 300x300') }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">{{ __('Photo') . '*' }}</label>
                      <br>
                      <div class="thumb-preview">
                        @if (Auth::guard('scanner')->user()->cover != null)
                          <img
                            src="{{ asset('assets/admin/img/scanner-cover/' . Auth::guard('scanner')->user()->cover) }}"
                            alt="..." class="uploaded-img-cover">
                        @else
                          <img src="{{ asset('assets/admin/img/noimage.jpg') }}" alt="..." class="uploaded-img-cover">
                        @endif
                      </div>

                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          {{ __('Choose Cover Photo') }}
                          <input type="file" class="img-input-cover" name="cover">
                        </div>
                        @if ($errors->has('cover'))
                          <p class="mt-2 mb-0 text-danger">{{ $errors->first('cover') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>{{ __('Email') . '*' }}</label>
                      <input type="email" class="form-control" name="email"
                        value="{{ Auth::guard('scanner')->user()->email }}">
                      @if ($errors->has('email'))
                        <p class="mt-2 mb-0 text-danger">{{ $errors->first('email') }}</p>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>{{ __('Phone') }}</label>
                      <input type="tel" class="form-control" name="phone"
                        value="{{ Auth::guard('scanner')->user()->phone }}">
                      @if ($errors->has('phone'))
                        <p class="mt-2 mb-0 text-danger">{{ $errors->first('phone') }}</p>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>{{ __('Username') . '*' }}</label>
                      <input type="text" class="form-control" name="username"
                        value="{{ Auth::guard('scanner')->user()->username }}">
                      @if ($errors->has('username'))
                        <p class="mt-2 mb-0 text-danger">{{ $errors->first('username') }}</p>
                      @endif
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>{{ __('Facebook') }}</label>
                      <input type="text" class="form-control" name="facebook"
                        value="{{ Auth::guard('scanner')->user()->facebook }}">
                      @if ($errors->has('facebook'))
                        <p class="mt-2 mb-0 text-danger">{{ $errors->first('facebook') }}</p>
                      @endif
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>{{ __('Twitter') }}</label>
                      <input type="text" class="form-control" name="twitter"
                        value="{{ Auth::guard('scanner')->user()->twitter }}">
                      @if ($errors->has('twitter'))
                        <p class="mt-2 mb-0 text-danger">{{ $errors->first('twitter') }}</p>
                      @endif
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>{{ __('Linkedin') }}</label>
                      <input type="text" class="form-control" name="linkedin"
                        value="{{ Auth::guard('scanner')->user()->linkedin }}">
                      @if ($errors->has('linkedin'))
                        <p class="mt-2 mb-0 text-danger">{{ $errors->first('linkedin') }}</p>
                      @endif
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div id="accordion" class="mt-3">
                      @foreach ($languages as $language)
                        <div class="version">
                          <div class="version-header" id="heading{{ $language->id }}">
                            <h5 class="mb-0">
                              <button type="button" class="btn btn-link" data-toggle="collapse"
                                data-target="#collapse{{ $language->id }}"
                                aria-expanded="{{ $language->is_default == 1 ? 'true' : 'false' }}"
                                aria-controls="collapse{{ $language->id }}">
                                {{ $language->name . __(' Language') }}
                                {{ $language->is_default == 1 ? '('.__('Default').')' : '' }}
                              </button>
                            </h5>
                          </div>

                          @php
                            $scanner_info = App\Models\ScannerInfo::where('scanner_id', Auth::guard('scanner')->user()->id)
                                ->where('language_id', $language->id)
                                ->first();
                          @endphp

                          <div id="collapse{{ $language->id }}"
                            class="collapse {{ $language->is_default == 1 ? 'show' : '' }}"
                            aria-labelledby="heading{{ $language->id }}" data-parent="#accordion">
                            <div class="version-body">
                              <div class="row">
                                <div class="col-lg-4">
                                  <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                    <label>{{ __('Name') . '*' }}</label>
                                    <input type="text" class="form-control" name="{{ $language->code }}_name"
                                      placeholder="Enter Your Full Name"
                                      value="{{ $scanner_info ? $scanner_info->name : '' }}">
                                    @if ($errors->has("$language->code" . '_name'))
                                      <p class="mt-2 mb-0 text-danger">
                                        {{ $errors->first("$language->code" . '_name') }}</p>
                                    @endif
                                  </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                    <label>{{ __('Designation') }}</label>
                                    <input type="text" class="form-control"
                                      name="{{ $language->code }}_designation"
                                      value="{{ $scanner_info ? $scanner_info->designation : '' }}">

                                  </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                    <label>{{ __('Country') }}</label>
                                    <input type="text" class="form-control" name="{{ $language->code }}_country"
                                      value="{{ $scanner_info ? $scanner_info->country : '' }}">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                    <label>{{ __('City') }}</label>
                                    <input type="text" class="form-control" name="{{ $language->code }}_city"
                                      value="{{ $scanner_info ? $scanner_info->city : '' }}">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                    <label>{{ __('State') }}</label>
                                    <input type="text" class="form-control" name="{{ $language->code }}_state"
                                      value="{{ $scanner_info ? $scanner_info->state : '' }}">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                    <label>{{ __('Zip Code') }}</label>
                                    <input type="text" class="form-control" name="{{ $language->code }}_zip_code"
                                      value="{{ $scanner_info ? $scanner_info->zip_code : '' }}">
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                    <label>{{ __('Address') }}</label>
                                    <textarea name="{{ $language->code }}_address" class="form-control">{{ $scanner_info ? $scanner_info->address : '' }}</textarea>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                    <label>{{ __('Details') }}</label>
                                    <textarea name="{{ $language->code }}_details" rows="5" class="form-control">{{ $scanner_info ? $scanner_info->details : '' }}</textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  @php $currLang = $language; @endphp

                                  @foreach ($languages as $language)
                                    @continue($language->id == $currLang->id)

                                    <div class="form-check py-0">
                                      <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"
                                          onchange="cloneInput('collapse{{ $currLang->id }}', 'collapse{{ $language->id }}', event)">
                                        <span class="form-check-sign">{{ __('Clone for') }} <strong
                                            class="text-capitalize text-secondary">{{ $language->name }}</strong>
                                          {{ __('language') }}</span>
                                      </label>
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="EventSubmit" class="btn btn-success">
                {{ __('Update') }}
              </button>
            </div>
          </div>
        </div>
        <div class="modal fade" id="cropModal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cropModalLabel">Recorte de Imagem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div class="image-container">
                            <!--<img id="cropperImage" src="" alt="Cortar"-->
                            <!--    style="max-width: 100%;">-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="" class="btn btn-secondary">
                            Fechar
                        </a>
                        <button type="button" class="btn btn-primary"
                            id="saveCroppedImage">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
