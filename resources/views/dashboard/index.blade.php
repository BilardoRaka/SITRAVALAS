@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Tabel Kurs Valuta Asing</h1>
</div>
<div class="table-responsive col-lg-6">
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
    @foreach($forexes as $forexes)
        @foreach($forexes as $forex)
        @if( $forex->Valas == 'KURS')
        @else
        <tr>
            <td align="center">{{ $loop->index }}</td>
            <td align="center">{{ $forex->Valas }}</td>
            <td align="right"><?php 
            $string = $forex->HargaBeli;
            $replace = str_replace(".", "", $string);
            $replace2 = str_replace(",", ".", $replace);
            $float = (float)$replace2;
            $marginBeli = $float * 0.98;
            $round = round($marginBeli,2);
            ?>{{ number_format($round,2,",",".") }}</td>
            <td align="right"><?php 
            $string = $forex->HargaJual;
            $replace = str_replace(".", "", $string);
            $replace2 = str_replace(",", ".", $replace);
            $float = (float)$replace2;
            $marginJual = $float * 1.02;
            $round = round($marginJual,2);
            ?>{{ number_format($round,2,",",".") }}</td>
        </tr> 
        @endif
        @endforeach
    @endforeach
    </tbody>
    </table>
</div>
@endsection