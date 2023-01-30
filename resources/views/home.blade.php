@extends('layouts.app')

@section('content')
<style>
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 25%;
  padding: 5px;
  text-align:center;
  padding-bottom: 80px;
}

.column h2{
    text-align:center;
}

.column a{
    text-decoration: none;
    color: black;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                        @auth
                        @if(auth()->user()->level == 1)
                            <div class="row">
                                <div class="column">
                                <a href="{{ route('order') }}">
                                    <img src="{{ url('/images/food.png')}}" style="width:140px;height:120px">
                                    <h2>Order</h2>
                                </a>
                                </div>
                                <div class="column">
                                <a href="{{ route('absen-kasir') }}">
                                    <img src="{{url('/images/absen.png')}}" style="width:140px;height:120px">
                                    <h2>Absensi</h2>
                                </a>
                                </div>
                            </div>
                        @endif
                    @endif
                    @auth
                        @if(auth()->user()->level == 2)
                            <div class="row">
                                <div class="column">
                                <a href="{{ route('dapur') }}">
                                    <img src="{{ url('/images/report.png')}}" style="width:140px;height:120px">
                                    <h2>Dapur</h2>
                                </a>
                                </div>
                                <div class="column">
                                <a href="{{ route('absen-dapur') }}">
                                    <img src="{{url('/images/absen.png')}}" style="width:140px;height:120px">
                                    <h2>Absensi</h2>
                                </a>
                                </div>
                            </div>
                        @endif
                    @endif
                    @auth
                        @if(auth()->user()->level == 3)
                            <div class="row">
                                <div class="column">
                                <a href="{{ route('makanan') }}">
                                    <img src="{{ url('/images/food.png')}}" style="width:140px;height:120px">
                                    <h2>Makanan</h2>
                                </a>
                                </div>
                                <div class="column">
                                <a href="{{ route('minuman') }}">
                                    <img src="{{url('/images/drink-icon.png')}}" style="width:140px;height:120px">
                                    <h2>Minuman</h2>
                                </a>
                                </div>
                                <div class="column">
                                <a href="{{ route('topping') }}">
                                    <img src="{{url('/images/topping.png')}}" style="width:140px;height:120px">
                                    <h2>Topping</h2>
                                </a>
                                </div>
                                <div class="column">
                                <a href="{{ route('absen') }}">
                                    <img src="{{url('/images/absen.png')}}" style="width:140px;height:120px">
                                    <h2>Absensi</h2>
                                </a>
                                </div>
                                <div class="column">
                                <a href="{{ route('laporan') }}">
                                    <img src="{{url('/images/report.png')}}" style="width:140px;height:120px">
                                    <h2>Laporan</h2>
                                </a>
                                </div>
                                <div class="column">
                                <a href="{{ route('akun') }}">
                                    <img src="{{url('/images/akun.png')}}" style="width:140px;height:120px">
                                    <h2>Manage Account</h2>
                                </a>
                                </div>
                            </div>
                        @endif
                    @endif
        </div>
    </div>
</div>
@endsection
