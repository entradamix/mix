@extends('frontend.layout')
@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->organizer_page_title ?? __('Organizer') }}
  @else
    {{ __('Organizer') }}
  @endif
@endsection
@php
  $metaKeywords = !empty($seo->meta_keyword_organizer) ? $seo->meta_keyword_organizer : '';
  $metaDescription = !empty($seo->meta_description_organizer) ? $seo->meta_description_organizer : '';
@endphp
@section('meta-keywords', "{{ $metaKeywords }}")
@section('meta-description', "$metaDescription")


@php
  $now_time = \Carbon\Carbon::now();
  $events_caroussel = DB::table('event_contents')
      ->join('events', 'events.id', '=', 'event_contents.event_id')
      ->join('event_images', 'event_images.event_id', '=', 'event_contents.event_id')
      ->where([['event_contents.language_id', '=', $currentLanguageInfo->id], ['events.status', 1], ['events.end_date_time', '>=', $now_time], ['events.is_featured', '!=', 'no']])
      ->orderBy('events.created_at', 'desc')
      ->get();
@endphp

@if(!$events_caroussel)
  @section('hero-section')
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy" data-bg="{{ asset('assets/admin/img/' . $basicInfo->breadcrumb) }}">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          @if (!empty($pageHeading))
            {{ $pageHeading->organizer_page_title ?? __('Organizer') }}
          @else
            {{ __('Organizer') }}
          @endif
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">
              @if (!empty($pageHeading))
                {{ $pageHeading->organizer_page_title ?? __('Organizer') }}
              @else
                {{ __('Organizer') }}
              @endif
            </li>
          </ol>
        </nav>
        <div class="authors-search-filter mt-30">
          <form {{ route('frontend.all.organizer') }}>
            <div class="search-filter-form">
              <div class="row no-gutters justify-content-center">
                <div class="search-item">
                  <input type="text" class="form_control" name="organizer"
                    placeholder="{{ __('Enter Organizar Name') }}" value="{{ request()->input('organizer') }}">
                </div>

                <div class="search-item">
                  <input type="text" class="form_control" placeholder="{{ __('Enter Username') }}" name="username"
                    value="{{ request()->input('username') }}" />
                </div>
                <div class="search-item">
                  <input type="text" class="form_control" name="location" placeholder="{{ __('Enter Location') }}"
                    value="{{ request()->input('location') }}" />
                </div>

                <div class="search-item">
                  <button type="submit" class="theme-btn rounded-0">{{ __('Search') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
  @endsection
@else
    @section('hero-section')
        <section class="hero-section">
            <div class="owl-carousel owl-theme mt-3" id="owl-carousel-destaque">
                @foreach ($events_caroussel as $event)
                    <div class="item">
                        <a href="{{ route('event.details', [$event->slug, $event->id]) }}">
                          <img class="d-block w-100 radius" src="{{ asset('assets/admin/img/event-gallery/' . $event->image) }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <div class="container">
          <div class="hero-content">
              <form {{ route('frontend.all.organizer') }}>
                <div class="search-filter-form">
                  <div class="row no-gutters justify-content-center">
                    <div class="search-item">
                      <input type="text" class="form_control" name="organizer"
                        placeholder="{{ __('Enter Organizar Name') }}" value="{{ request()->input('organizer') }}">
                    </div>
    
                    <div class="search-item">
                      <input type="text" class="form_control" placeholder="{{ __('Enter Username') }}" name="username"
                        value="{{ request()->input('username') }}" />
                    </div>
                    <div class="search-item">
                      <input type="text" class="form_control" name="location" placeholder="{{ __('Enter Location') }}"
                        value="{{ request()->input('location') }}" />
                    </div>
    
                    <div class="search-item">
                      <button type="submit" class="theme-btn rounded-0">{{ __('Search') }}</button>
                    </div>
                  </div>
                </div>
              </form>
          </div>
        </div>
    @endsection
@endif
@section('content')

  <!-- Author-single-area start -->
  <div class="author-area py-120 rpy-100 bg-lighter">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="product-filter">
            <div class="row justify-content-between align-items-center">
              <div class="col-lg-3 col-md-4">
                <h6 class="mb-20">{{ __('Total organizer showing') }}: {{ count($collection) }}</h6>
              </div>
            </div>
          </div>
          <div class="row">
            @foreach ($collection as $item)
              <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card card-center p-2 mb-30">
                  <div class="card-cover lazy" data-bg="{{  $item->cover != null ? asset('assets/admin/img/organizer-cover/' . $item->cover) : asset('assets/front/images/user.png') }}" style="background-size: cover;"></div>
                  <figure class="card-img mb-1">
                    <a href="{{ route('frontend.organizer.details', [$item->id, str_replace(' ', '-', $item->username)]) }}"
                      target="_self" title="kreativDev">
                      @if ($item->photo == null)
                        <img class="rounded-lg lazy" data-src="{{ asset('assets/front/images/user.png') }}" alt="image">
                      @else
                        <img class="rounded-lg lazy" data-src="{{ asset('assets/admin/img/organizer-photo/' . $item->photo) }}"
                          alt="image">
                      @endif
                    </a>
                  </figure>
                  <div class="card-content mt-35">
                    <h5 class="card-title mb-1"><a
                        href="{{ route('frontend.organizer.details', [$item->id, str_replace(' ', '-', $item->username)]) }}">{{ @$item->organizer_info->name }}</a>
                    </h5>
                    <div>
                      <span class="text-muted mb-1"><a
                        href="{{ route('frontend.organizer.details', [$item->id, str_replace(' ', '-', $item->username)]) }}">{{ $item->username }}</a>
                      </span>
                    </div>
                    <div class="mb-15 font-sm">
                      <span>{{ OrganizerEventCount($item->id) }}
                        {{ OrganizerEventCount($item->id) > 1 ? __('Events') : __('Event') }}</span>
                    </div>
                    <a href="{{ route('frontend.organizer.details', [$item->id, str_replace(' ', '-', $item->username)]) }}"
                      target="_self" title="{{ $item->username }}" class="btn-text"> {{ __('View Profile') }} </a>
                  </div>
                </div>
              </div>
            @endforeach


          </div>
          {{ $collection->links() }}

          @if (!empty(showAd(3)))
            <div class="text-center mt-4">
              {!! showAd(3) !!}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- Author-single-area start -->
@endsection
