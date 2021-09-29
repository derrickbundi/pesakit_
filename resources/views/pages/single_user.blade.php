@extends('layouts.main')
@section('title', 'User Details')
@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $user->name }} Personal Details
                    <a href="{{ route('home') }}" class="btn btn-warning btn-sm" style="float:right;">Go Back</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">{{ $user->name }}</div>
                        <div class="col-md-4">{{ $user->mobile }}</div>
                        <div class="col-md-4">{{ $user->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
