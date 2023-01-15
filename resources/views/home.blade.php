@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    @auth
                        @if(auth()->user()->level == 3)
                            <a href="{{ route('menu') }}" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">List Menu</a>
                            <!-- <br>
                            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Tambah Menu</a> -->
                            <br>
                            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Laporan</a>
                            <br>
                            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Absensi</a>
                        @endif
                    @endif
        </div>
    </div>
</div>
@endsection
