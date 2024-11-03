@extends('organizer.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Registered Promoters') }}</h4>
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
        <a href="#">{{ __('Promoters Management') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Registered Promoters') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title">{{ __('All Promoters') }}</div>
            </div>

            <div class="col-lg-6 offset-lg-2">
              <button class="btn btn-danger btn-sm float-right d-none bulk-delete mr-2 ml-3 mt-1"
                data-href="{{ route('organizer.promoter_management.bulk_delete_promoter') }}">
                <i class="flaticon-interface-5"></i> {{ __('Delete') }}
              </button>

              <form class="float-right" action="{{ route('organizer.promoter_management.registered_promoter') }}"
                method="GET">
                <input name="info" type="text" class="form-control min-230"
                  placeholder="Search By Username or Email ID"
                  value="{{ !empty(request()->input('info')) ? request()->input('info') : '' }}">
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($promoters) == 0)
                <h3 class="text-center">{{ __('NO SCANNER FOUND') . '!' }}</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">{{ __('Username') }}</th>
                        <th scope="col">{{ __('Email ID') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Account Status') }}</th>
                        <th scope="col">{{ __('Email Status') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($promoters as $promoter)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{ $promoter->id }}">
                          </td>
                          <td>{{ $promoter->username }}</td>
                          <td>{{ $promoter->email }}</td>
                          <td>{{ empty($promoter->phone) ? '-' : $promoter->phone }}</td>
                          <td>
                            <form id="accountStatusForm-{{ $promoter->id }}" class="d-inline-block"
                              action="{{ route('organizer.promoter_management.promoter.update_account_status', ['id' => $promoter->id]) }}"
                              method="post">
                              @csrf
                              <select
                                class="form-control form-control-sm {{ $promoter->status == 1 ? 'bg-success' : 'bg-danger' }}"
                                name="account_status"
                                onchange="document.getElementById('accountStatusForm-{{ $promoter->id }}').submit()">
                                <option value="1" {{ $promoter->status == 1 ? 'selected' : '' }}>
                                  {{ __('Active') }}
                                </option>
                                <option value="0" {{ $promoter->status == 0 ? 'selected' : '' }}>
                                  {{ __('Deactive') }}
                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <form id="emailStatusForm-{{ $promoter->id }}" class="d-inline-block"
                              action="{{ route('organizer.promoter_management.promoter.update_email_status', ['id' => $promoter->id]) }}"
                              method="post">
                              @csrf
                              <select
                                class="form-control form-control-sm {{ !is_null($promoter->email_verified_at) ? 'bg-success' : 'bg-danger' }}"
                                name="email_status"
                                onchange="document.getElementById('emailStatusForm-{{ $promoter->id }}').submit()">
                                <option value="1" {{ !is_null($promoter->email_verified_at) ? 'selected' : '' }}>
                                  {{ __('Verified') }}
                                </option>
                                <option value="0" {{ is_null($promoter->email_verified_at) ? 'selected' : '' }}>
                                  {{ __('Not Verified') }}
                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Select') }}
                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="{{ route('organizer.promoter_management.promoter_details', ['id' => $promoter->id, 'language' => $defaultLang->code]) }}"
                                  class="dropdown-item">
                                  {{ __('Details') }}
                                </a>

                                <a href="{{ route('organizer.edit_management.promoter_edit', ['id' => $promoter->id]) }}"
                                  class="dropdown-item">
                                  {{ __('Edit') }}
                                </a>

                                <a href="{{ route('organizer.promoter_management.promoter.change_password', ['id' => $promoter->id]) }}"
                                  class="dropdown-item">
                                  {{ __('Change Password') }}
                                </a>

                                <form class="deleteForm d-block"
                                  action="{{ route('organizer.promoter_management.promoter.delete', ['id' => $promoter->id]) }}"
                                  method="post">
                                  @csrf
                                  <button type="submit" class="deleteBtn">
                                    {{ __('Delete') }}
                                  </button>
                                </form>

                                <a target="_blank"
                                  href="{{ route('organizer.promoter_management.promoter.secret_login', ['id' => $promoter->id]) }}"
                                  class="dropdown-item">
                                  {{ __('Secret Login') }}
                                </a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="card-footer text-center">
          <div class="d-inline-block mt-3">
            {{ $promoters->appends(['info' => request()->input('info')])->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
