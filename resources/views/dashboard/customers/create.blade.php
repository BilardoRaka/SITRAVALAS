@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Tambah Data Customer Baru</h1>
</div>
<div class="col-lg-8">
<form method="post" action="/dashboard/customers">
@csrf        
  <div class="mb-3">
    <label for="id" class="form-label">NIK / No.SIM</label>
    <input type="number" id="id" name="id" class="form-control css @error('id') is-invalid @enderror" value="{{ old('id') }}" autofocus required>
  @error('id')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="nama" class="form-label">Nama Lengkap</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
  @error('nama')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
  @error('alamat')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="row mb-3">
    <div class="col">
      <label for="ttl" class="form-label">Tempat Lahir</label>
      <input type="text" class="form-control @error('tempatlahir') is-invalid @enderror" id="tempatlahir" name="tempatlahir" value="{{ old('tempatlahir') }}" required>
    @error('tempatlahir')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
    </div>
    <div class="col">
      <label for="tgllahir" class="form-label">Tanggal Lahir</label>
      <input type="date" class="form-control @error('tgllahir') is-invalid @enderror" id="tgllahir" name="tgllahir" value="{{ old('tgllahir') }}" max="<?php echo date("Y-m-d"); ?>" onkeydown="return false" required>
    @error('tgllahir')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">E-Mail</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
  @error('email')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="nohp" class="form-label">No. HP</label>
    <input type="number" class="form-control css @error('nohp') is-invalid @enderror" id="nohp" name="nohp" value="{{ old('nohp') }}" required>
  @error('nohp')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <button type="submit" class="btn btn-primary">Buat Data Customer</button>
</form>
</div>
@endsection 