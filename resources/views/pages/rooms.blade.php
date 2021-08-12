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
                    $room_status = $room->status;
                    $borrower_status = [];

                    // Check if any borrow rooms
                    if ($room->borrow_rooms->isNotEmpty()) {
                        // Check each borrow_rooms
                        foreach ($room->borrow_rooms as $key => $borrow_room) {
                            // Show details if not finished yet by checking status first
                            if (
                                $borrow_room->returned_at == null
                                && $borrow_room->admin_approval_status == App\Enums\ApprovalStatus::Disetujui
                            ) {
                                $room_status = 1; // Set status room to Booked
                                $borrower_first_name = ucfirst(strtolower(explode(' ', Encore\Admin\Auth\Database\Administrator::find($borrow_room->borrower_id)->name)[0]));
                                // $borrow_at =    Carbon\Carbon::make($borrow_room->borrow_at)->format('d M Y');
                                // $until_at =     Carbon\Carbon::make($borrow_room->until_at)->format('d M Y');

                                $borrow_at = Carbon\Carbon::parse($borrow_room->borrow_at);
                                $until_at = Carbon\Carbon::parse($borrow_room->until_at);
                                $count_days = $borrow_at->diffInDays($until_at) + 1;

                                if ($count_days == 1)
                                    $borrower_status[] = $borrower_first_name . ' - ' . $borrow_at->format('d M Y');
                                else
                                    $borrower_status[] = $borrower_first_name . ' - ' . $borrow_at->format('d M Y') . ' s.d ' . $until_at->format('d M Y');
                            }
                        }
                    }
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
                                    <li><span>Status:</span> {{ App\Enums\RoomStatus::getDescription($room_status) }}</li>
                                    <li>{!! implode('<br>', $borrower_status) !!}</li>
                                </ul>
                                <p class="pt-1"><a href="javascript:void(0)" id="buttonBorrowRoomModal" class="btn-custom px-3 py-2" data-toggle="modal" data-target="#borrowRoomModal" data-room-id="{{ $room->id }}" data-room-name="{{ $room->name }}">Pinjam Ruang Ini <span class="icon-long-arrow-right"></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
          </div>
          </div>
      </section>

      <!-- Modal -->
    <div class="modal fade" id="borrowRoomModal" tabindex="-1" role="dialog" aria-labelledby="borrowRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="borrowRoomModalLabel">Pinjam Ruang - Nama Ruang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('api.v1.borrow-room-with-college-student', []) }}" class="appointment-form">
                    @csrf
                    <div class="row">
                        {{-- Hidden input for room_id --}}
                        <input id="room" name="room" type="hidden" value="{{ old('room') }}">
                        <div class="col-md-12">
                            <div class="form-group">
                            <input name="full_name" type="text" class="form-control" placeholder="Nama Lengkap">
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="input-wrap">
                        <div class="icon"><span class="ion-md-calendar"></span></div>
                        <input name="borrow_at" type="text" class="form-control appointment_date-check-in" placeholder="Tgl Mulai">
                    </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="input-wrap">
                        <div class="icon"><span class="ion-md-calendar"></span></div>
                        <input name="until_at" type="text" class="form-control appointment_date-check-out" placeholder="Tgl Selesai">
                    </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <div class="form-field">
                          <div class="select-wrap">
                  <select name="lecturer" id="" class="form-control">
                      <option value="" selected disabled>Pilih dosen</option>
                    @forelse ($data['lecturers'] as $lecturer)
                        <option value="{{ $lecturer->id }}">
                            {{ $lecturer->name }}
                        </option>
                    @empty
                        <option value="" disabled>Belum ada dosen yang terdaftar</option>
                    @endforelse
                  </select>
                </div>
                  </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <input name="nim" type="text" class="form-control" placeholder="NIM">
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="form-field">
                          <div class="select-wrap">
                  <select name="study_program" id="" class="form-control">
                      <option value="" selected disabled>Prodi</option>
                      <option value="teknik-informatika">Teknik Informatika (D3)</option>
                      <option value="teknik-multimedia-dan-jaringan">Teknik Multimedia & Jaringan (D4)</option>
                      <option value="teknik-geomatika">Teknik Geomatika (D3)</option>
                      <option value="animasi">Animasi (D4)</option>
                      <option value="rekayasa-keamanan-siber">Rekayasa Keamanan Siber (D4)</option>
                  </select>
                </div>
                  </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <input type="submit" value="Pinjam Ruang Sekarang" class="btn btn-primary">
            </form>
            </div>
        </div>
        </div>
    </div>

    @section('scripts')
        <script>
            //triggered when modal is about to be shown
            $(document).on('click', '#buttonBorrowRoomModal', function() {

                var roomName = $(this).data('room-name');
                var roomId = $(this).data('room-id');

                // Change value room
                $('input[name="room"]').val(roomId);

                // change title modal
                $('#borrowRoomModalLabel').text('Pinjam Ruang - ' + roomName);

                // Rest form modal
                resetBorrowRoomModalForm()
            });

            function resetBorrowRoomModalForm(){
                $('#borrowRoomModal').find('input[name="full_name"]').val('');
                $('#borrowRoomModal').find('input[name="borrow_at"]').val('');
                $('#borrowRoomModal').find('input[name="until_at"]').val('');
                $('#borrowRoomModal').find('select[name="lecturer"]').val($('select[name="lecturer"] option:first').val());
                $('#borrowRoomModal').find('input[name="nim"]').val('');
                $('#borrowRoomModal').find('select[name="study_program"]').val($('select[name="study_program"] option:first').val());
            }
        </script>
    @endsection
@endsection
