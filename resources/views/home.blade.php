@extends('layouts.main')
@section('title', 'Dashboard')
@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome Back</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of registered users</div>

                <div class="card-body">
                   @forelse ($users as $item)
                       <div class="row">
                            <div class="col-md-1">{{ $loop->iteration }}</div>
                            <div class="col-md-3">{{ $item->name }}</div>
                            <div class="col-md-3">{{ $item->mobile }}</div>
                            <div class="col-md-3">{{ $item->email }}</div>
                            <div class="col-md-2">
                                <a href="/home/user/{{ base64_encode($item->id) }}" class="btn btn-success btn-sm">View</a>
                            </div>
                        </div>
                        <br>
                   @empty
                       <p>Oops, users list is empty!</p>
                   @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
