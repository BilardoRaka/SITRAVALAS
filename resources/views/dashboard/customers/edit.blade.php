@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Ubah Data Customer</h1>
</div>
<div class="col-lg-8">
<form method="post" action="/dashboard/customers/{{ $customer->id }}">
@csrf        
@method('put')
  <div class="mb-3">
    <label for="id" class="form-label">NIK / No.SIM</label>
    <input type="text" id="id" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$customer->id) }}" readonly required>
  @error('id')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="nama" class="form-label">Nama Lengkap</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama',$customer->nama) }}" required>
  @error('nama')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat',$customer->alamat) }}" required>
  @error('alamat')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="row mb-3">
    <div class="col">
      <label for="ttl" class="form-label">Tempat Lahir</label>
      <input type="text" class="form-control @error('tempatlahir') is-invalid @enderror" id="tempatlahir" name="tempatlahir" value="{{ old('tempatlahir',$customer->tempatlahir) }}" required>
    @error('tempatlahir')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
    </div>
    <div class="col">
      <label for="tgllahir" class="form-label">Tanggal Lahir</label>
      <input type="date" class="form-control @error('tgllahir') is-invalid @enderror" id="tgllahir" name="tgllahir" value="{{ old('tgllahir',$customer->tgllahir) }}" max="<?php echo date("Y-m-d"); ?>" onkeydown="return false" required>
    @error('tgllahir')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">E-Mail</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$customer->email) }}" required>
  @error('email')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="nohp" class="form-label">No. HP</label>
    <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp" value="{{ old('nohp',$customer->nohp) }}" required>
  @error('nohp')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <button type="submit" class="btn btn-primary">Ubah Data Customer</button>
</form>
</div>
@endsection 