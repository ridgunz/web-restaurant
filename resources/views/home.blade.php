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
                        @if(auth()->user()->level == 3)
                            <!-- <a href="{{ route('menu') }}" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">List Menu</a>
                            <br>
                            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Laporan</a>
                            <br>
                            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Absensi</a> -->
                            <div class="row">
                                <div class="column">
                                <a href="{{ route('menu') }}">
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
                                <a href="{{ route('topping') }}">
                                    <img src="{{url('/images/absen.png')}}" style="width:140px;height:120px">
                                    <h2>Absensi</h2>
                                </a>
                                </div>
                                <div class="column">
                                <a href="{{ route('topping') }}">
                                    <img src="{{url('/images/report.png')}}" style="width:140px;height:120px">
                                    <h2>Laporan</h2>
                                </a>
                                </div>
                            </div>
                        @endif
                    @endif
        </div>
    </div>
</div>
@endsection
