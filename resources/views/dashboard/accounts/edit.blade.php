@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Ubah Akun</h1>
</div>
<div class="col-lg-8">
<form method="post" action="/dashboard/accounts/{{ $account->id }}">
@csrf
@method('put')
  <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select class="form-select" name="role">
        <option value="admin" {{ $account->role == 'admin' ? 'selected' : ''}}>admin</option>
        <option value="pimpinan" {{ $account->role == 'pimpinan' ? 'selected' : ''}}>pimpinan</option>
        <option value="cabang" {{ $account->role == 'cabang' ? 'selected' : ''}}>cabang</option>
    </select>
  </div>        
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $account->username) }}" required>
  @error('username')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required>
  @error('password')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <div class="mb-3">
    <label for="wilayah" class="form-label">Wilayah</label>
    <input type="text" id="wilayah" {{ $account->role == 'cabang' ? '' : 'readonly'}} name="wilayah" class="form-control @error('wilayah') is-invalid @enderror" value="{{ old('wilayah', $account->user->wilayah) }}">
  @error('wilayah')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
    <div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" id="alamat" {{ $account->role == 'cabang' ? '' : 'readonly'}} name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $account->user->alamat) }}">
  @error('alamat')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
  </div>
  <button type="submit" class="btn btn-primary">Ubah Akun</button>
</form>
</div>
<script>
  $('select').on('change', function() {
    if(this.value == 'admin' || this.value == 'pimpinan') {
      $('#wilayah').val('');
      $('#alamat').val('');
      $("#wilayah").prop("readonly", true);
      $("#alamat").prop("readonly", true);
    } else {
      $('.wilayah').val('');
      $('.alamat').val('');
      $("#wilayah").prop("readonly", false);
      $("#alamat").prop("readonly", false);
    }
  });
</script>
@endsection