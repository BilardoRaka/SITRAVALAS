<!DOCTYPE html>
<html>
    <head>
    <title>Invoice Transaksi - {{ $transaction[0]->id }}</title>

    <style type="text/css">  
    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: smaller;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        margin-left:auto;
        margin-right:auto;
    }

    .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: center;
        font-size: smaller;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        font-size: smaller;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    @page {
        margin: 20px 20px 20px 20px !important;
        padding: 20px 20px 20px 20px !important;
    }
    </style>  

    </head>
    <body>
    <div class="w3-container w3-teal" align="center">
        <h4>PT. BERKAH AMANAH SYARIAH<br>CABANG {{$user[0]->wilayah }}</h4>
    </div>
    <hr>
    <small>
    Waktu Transaksi : {{ $transaction[0]->created_at }} | Jenis Transaksi : {{ $jt }}
    </small>
    <div class="container">
        <table align="center" class="styled-table">
            <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Forex</th>
                <th scope="col">Harga</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            @if($jt == "Beli Forex")
                @foreach($buys as $buy)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td>{{ $buy->jumlah }} {{ $buy->forex_id }}</td>
                        <td align="right">Rp. {{ number_format($buy->harga_satuan,2,",",".") }}</td>
                        <td align="right">Rp. {{ number_format($buy->total,2,",",".") }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="3" align="center">Debit</td>
                        <td align="right">Rp. {{ number_format($transaction[0]->debit,2,",",".") }}</td>
                    </tr>
            @elseif($jt == "Jual Forex")
                @foreach($sells as $sell)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td>{{ $sell->jumlah }} {{ $sell->forex_id }}</td>
                        <td align="right">Rp. {{ number_format($sell->harga_satuan,2,",",".") }}</td>
                        <td align="right">Rp. {{ number_format($sell->total,2,",",".") }}</td>
                    </tr>    
                @endforeach
                    <tr>
                        <td colspan="3" align="center">Kredit</td>
                        <td align="right">Rp. {{ number_format($transaction[0]->kredit,2,",",".") }}</td>
                    </tr>
            @endif
            </tbody>
        </table>
    </div>
    <hr>
    
    <p><b><small>IDENTITAS PELANGGAN</small></b></p>
    <p><small>
    NIK / SIM : {{ $customer[0]->id }}<br>
    Nama      : {{ $customer[0]->nama }}<br>
    Alamat    : {{ $customer[0]->alamat }}<br>
    TTL       : {{ $customer[0]->tempatlahir }}, {{ $customer[0]->tgllahir }}<br>
    Email     : {{ $customer[0]->email }}<br>
    No. HP    : {{ $customer[0]->nohp }}
    </small>
    </body>
</html>
 