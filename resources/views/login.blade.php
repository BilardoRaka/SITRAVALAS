@extends('layouts.main')
@section('container')
<div class="row justify-content-center">
    <div class="col-md-4">
        @if(session()->has('Sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('Sukses') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    <main class="form-signin">
    <form action="/login" method="post">
    @csrf
        <img class="mb-4 rounded mx-auto d-block" src="{{ asset('storage/dollar-coin.png') }}" alt="" width="200" height="200">
        <h1 class="h4 mb-2 fw-normal text-center">Sistem Transaksi Valuta Asing</h1>
        <div class="form-floating">
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" id="username" placeholder="username" autofocus required style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">
        <label for="username">Username</label>
        @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-floating">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" placeholder="password" autofocus required>
        <label for="password">Password</label>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <button class="w-100 btn btn-lg btn-primary mb-2" type="submit">Login</button>
    </form>
    </main>
    </div>
</div>
@endsection 