@component('mail::layout')
{{-- header --}}
<head>
</head>
@slot('header')
@component('mail::header', ['url' => 'https://github.com/BilardoRaka'])
<p style="text-transform:capitalize;">PT. BERKAH AMANAH SYARIAH - CABANG {{ $body['user'] }}</p>
@endcomponent
@endslot
{{-- body --}}
<p style="text-align:justify;">Terima Kasih kepada pelanggan yang telah percaya melakukan transaksi bersama kami.</p>
<p>
Waktu Transaksi : {{ $body['transaction']->created_at }}
<br>
Jenis Transaksi : {{ $body['jt'] }}
</p>
<div class="container">
<table class="styled-table">
<thead>
<tr>
<th scope="col">No.</th>
<th scope="col">Valas</th>
<th scope="col">Harga</th>
<th scope="col">Total</th>
</tr>
</thead>
<tbody>
@if($body['jt'] == 'Beli Barang')
@foreach($body['buys'] as $buy)
<tr>
<td align="center">{{ $loop->iteration }}</td>
<td>{{ $buy->jumlah }} {{ $buy->forex_id }}</td>
<td align="right">Rp. {{ number_format($buy->harga_satuan,2,",",".") }}</td>
<td align="right">Rp. {{ number_format($buy->total,2,",",".") }}</td>
</tr>
@endforeach
<tr>
<td colspan="3" align="left">Debit</td>
<td align="right">Rp. {{ number_format($body['transaction']->debit,2,",",".") }}</td>
</tr>
@elseif($body['jt'] == 'Jual Barang')
@foreach($body['sells'] as $sell)
<tr>
<td align="center">{{ $loop->iteration }}</td>
<td>{{ $sell->jumlah }} {{ $sell->forex_id }}</td>
<td align="right">Rp. {{ number_format($sell->harga_satuan,2,",",".") }}</td>
<td align="right">Rp. {{ number_format($sell->total,2,",",".") }}</td>
</tr> 
@endforeach
<tr>
<td colspan="3" align="left">Kredit</td>
<td align="right">Rp. {{ number_format($body['transaction']->kredit,2,",",".") }}</td>
</tr>
</tbody>
@endif

{{-- footer --}}
@slot('footer')
@component('mail::footer')
Thanks,<br>
Creator - BRPamungkas
@endcomponent
@endslot
@endcomponent
