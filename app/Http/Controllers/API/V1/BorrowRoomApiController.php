<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\BorrowRoom;
use App\Models\AdminUserDetail;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BorrowRoomApiController extends Controller
{
    public function storeBorrowRoomWithCollegeStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' =>      'required|string',
            'borrow_at' =>      'required|date|after_or_equal:' . date('Y-m-d'),
            'until_at' =>       'required|date|after_or_equal:borrow_at',
            'room' =>           'required',
            'lecturer' =>       'required',
            'nim' =>            'required|integer',
            'study_program' =>  'required',
        ], [
            'full_name.required' => 'Kolom nama lengkap wajib diisi.',

            'borrow_at.required' =>         'Kolom tgl mulai wajib diisi.',
            'borrow_at.date' =>             'Kolom tgl mulai bukan tanggal yang valid.',
            'borrow_at.after_or_equal' =>   'Kolom tgl mulai harus berisi tanggal setelah atau sama dengan :date.',

            'until_at.required' =>          'Kolom tgl selesai wajib diisi.',
            'until_at.date' =>              'Kolom tgl selesai bukan tanggal yang valid.',
            'until_at.after_or_equal' =>    'Kolom tgl selesai harus berisi tanggal setelah atau sama dengan tgl mulai.',

            'room.required' =>      'Kolom ruangan wajib diisi.',
            'lecturer.required' =>  'Kolom dosen wajib diisi.',

            'nim.required' =>   'Kolom nim wajib diisi.',
            'nim.integer' =>    'Kolom nim harus berupa bilangan bulat.',

            'study_program.required' => 'Kolom prodi wajib diisi.',
        ]);

        if ($validator->fails())
            return back()->withInput($request->input())->withErrors($validator);

        $full_name =        \Str::upper($request->full_name);
        $nim =              $request->nim;
        $study_program =    $request->study_program;
        $data =             json_encode([
            'full_name' =>      $full_name,
            'nim'       =>      $nim,
            'study_program' =>  $study_program,
        ], true);

        // Make account for college student
        $admin_user = Administrator::create([
            'username' =>   $nim,
            'name' =>       $full_name,
            'password' =>   Hash::make($request->nim)
        ]);

        // Add role college student
        $admin_role_user = \DB::table('admin_role_users')->insert([
            'role_id' =>    4,
            'user_id' =>    $admin_user->id,
        ]);

        // Make college student details to user_details table
        $college_student_detail = AdminUserDetail::create([
            'admin_user_id' =>  $admin_user->id,
            'data' =>           $data
        ]);

        // Add borrow rooms
        $borrow_room = BorrowRoom::create([
            'borrower_id' =>        $admin_user->id,
            'room_id' =>            $request->room,
            'borrow_at' =>          $request->borrow_at,
            'until_at' =>           $request->until_at,
            'lecturer_id' =>        $request->lecturer,
        ]);

        return redirect(route('home'))->withSuccess(true);
    }
}
