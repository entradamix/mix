@extends('organizer.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Whatsapp Connect Panel') }}</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('organizer.dashboard') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Whatsapp Connect Management') }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">
                                {{ __('Whatsapp Connect Panel') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (is_null($device))
                                <input type="hidden" name="device_id" value="" />
                                <input type="hidden" name="device_uuid" value="" />
                                <input type="hidden" name="device_status" value="" />
                                <div id="alert-message-device" class="alert alert-info alert-icon">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ __('Not device connected') }}
                                    <button type="button" id="device-create" class="btn btn-primary btn-sm">{{ __('Create device now!') }}</button>
                                </div>
                                <div class="card-content">
                                    <div class="device-qr-content">
                                        <article class="overlay bottom text-center">
                                            <div class="content-qr-create" style="display:none;">
                                                <div class="alert alert-info alert-icon">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </div>
                                                <img src="" class="device-qrcode-img" />
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            @elseif (!is_null($device->uuid))
                                <input type="hidden" name="device_id" value="{{ $device->id }}" />
                                <input type="hidden" name="device_uuid" value="{{ $device->uuid }}" />
                                <input type="hidden" name="device_status" value="{{ $device->status }}" />
                                <div class="card-content">
                                    <div class="card card-event">
                                        <div class="device-info-content">
                                            <div class="device-content">
                                                <span class="title">{{ __('Entrada Mix') }}</span>
                                            </div>
                                            <div class="device-content">
                                                <span class="phone">{{ __('Phone') }}:</span>
                                                <span class="phone">{{ $device->phone }}</span>
                                            </div>
                                            <div class="device-content">
                                                <span class="phone">{{ __('Status') }}:</span>
                                                <span class="phone">{{ $device->status == 0 ? __('Deactive') : __('Active') }}</span>
                                            </div>
                                        </div>
                                        <a href="#" id="{{ $device->status == 1 ? 'btn-deactive' : 'btn-active' }}" class="btn btn-primary btn-sm">
                                            {{ $device->status == 1 ? __('Deactive') : __('Active') }}
                                        </a>
                                    </div>
                                    <div class="device-qr-content">
                                        <article class="overlay bottom text-center">
                                            <div class="content-qr-create" style="display:none;">
                                                <div class="alert alert-info alert-icon">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </div>
                                                <img src="" class="device-qrcode-img" />
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            @elseif (is_null($device->app))
                                <input type="hidden" name="device_id" value="{{ $device->id }}" />
                                <input type="hidden" name="device_uuid" value="{{ $device->uuid }}" />
                                <input type="hidden" name="device_status" value="{{ $device->status }}" />
                                <div class="card-content">
                                    <div class="device-qr-content">
                                        <article class="overlay bottom text-center">
                                            <div class="content-qr-create" style="display:none;">
                                                <div class="alert alert-info alert-icon">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $device->message }}
                                                </div>
                                                <img src="" class="device-qrcode-img" />
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
