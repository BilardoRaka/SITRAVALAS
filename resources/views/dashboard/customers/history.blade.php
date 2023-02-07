@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Riwayat Transaksi Pelanggan</h1>
</div>
<div class="row">
    <div class="col-md-6 text-center fw-light fs-5">
        Transaksi Beli Forex
    </div>
    <div class="col-md-6 text-center fw-light fs-5">
        Transaksi Jual Forex
    </div>
</div>
<div class="row">
    <div class="table-responsive col-md-6 mt-2">
        <table class="table table-striped table-sm table-bordered">
            <thead>
            <tr>
                <th scope="col" style="text-align: center;">ID</th>
                <th scope="col" style="text-align: center;">Forex Ditukar</th>
                <th scope="col" style="text-align: center;">Debit</th>
                <th scope="col" style="text-align: center;">Waktu Transaksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                @if($transaction->debit != null and $transaction->kredit == null)
                    <tr>
                        <td align="center">{{ $transaction->id }}</td>
                        <td align="left">
                        <?php
                            $buytrans = $buys->where('transaction_id', $transaction->id)->all();
                        ?>
                        @foreach($buytrans as $buy)
                            {{ $buy->jumlah }} {{ $buy->forex_id }} 
                        @endforeach
                        </td>
                        <td align="right">{{ number_format($transaction->debit,2,",",".") }}</td>
                        <td align="right">{{ $transaction->created_at }}</td>
                    </tr>
                @endif
            @endforeach            
            </tbody>
        </table>
    </div>
    <div class="table-responsive col-md-6 mt-2">
        <table class="table table-striped table-sm table-bordered">
            <thead>
            <tr>
                <th scope="col" style="text-align: center;">ID</th>
                <th scope="col" style="text-align: center;">Forex Ditukar</th>
                <th scope="col" style="text-align: center;">Kredit</th>
                <th scope="col" style="text-align: center;">Waktu Transaksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                @if($transaction->kredit != null and $transaction->debit == null)
                    <tr>
                        <td align="center">{{ $transaction->id }}</td>
                        <td align="left">
                        <?php
                            $selltrans = $sells->where('transaction_id', $transaction->id)->all();
                        ?>
                        @foreach($selltrans as $sell)
                            {{ $sell->jumlah }} {{ $sell->forex_id }} 
                        @endforeach
                        </td>
                        <td align="right">{{ number_format($transaction->kredit,2,",",".") }}</td>
                        <td align="right">{{ $transaction->created_at }}</td>
                    </tr>
                @endif
            @endforeach            
            </tbody>
        </table>
    </div>
</div>
@endsection 