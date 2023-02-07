@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Data Akun Perusahaan</h1>
</div>
@if(session()->has('Sukses'))
<div class="alert alert-success col-lg-5" role="alert">
  {{ session('Sukses') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
      <div class="table-responsive col-lg-5">
      <a class="btn btn-primary mb-3" href="/dashboard/accounts/create"><span data-feather="plus-circle" class="align-text-bottom"></span> Tambah Akun Baru</a>
        <table class="table table-striped table-sm table-bordered">
          <thead>
            <tr>
              <th scope="col" style="text-align: center;">No.</th>
              <th scope="col" style="text-align: center;">Username</th>
              <th scope="col" style="text-align: center;">Role</th>
              <th scope="col" style="text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach($accounts as $account)
            <tr>
              <td align="center">{{ $accounts->firstItem()+$loop->index }}</td>
              <td align="">{{ $account->username }}</td>
              <td align="">{{ $account->role }}</td>
              <td align="center">
              @if($account->role == "cabang")
              <button type="button" class="badge bg-info border-0" data-bs-toggle="modal" data-bs-target="#accountId-{{ $account->id }}">
                <span data-feather="eye" class="align-text-bottom"></span>
              </button>
              @endif
              <a href="/dashboard/accounts/{{ $account->id }}/edit" class="badge bg-warning">
              <span data-feather="edit" class="align-text-bottom"></span>
              </a>
              <form action="/dashboard/accounts/{{ $account->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin untuk hapus akun?')">
                  <span data-feather="x-circle" class="align-text-bottom"></span>
                </button>
              </form>
              </td>
            </tr> 
              <!-- Modal -->
              <div class="modal fade modal-fullscreen" id="accountId-{{ $account->id }}" tabindex="-1" role="dialog" aria-labelledby="accountIdLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div align="left" class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="accountIdLabel">Informasi Lengkap Akun</h5>
                  </div>
                  <div class="modal-body">
                      <p>Username :<br>{{ $account->username }}</p>
                      <p>Role :<br>{{ $account->role }}</p>
                      @if($account->role == "cabang")
                      <p>Wilayah :<br>{{ $account->user->wilayah }}</p>
                      <p>Alamat :<br>{{ $account->user->alamat }}</p>
                      <p>Koordinat :<br><a href="{{ $account->user->koordinat }}" target="_blank">{{ $account->user->koordinat }}</a></p>
                      @else
                      @endif
                  </div>
                  </div>
              </div>
              </div>
          @endforeach
          </tbody>
        </table>
      </div>
      {{ $accounts->links() }}
@endsection