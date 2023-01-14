@extends('layouts.layout')

@section('content')
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        @auth
        @if(auth()->user()->level == 3)
            <a href="{{ route('list-menu') }}" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">List Menu</a>
            <!-- <br>
            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Tambah Menu</a> -->
            <br>
            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Laporan</a>
            <br>
            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Absensi</a>
        @endif
        @endif
@endsection
