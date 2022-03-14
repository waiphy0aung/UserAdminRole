@extends('layouts.app')

@section("title") Edit Profile @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile/'.Auth::user()->photo) : asset('dashboard/img/user-default-photo.png') }}" class="w-50 rounded-circle my-3" alt="">
                        <h3 class="mb-0 font-weight-bold">
                            {{ Auth::user()->name }}
                        </h3>
                        <small class="text-black-50">
                            {{ Auth::user()->email }}
                        </small>
                    </div>
                    <hr>
                    <div class="">
                        <h6 class="font-weight-bold">
                            <i class="feather-phone"></i> -
                            {{ Auth::user()->phone }}
                        </h6>
                        <h6 class="font-weight-bold">
                            <i class="feather-map-pin"></i> -
                            {{ Auth::user()->address }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
