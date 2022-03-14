@extends('layouts.app')

@section("title") frame @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Name & Email</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('foot')

@endsection
