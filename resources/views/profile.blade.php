@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-secondary fw-bold">User Profile</h2>
                        <a href="{{ route('auth.logout') }}" class="btn btn-dark">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection