@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Transaksi Baru</h1>
</div>
<form method="post" action="/dashboard/transactions">
@csrf
<div class="col-lg-8">
    <div class="mb-3">
    <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
        <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                <option style="color: gray;" value="" disabled selected hidden>Pilih Jenis Transaksi...</option>
                <option value="BeliBarang">Beli Valas</option>
                <option value="JualBarang">Jual Valas</option>
        </select>
    </div>
</div>
<div class="mb-3">
    <input type="hidden" class="form-control" id="nik" name="nik" value="{{ $id }}">
<div class="row">
    <div class="form-group col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 child-repeater-table">
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th style="text-align:center; margin: auto;">Mata Uang</th>
                    <th style="text-align:center; margin: auto;">Jumlah Nominal</th>
                    <th style="text-align:center; margin: auto;">Harga Satuan</th>
                    <th style="text-align:center; margin: auto;"><a href="javascript:void(0)" class="badge bg-success addRow">+</a></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                    <select name="forex_id[]" id="" class="form-control" required>
                        <option style="color: gray;" value="" disabled selected hidden>Pilih Valas...</option>
                        @foreach($forexes as $forex)
                            <option value="{{ $forex->id }}">{{ $forex->id }}</option>
                        @endforeach
                    </select>
                    </td>
                    <td><input type="number" id="jumlah[]" name="jumlah[]" class="form-control css" required></td>
                    <td><input type="number" id="harga_satuan[]" name="harga_satuan[]" class="form-control css" required></td>
                    <td align="center"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Buat Transaksi</button>
    </div>
</div>
</form>
<script>
    $('thead').on('click', '.addRow', function(){
        var tr = "<tr>"+
                    "<td><select name='forex_id[]' id='' class='form-control' required>"+
                    "<option style='color: gray;' value='' disabled selected hidden>Pilih Valas...</option>"+
                        "@foreach($forexes as $forex)"+
                            "<option value='{{ $forex->id }}'>{{ $forex->id }}</option>"+
                        "@endforeach"+
                    "</select></td>"+
                    "<td><input type='text' name='jumlah[]' class='form-control' required></td>"+
                    "<td><input type='text' name='harga_satuan[]' class='form-control' required></td>"+
                    "<td align='center'><a href='javascript:void(0)' class='badge bg-danger deleteRow'>-</a></td>"+
                "</tr>"
        $('tbody').append(tr);
    });
    $('tbody').on('click', '.deleteRow', function(){
        $(this).parent().parent().remove();
    });
</script>

@endsection