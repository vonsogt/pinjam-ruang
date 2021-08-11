<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
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
            'borrow_at' =>      'required',
            'until_at' =>       'required',
            'room' =>           'required',
            'lecturer' =>       'required',
            'nim' =>            'required|integer',
            'study_program' =>  'required',
        ], [
            'full_name.required' => 'Kolom nama lengkap wajib diisi.',
            'borrow_at.required' => 'Kolom tgl mulai wajib diisi.',
            'until_at.required' =>  'Kolom tgl selesai wajib diisi.',
            'room.required' =>      'Kolom ruangan wajib diisi.',
            'lecturer.required' =>  'Kolom dosen wajib diisi.',

            'nim.required' =>   'Kolom nim wajib diisi.',
            'nim.integer' =>    'Kolom nim harus berupa bilangan bulat.',

            'study_program.required' => 'Kolom prodi wajib diisi.',
        ]);

        if ($validator->fails())
            return back()->withInput($request->input())->withErrors($validator);

        $full_name =        $request->full_name;
        $nim =              $request->nim;
        $study_program =    $request->study_program;

        // Make account for college student
        $admin_user = Administrator::create([
            'username' =>   $nim,
            'name' =>       $full_name,
            'password' =>   Hash::make($request->nim)
        ]);

        // Make college student details to user_details table
        $college_student_detail = UserDetail::create([
            'user_id' =>        $admin_user->id,
            'data' =>           json_encode([
                'full_name' =>      $full_name,
                'nim'       =>      $nim,
                'study_program' =>  $study_program,
            ])
        ]);

        return back()->withSuccess(true);
    }
}
