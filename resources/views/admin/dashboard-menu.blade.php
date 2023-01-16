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
                  {{ __('List Menu') }}
                </div>
                
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('menu') }}">
                            <img src="https://awsimages.detik.net.id/community/media/visual/2019/08/12/dca21bf3-923c-486f-bc2e-a3dcd759b1df.jpeg?w=700&q=90" class="image-menu" alt="">
                            <h3 class="text-image">Makanan</h3>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('topping') }}">
                            <img src="https://static.wixstatic.com/media/f6ade2_f4f5808e60744ef99c03a5cc5412bc98~mv2.jpg/v1/fill/w_560,h_400,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/f6ade2_f4f5808e60744ef99c03a5cc5412bc98~mv2.jpg" class="image-menu" alt="">
                            <h3 class="text-image">Topping</h3>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('minuman') }}">
                            <img src="data:image/jpeg;base64,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" class="image-menu" alt="">
                            <h3 class="text-image">Minuman</h3>
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
