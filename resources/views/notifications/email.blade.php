@component('mail::layout')
{{-- header --}}
<head>
</head>
@slot('header')
@component('mail::header', ['url' => config('app.url')])
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
@endif
{{-- subcopy --}}
@slot('subcopy')
@component('mail::subcopy')
<p style="text-align:justify;">Untuk dapat membantu pelanggan kedepan dalam keperluan menukarkan valuta asing, kami telah membuat Bot WhatsApp yang dapat digunakan untuk mengecek lokasi kios perusahaan serta mengetahui harga kurs valuta asing secara real-time. Segera kunjungi nomor tersebut dan ketik 'IHELP' di private message untuk informasi lebih lanjut.</p>
{{-- button --}}
@component('mail::button', ['url' => 'https://wa.me/6285155288534?text=IHELP'])
Kunjungi Bot Whatapp
@endcomponent
@endcomponent
@endslot
{{-- footer --}}
@slot('footer')
@component('mail::footer')
Thanks,<br>
Creator - BRPamungkas
@endcomponent
@endslot
@endcomponent
