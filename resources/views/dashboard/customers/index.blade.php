@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Data Customer Perusahaan</h1>
</div>
@if(session()->has('Sukses'))
<div class="alert alert-success col-lg-12" role="alert">
  {{ session('Sukses') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
  <div class="col">
    <a class="btn btn-primary mb-3" href="/dashboard/customers/create"><span data-feather="plus-circle" class="align-text-bottom"></span> Tambah Data Customer</a>
      @cannot('isCabang')
      <a class="btn btn-primary mb-3" target="_blank"  href="/dashboard/customers/print"><span data-feather="printer" class="align-text-bottom"></span> Cetak Data Customer</a>    
      @endcannot    
    <form action="/dashboard/customers">
    </div>
        <div class="input-group mb-3 col">
      <input type="text" class="form-control" placeholder="Masukkan NIK atau Nama Customer" name="search" value="{{ request('search') }}">
      <button class="btn btn-primary" type="submit" id="">Search</button>
        </div>
      </div>
    </form>
      <div class="table-responsive col-lg-12">
        <table class="table table-striped table-sm table-bordered">
          <thead>
            <tr>
              <th scope="col" style="text-align:center;">No.</th>
              <th scope="col" style="text-align:center;">NIK / No. SIM</th>
              <th scope="col" style="text-align:center;">Nama Lengkap</th>
              <th scope="col" style="text-align:center;">E-Mail</th>
              <th scope="col" style="text-align:center;">No. HP</th>
              <th scope="col" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
          @if($customers->count())
          @foreach($customers as $customer)
            <tr>
              <td align="center">{{ $customers->firstItem()+$loop->index }}</td>
              <td align="right">{{ $customer->id }}</td>
              <td align="left">
              @cannot('isCabang')
              <a href="/dashboard/customers/{{ $customer->id }}/history">{{ $customer->nama }}</a>
              @endcannot 
              @can('isCabang')
              {{ $customer->nama }}
              @endcan
              </td>
              <td align="left">{{ $customer->email }}</td>
              <td align="right">{{ $customer->nohp }}</td>
              <td align="center">
              <button type="button" class="badge bg-info border-0" data-bs-toggle="modal" data-bs-target="#customerId-{{ $customer->id }}">
                <span data-feather="eye" class="align-text-bottom"></span>
              </button>
              <!-- Modal View-->
                <div class="modal fade" id="customerId-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="customerIdLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div align="left" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customerIdLabel">Identitas Lengkap Customer</h5>
                    </div>
                    <div class="modal-body">
                        <p>NIK / No. SIM :<br>{{ $customer->id }}</p>
                        <p>Nama Lengkap :<br>{{ $customer->nama }}</p>
                        <p>Alamat :<br>{{ $customer->alamat }}</p>
                        <p>TTL :<br>{{ $customer->tempatlahir }}, {{ $customer->tgllahir }}</p>
                        <p>E-Mail :<br>{{ $customer->email }}</p>
                        <p>No. HP :<br>{{ $customer->nohp }}</p>
                    </div>
                    </div>
                </div>
                </div>
              <a href="/dashboard/customers/{{ $customer->id }}/edit" class="badge bg-warning">
              <span data-feather="edit" class="align-text-bottom"></span>
              </a>
              <form action="/dashboard/customers/{{ $customer->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin untuk hapus data pelanggan?')">
                  <span data-feather="x-circle" class="align-text-bottom"></span>
                </button>
              </form>
              </td>
            </tr> 
          @endforeach
          </tbody>
        </table>
      </div>
      {{ $customers->links() }}
        @else
          </tbody>
        </table>
          <p class="text-center fs-4">- Data Pelanggan yang Dicari Tidak Ada -</p>
        @endif
@endsection