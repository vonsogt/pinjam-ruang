@extends('layouts.default')
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('vendor/technext/vacation-rental/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Ruangan <i class="fa fa-chevron-right"></i></span></p>
          <h1 class="mb-0 bread">Daftar Ruangan</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section bg-light ftco-no-pt ftco-no-pb">
          <div class="container-fluid px-md-0">
              <div class="row no-gutters">
              @foreach ($data['rooms'] as $key => $room)
                @php
                    dump($room->borrow_rooms);
                @endphp
                <div class="col-lg-6">
                    <div class="room-wrap d-md-flex">
                        <a href="#" class="img" style="background-image: url({{ asset('vendor/technext/vacation-rental/images/room-'. rand(1, 6) . '.jpg') }});"></a>
                        <div class="half left-arrow d-flex align-items-center">
                            <div class="text p-4 p-xl-5 text-center">
                                <p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
                                <p class="mb-0">{{ $room->room_type->name }}</p>
                                <h3 class="mb-3"><a href="rooms.html">{{ $room->name }}</a></h3>
                                <ul class="list-accomodation">
                                    <li><span>Maks:</span> {{ $room->max_people }} Orang</li>
                                    <li><span>Size:</span> 45 m2</li>
                                    <li><span>Status:</span> {{ App\Enums\RoomStatus::getDescription($room->status) }}</li>
                                </ul>
                                <p class="pt-1"><a href="{{ route('home') }}" class="btn-custom px-3 py-2">Pinjam Ruang Ini <span class="icon-long-arrow-right"></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
          </div>
          </div>
      </section>
@endsection
