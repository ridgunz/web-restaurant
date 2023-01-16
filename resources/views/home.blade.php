@extends('layouts.layout')

@section('content')
<style>
    .image-menu {
        width: 200px;
        height: 200px;
        object-fit: cover;   
    }
</style>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        @auth
        @if(auth()->user()->level == 3)

        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  {{ __('Dashboard') }}
                </div>
                
                <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('dashboard-menu') }}">
                            <i class="menu-icon tf-icons bx bx-food-menu" style="width: 125px; height: 125px;font-size: 125px !important;"></i>
                            <h3 class="text-image">Menu</h3>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('menu') }}">
                        <i class="menu-icon tf-icons bx bx-bar-chart-alt-2" style="width: 125px; height: 125px;font-size: 125px !important;"></i>
                            <h3 class="text-image">Laporan</h3>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('menu') }}">
                            <i class="menu-icon tf-icons bx bx-time" style="width: 125px; height: 125px;font-size: 125px !important;"></i>
                            <h3 class="text-image">Absensi</h3>
                        </a>
                    </div>

                </div>
            </div>
        </div>
      </div>
    </div>
</div>
        
            <!-- <a href="{{ route('list-menu') }}" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">List Menu</a> -->
            <!-- <br>
            <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Tambah Menu</a> -->
            <br>
            <!-- <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Laporan</a> -->
            <br>
            <!-- <a href="#" class="btn btn-primary mb-4" style="width:300px !important; font-size:18px;">Absensi</a> -->
        @endif
        @endif
@endsection
