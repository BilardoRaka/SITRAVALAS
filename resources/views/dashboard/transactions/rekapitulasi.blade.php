<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Data | {{ $account[0]->wilayah }} | {{ $tahun }} - {{ date("F", mktime(0, 0, 0, $bulan, 1)) }}</title>

    <style type="text/css">  
    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
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
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
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

    .column {
    float: left;
    width: 50%;
    }

    .row:after {
    content: "";
    display: table;
    clear: both;
    }
    </style>  
</head>
<body>
    <h3 align="center">REKAP TRANSAKSI BULANAN</h3>
    <h4 align="center" style="margin-top : -10px">CABANG {{ $account[0]->wilayah }} / {{ $tahun }} - {{ date("F", mktime(0, 0, 0, $bulan, 1)) }}</h4>
    <hr>
    <div class="table-responsive col-lg-12">
      <table class="styled-table">
        <thead>
          <tr>
            <th scope="col" style="text-align:center;">No.</th>
            <th scope="col" style="text-align:center;">Kredit</th>
            <th scope="col" style="text-align:center;">Debit</th>
            <th scope="col" style="text-align:center;">Saldo</th>
            <th scope="col" style="text-align:center;">Waktu Transaksi</th>
            <th scope="col" style="text-align:center;">Nama Pelanggan</th>
          </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
          <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="right">{{ number_format($transaction->kredit,2,",",".") }}</td>
            <td align="right">{{ number_format($transaction->debit,2,",",".") }}</td>
            <td align="right">{{ number_format($transaction->saldo,2,",",".") }}</td>
            <td align="right">{{ $transaction->created_at }}</td> 
            <td align="left">
            @if($transaction->customer_id != null)
                {{ $transaction->customer->nama }}
            @endif 
            </td>
          </tr> 
        @endforeach
        </tbody>
      </table>
    </div>
<div class="row">
    <div class="column">
    @php
        $idrmasuk = 0;
        $idrkeluar = 0;
    @endphp
    Total Modal :
    @foreach($transactions as $transaction)
        @php
            $idrmasuk += $transaction->kredit
        @endphp 
    @endforeach
    {{ number_format($idrmasuk,2,",",".") }}
    </div>
    <div class="column">
    Modal masuk :
    @foreach($transactions as $transaction)
        @php
            $idrkeluar += $transaction->debit
        @endphp 
    @endforeach
    {{ number_format($idrkeluar,2,",",".") }}
    </div>
</div>
    <br>
    <hr>
<div class="row">
    <div class="column">
    <p>
    Valas yang Dibeli : 
    <br>
    @foreach($forexes as $forex)
    @php
        $arr = 0;
        $total = 0;
    @endphp
        @foreach($transactions as $transaction)
        @if($transaction->debit != null and $transaction->customer_id != null)
            @foreach($buys as $buy)
                @if($buy->forex_id == $forex->id and $buy->transaction_id == $transaction->id)
                    @php
                        $arr = $buy->where('transaction_id', $transaction->id)->Where('forex_id', $forex->id)->sum('jumlah');
                        $total += $arr;
                    @endphp
                @endif
            @endforeach
        @endif
        @endforeach
    {{ $total }} {{ $forex->id }} <br>
    @endforeach
    </p>
    </div>
    <div class="column">
    <p>
    Valas yang Dijual : 
    <br>
    @foreach($forexes as $forex)
    @php
        $arr = 0;
        $total = 0;
    @endphp
        @foreach($transactions as $transaction)
        @if($transaction->kredit != null and $transaction->customer_id != null)
            @foreach($sells as $sell)
                @if($sell->forex_id == $forex->id and $sell->transaction_id == $transaction->id)
                    @php
                        $arr = $sell->where('transaction_id', $transaction->id)->Where('forex_id', $forex->id)->sum('jumlah');
                        $total += $arr;
                    @endphp
                @endif
            @endforeach
        @endif
        @endforeach
    {{ $total }} {{ $forex->id }} <br>
    @endforeach
    </p>
    </div>
</div>
</body>
</html>