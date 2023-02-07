@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Tambah Akun Baru</h1>
</div>
<div class="col-lg-8">
<form method="post" action="/dashboard/accounts">
@csrf
  <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select class="form-select" name="role" required>
        <option value="" selected hidden>Pilih Role...</option>
        <option value="admin">admin</option>
        <option value="pimpinan">pimpinan</option>
        <option value="cabang">cabang</option>
    </select>
  </div>        
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input readonly type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
  @error('username')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input readonly type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required>
  @error('password')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="wilayah" class="form-label">Wilayah</label>
    <input readonly type="text" id="wilayah" name="wilayah" class="form-control @error('wilayah') is-invalid @enderror" value="{{ old('wilayah') }}" style="text-transform:uppercase;">
  @error('wilayah')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
    <div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input readonly type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
  @error('alamat')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <button type="submit" class="btn btn-primary">Buat Akun</button>
</form>
</div>
<script>
  $('select').on('change', function() {
    if(this.value == 'admin' || this.value == 'pimpinan') {
      $('#wilayah').val('');
      $('#alamat').val('');
      $('#username').prop("readonly", false);
      $('#password').prop("readonly", false);
      $("#wilayah").prop("readonly", true);
      $("#alamat").prop("readonly", true);
    } else {
      $('#wilayah').val('');
      $('#alamat').val('');
      $('#username').prop("readonly", false);
      $('#password').prop("readonly", false);
      $("#wilayah").prop("readonly", false);
      $("#alamat").prop("readonly", false);
    }
  });
</script>
@endsection