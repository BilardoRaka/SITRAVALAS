@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Data Transaksi Perusahaan</h1>
</div>
@if(session()->has('Sukses'))
<div class="alert alert-success col-lg-10" role="alert">
  {{ session('Sukses') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
  <div class="col">
    @can('isCabang')
      <a class="btn btn-primary mb-3" href="/dashboard/transactions/customer"><span data-feather="plus-circle" class="align-text-bottom"></span> Tambah Transaksi Baru</a>
      <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ModalCreate"><span data-feather="plus-circle" class="align-text-bottom"></span> Modal Usaha Masuk</a>
    @endcan
  </div>
</div>
@cannot('isCabang')
<form action="/dashboard/transactions">
@csrf
  <div class="row g-3 align-items-center mb-3">
    <div class="col-auto">
      <select name="wilayah" id="wilayah" class="form-select" required>
        <option selected value="" hidden>Pilih Cabang...</option>
          @foreach($users as $user)
            @if($user->wilayah != null)
                <option value="{{ $user->id }}" @if(request('wilayah') == $user->id) selected @endif>{{ $user->wilayah }}</option>
            @endif
          @endforeach
      </select>
    </div>
    <div class="col-auto">
      <select name="bulan" id="bulan" class="form-select" onchange="cekWaktu()">
        <option selected value="" hidden>Pilih Bulan...</option>
        <option value="1" @if(request('bulan') == 1) selected @endif>Januari</option>
        <option value="2" @if(request('bulan') == 2) selected @endif>Febuari</option>
        <option value="3" @if(request('bulan') == 3) selected @endif>Maret</option>
        <option value="4" @if(request('bulan') == 4) selected @endif>April</option>
        <option value="5" @if(request('bulan') == 5) selected @endif>Mei</option>
        <option value="6" @if(request('bulan') == 6) selected @endif>Juni</option>
        <option value="7" @if(request('bulan') == 7) selected @endif>Juli</option>
        <option value="8" @if(request('bulan') == 8) selected @endif>Agustus</option>
        <option value="9" @if(request('bulan') == 9) selected @endif>September</option>
        <option value="10" @if(request('bulan') == 10) selected @endif>Oktober</option>
        <option value="11" @if(request('bulan') == 11) selected @endif>November</option>
        <option value="12" @if(request('bulan') == 12) selected @endif>Desember</option>
      </select>
    </div>
    <div class="col-auto">
      <select name="tahun" id="tahun" class="form-select" onchange="cekWaktu()">
        <option selected value="" hidden>Pilih Tahun...</option>
        <option value="2020" @if(request('tahun') == 2020) selected @endif>2020</option>
        <option value="2021" @if(request('tahun') == 2021) selected @endif>2021</option>
        <option value="2022" @if(request('tahun') == 2022) selected @endif>2022</option>
        <option value="2023" @if(request('tahun') == 2023) selected @endif>2023</option>
        <option value="2024" @if(request('tahun') == 2024) selected @endif>2024</option>
        <option value="2025" @if(request('tahun') == 2025) selected @endif>2025</option>
      </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary"><span data-feather="search" class="align-text-bottom"></span></button>
    </div>
  </div>  
</form>
@endcannot
@can("isCabang")
<form action="/dashboard/transactions">
@csrf
  <div class="row g-3 align-items-center mb-3">
    <div class="col-auto">
      <select name="tahun" id="tahun" class="form-select" onchange="cekWaktu()">
        <option selected value="" hidden>Pilih Tahun...</option>
        <option value="2020" @if(request('tahun') == 2020) selected @endif>2020</option>
        <option value="2021" @if(request('tahun') == 2021) selected @endif>2021</option>
        <option value="2022" @if(request('tahun') == 2022) selected @endif>2022</option>
        <option value="2023" @if(request('tahun') == 2023) selected @endif>2023</option>
        <option value="2024" @if(request('tahun') == 2024) selected @endif>2024</option>
        <option value="2025" @if(request('tahun') == 2025) selected @endif>2025</option>
      </select>
    </div>
    <div class="col-auto">
      <select name="bulan" id="bulan" class="form-select" onchange="cekWaktu()">
        <option selected value="" hidden>Pilih Bulan...</option>
        <option value="1" @if(request('bulan') == 1) selected @endif>Januari</option>
        <option value="2" @if(request('bulan') == 2) selected @endif>Febuari</option>
        <option value="3" @if(request('bulan') == 3) selected @endif>Maret</option>
        <option value="4" @if(request('bulan') == 4) selected @endif>April</option>
        <option value="5" @if(request('bulan') == 5) selected @endif>Mei</option>
        <option value="6" @if(request('bulan') == 6) selected @endif>Juni</option>
        <option value="7" @if(request('bulan') == 7) selected @endif>Juli</option>
        <option value="8" @if(request('bulan') == 8) selected @endif>Agustus</option>
        <option value="9" @if(request('bulan') == 9) selected @endif>September</option>
        <option value="10" @if(request('bulan') == 10) selected @endif>Oktober</option>
        <option value="11" @if(request('bulan') == 11) selected @endif>November</option>
        <option value="12" @if(request('bulan') == 12) selected @endif>Desember</option>
      </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary"><span data-feather="search" class="align-text-bottom"></span></button>
    </div>
  </div>
</form>
@endcan
  @if(auth()->user()->role == "cabang" or $requestwilayah != "")
  <div class="table-responsive col-lg-10">
    <table class="table table-striped table-sm table-bordered">
      <thead>
        <tr>
          <th scope="col" style="text-align: center;">No.</th>
          <th scope="col" style="text-align: center;">Kredit</th>
          <th scope="col" style="text-align: center;">Debit</th>
          <th scope="col" style="text-align: center;">Saldo</th>
          <th scope="col" style="text-align: center;">Waktu Transaksi</th>
          <th scope="col" style="text-align: center;">Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($transactions as $transaction)
        <tr>
          <td align="center">{{ $transactions->firstItem()+$loop->index }}</td>
          <td align="right">{{ number_format($transaction->kredit,2,",",".") }}</td>
          <td align="right">{{ number_format($transaction->debit,2,",",".") }}</td>
          <td align="right">{{ number_format($transaction->saldo,2,",",".") }}</td>
          <td align="right">{{ $transaction->created_at }}</td>
          <td align="center">
          @if($transaction->customer_id != "")
          <button type="button" class="badge bg-info border-0" data-bs-toggle="modal" data-bs-target="#transId-{{ $transaction->id }}">
            <span data-feather="eye" class="align-text-bottom"></span>
          </button>
          <a href="/dashboard/transactions/{{ $transaction->id }}/print" target="_blank" class="badge bg-primary">
            <span data-feather="printer" class="align-text-bottom"></span>
          </a>
          @endif
            {{-- Modal View --}}
            <div class="modal fade" id="transId-{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="transIdLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transIdLabel">Detil Data Transaksi</h5>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" align="left">
                @if($transaction->customer_id != "" and $transaction->kredit == "")
                    <p><b>IDENTITAS CUSTOMER :</b></p>
                    <p>NIK / No. SIM : {{ $transaction->customer->id }}<br>
                    Nama Lengkap : {{ $transaction->customer->nama }}<br>
                    Alamat : {{ $transaction->customer->alamat }}<br>
                    TTL : {{ $transaction->customer->tempatlahir }}, {{ $transaction->customer->tgllahir }}<br>
                    E-Mail : {{ $transaction->customer->email }}<br>
                    No. HP : {{ $transaction->customer->nohp }}</p>
                    <p><b>TRANSAKSI DILAKUKAN - BELI FOREX :</b></p>
                    <p>
                    <?php 
                    $buytrans = $buy->where('transaction_id', $transaction->id)->all();
                    ?>
                    @foreach($buytrans as $buytran)
                    <p>
                      Mata Uang Ditukar : {{ $buytran->jumlah }} {{ $buytran->forex_id }} <br>Harga Satuan : {{ number_format($buytran->harga_satuan,2,",",".") }} <br>Total : {{ number_format($buytran->total,2,",",".") }}
                    </p>
                    @endforeach
                    <b>Total Debit Transaksi : {{ number_format($transaction->debit,2,",",".") }}</b>
                    </p>                      
                @endif
                @if($transaction->customer_id != "" and $transaction->debit == "")
                    <p><b>IDENTITAS CUSTOMER :</b></p>
                    <p>NIK / No. SIM : {{ $transaction->customer->id }}<br>
                    Nama Lengkap : {{ $transaction->customer->nama }}<br>
                    Alamat : {{ $transaction->customer->alamat }}<br>
                    TTL : {{ $transaction->customer->tempatlahir }}, {{ $transaction->customer->tgllahir }}<br>
                    E-Mail : {{ $transaction->customer->email }}<br>
                    No. HP : {{ $transaction->customer->nohp }}</p>
                    <p><b>TRANSAKSI DILAKUKAN - JUAL FOREX :</b></p>
                    <p>
                    <?php 
                    $selltrans = $sell->where('transaction_id', $transaction->id)->all();
                    ?>
                    @foreach($selltrans as $selltran)
                    <p>
                      Mata Uang Ditukar : {{ $selltran->jumlah }} {{ $selltran->forex_id }} <br>Harga Satuan : {{ number_format($selltran->harga_satuan,2,",",".") }} <br>Total : {{ number_format($selltran->total,2,",",".") }}
                    </p>
                    @endforeach
                    <b>Total Kredit Transaksi : {{ number_format($transaction->kredit,2,",",".") }}</b>
                    </p>                      
                @endif
                </div>
                </div>
            </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    </div>
    @else
    <div class="table-responsive col-lg-3">
    <table class="table table-striped table-sm table-bordered">
      <thead>
        <tr>
          <th scope="col" style="text-align: center;">Wilayah</th>
          <th scope="col" style="text-align: center;">Sisa Saldo</th>
        </tr>
      </thead>
      <tbody>  
      @foreach($accounts as $account)
      @if($account->role == "cabang")
        <tr>
          <td>{{ $account->user->wilayah }}</td>
          <td align="right">
          <?php
              $tot = $trans->where('account_id', $account->user->id)->pluck('saldo')->last();
              echo number_format($tot,2,",",".");
          ?>
          </td>
        </tr>
      @endif
      @endforeach
      </tbody>
    </table>
    </div>
    @endif
  <form method="post" action="/dashboard/transactions/capital">
  @csrf
      <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Modal Usaha Masuk</h4>               
                  </div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="jumlahModal" class="form-label">Jumlah Modal Usaha</label>
                        <input type="number" jumlahModal="jumlahModal" name="jumlahModal" class="form-control css" autofocus required>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <button type="submit" class="btn btn-primary">Tambah Saldo</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </form>
    @if($requestwilayah != "" and $requestbulan != "" and $requesttahun != "")  
      <form action="/dashboard/transactions/rekapitulasi" class="col mb-3">
      @csrf
            <input type="hidden" id="wilayah" name="wilayah" value="{{ $requestwilayah }}">
            <input type="hidden" id="bulan" name="bulan" value="{{ $requestbulan }}">
            <input type="hidden" id="tahun" name="tahun" value="{{ $requesttahun }}">
            <button type="submit" class="btn btn-primary" formtarget="_blank"><span data-feather="archive" class="align-text-bottom"></span> Rekapitulasi Transaksi Bulanan</button>      
      </form>
    @endif
  @if($requestwilayah != null)
  {{ $transactions->links() }}
  @endif
<script>
function cekWaktu() {
    if ($("#bulan").val() != null) {
      $('#tahun').prop("required", true);
    } else {
      $('#tahun').prop("required", false);
    }

    if ($("#tahun").val() != null) {
      $('#bulan').prop("required", true);
    } else {
      $('#bulan').prop("required", false);
    }
}
</script>
@endsection