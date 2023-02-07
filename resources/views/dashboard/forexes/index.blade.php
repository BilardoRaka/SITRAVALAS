@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Data Valas Perusahaan</h1>
</div>
@if(session()->has('Sukses'))
<div class="alert alert-success col-lg-7" role="alert">
  {{ session('Sukses') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@can('isAdmin')
  <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ValasCreate"><span data-feather="plus-circle" class="align-text-bottom"></span> Tambah Valas Baru</a>
@endcan
<form action="/dashboard/forexes">
@csrf
<div class="row g-3 align-items-center mb-3">
  <div class="col-auto">
    <input type="date" class="form-control" name="min" id="min" value="{{ $min }}" onchange="cekWaktu()" required>
  </div>
  <div class="col-auto">
    <input type="date" class="form-control" name="max" id="max" value="{{ $max }}" onchange="cekWaktu()" required>
  </div>
  <div class="col-auto">
      <button type="submit" class="btn btn-primary">Filter</button>
  </div>
</div>
</form>
  <div class="table-responsive col-lg-7">
  <table class="table table-striped table-sm table-bordered">
    <thead>
      <tr>
        <th scope="col" style="text-align:center;">No.</th>
        <th scope="col" style="text-align:center;">Kode Forex</th>
        <th scope="col" style="text-align:center;">Keterangan</th>
        @if($min != null and $max != null)
        <th scope="col" style="text-align:center;">Valas Dibeli</th>
        <th scope="col" style="text-align:center;">Valas Dijual</th>
        @endif
        @can('isAdmin')<th scope="col" style="text-align:center;">Action</th>@endcan
      </tr>
    </thead>
    <tbody>
    @foreach($forexes as $forex)
      <tr>
        <td align="center">{{ $loop->iteration }}</td>
        <td align="center">{{ $forex->id }}</td>
        <td>{{ $forex->keterangan }}</td>
        @if($min != null and $max != null)
        <td align="right">
        @php
          $beli = 0;
        @endphp
        @foreach($transactions as $transaction)
          @if($transaction->debit != null and $transaction->customer_id != null)
              @foreach($buys as $buy)
                  @if($buy->forex_id == $forex->id and $buy->transaction_id == $transaction->id)
                      @php
                          $arr = $buy->Where('forex_id', $forex->id)->where('created_at', $transaction->created_at)->value('jumlah');
                          $beli += $arr;
                      @endphp
                  @endif
              @endforeach
          @endif
        @endforeach
        {{ $beli }}
        </td>
        <td align="right">
        @php
          $jual = 0;
        @endphp
        @foreach($transactions as $transaction)
          @if($transaction->kredit != null and $transaction->customer_id != null)
              @foreach($sells as $sell)
                  @if($sell->forex_id == $forex->id and $sell->transaction_id == $transaction->id)
                      @php
                          $arr = $sell->Where('forex_id', $forex->id)->where('created_at', $transaction->created_at)->value('jumlah');
                          $jual += $arr;
                      @endphp
                  @endif
              @endforeach
          @endif
        @endforeach
        {{ $jual }}
        </td>
        @endif
        @can('isAdmin')
        <td align="center">
        <form action="/dashboard/forexes/{{ $forex->id }}" method="post" class="d-inline">
        @method('delete')
        @csrf
          <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin untuk hapus data valas?')">
            <span data-feather="x-circle" class="align-text-bottom"></span>
          </button>
        </form>
        </td>
        @endcan
      </tr> 
    @endforeach
    </tbody>
  </table>
</div>
{{-- Modal Buat Forex --}}
<form method="post" action="/dashboard/forexes">
@csrf
  <div class="modal fade text-left" id="ValasCreate" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Valas Baru</h4>               
              </div>
              <div class="modal-body">
                    <div class="mb-3">
                    <label for="id" class="form-label">Kode Valas</label>
                    <input type="text" id="id" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}" autofocus required style="text-transform: uppercase;">
                  @error('id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                  </div>
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
                  @error('keterangan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <button type="submit" class="btn btn-primary">Buat Valas</button>
                  </div>
              </div>
          </div>
      </div>
  </div>  
</form>
<script>
function cekWaktu() {
    if ($("#min").val() != null) {
      var fromDate = $('#min').val();
      $("#max").attr("min", fromDate);
    } else {
    }
    if ($("#max").val() != null) {
      var toDate = $('#max').val();
      $("#min").attr("max", toDate);
    } else {
    }
}
</script>
@endsection