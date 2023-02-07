@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Pilih Customer yang Akan Transaksi.</h1>
</div>
@if(session()->has('Sukses'))
<div class="alert alert-success col-lg-12" role="alert">
  {{ session('Sukses') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
      <div class="row">
            <form action="/dashboard/transactions/customer">
            <input type="text" class="form-control" placeholder="Masukkan NIK atau Nama Customer" name="search" value="{{ request('search') }}">
            <button class="btn btn-primary mt-2 mb-2" type="submit" id="">Search</button>
            </form> 
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
              <td align="center">{{ $loop->iteration }}</td>
              <td align="right">{{ $customer->id }}</td>
              <td align="left">{{ $customer->nama }}</td>
              <td align="left">{{ $customer->email }}</td>
              <td align="right">{{ $customer->nohp }}</td>
              <td align="center">
              <button type="button" class="badge bg-info border-0" data-bs-toggle="modal" data-bs-target="#customerId-{{ $customer->id }}">
                <span data-feather="eye" class="align-text-bottom"></span>
              </button>
              <!-- Modal -->
                <div class="modal fade" id="customerId-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="customerIdLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" align="left">
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
              <a href="/dashboard/transactions/{{ $customer->id }}/edit" class="badge bg-warning">
              <span data-feather="plus" class="align-text-bottom"></span>
              </a>
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