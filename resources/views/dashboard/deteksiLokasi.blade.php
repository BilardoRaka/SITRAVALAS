@extends('dashboard.layouts.main')

@section('container')
@if(session()->has('Sukses'))
<div class="alert alert-success" role="alert">
  {{ session('Sukses') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<h1 class="h4 mt-2">Lokasi Kios</h1>
@if(auth()->user()->user->koordinat == '')
<h1 class="h4 mt-2">Kios belum memiliki URL koordinat, silahkan perbarui koordinat untuk mempermudah pelanggan dalam mencari lokasi kios.</h1>
@else
<div class="mapouter">
<div class="gmap_canvas"><iframe width="500" height="300" id="gmap_canvas" src="{{ auth()->user()->user->koordinat }}=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:300;width:500px;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:500px;}</style></div></div>
@endif
<form action="/dashboard/deteksiLokasi" method="post">
@csrf
<button class="btn btn-primary border-0 mt-3">
Perbarui Lokasi
</button>
@endsection

