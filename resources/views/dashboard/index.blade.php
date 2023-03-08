@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>Tabel Kurs Valuta Asing</h2>
</div>
<div class="table-responsive col-lg-6">
<p align="right"><b>Tanggal Terakhir Update : {{ $tanggal }}</b></p>
    <table class="table table-striped table-sm table-bordered">
    <thead>
    <tr>
        <th scope="col" style="text-align: center;">No.</th>
        <th scope="col" style="text-align: center;">Nama Valas</th>
        <th scope="col" style="text-align: center;">Harga Beli</th>
        <th scope="col" style="text-align: center;">Harga Jual</th>
    </tr>
    </thead>
    <tbody>
    @foreach($forexes as $forex)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $forex->Valas }}</td>
            <td align="right"><?php 
            $string = $forex->HargaBeli;
            $replace = str_replace(",", "", $string);
            $float = (float)$replace;
            $marginBeli = $float * 0.98;
            $round = round($marginBeli,2);
            ?>{{ number_format($round,2,",",".") }}</td>
            <td align="right"><?php 
            $string = $forex->HargaJual;
            $replace = str_replace(",", "", $string);
            $float = (float)$replace;
            $marginJual = $float * 1.02;
            $round = round($marginJual,2);
            ?>{{ number_format($round,2,",",".") }}</td>
        </tr> 
    @endforeach
    </tbody>
    </table>
</div>
@endsection