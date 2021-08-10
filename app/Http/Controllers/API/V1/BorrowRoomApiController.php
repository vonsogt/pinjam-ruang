<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'nim' =>            'required|integer',
            'study_program' =>  'required',
        ], [
            'full_name.required' => 'Kolom nama lengkap wajib diisi.',
            'borrow_at.required' => 'Kolom tgl mulai wajib diisi.',
            'until_at.required' =>  'Kolom tgl selesai wajib diisi.',
            'room.required' =>      'Kolom ruangan wajib diisi.',

            'nim.required' =>   'Kolom nim wajib diisi.',
            'nim.integer' =>    'Kolom nim harus berupa bilangan bulat.',

            'study_program.required' => 'Kolom prodi wajib diisi.',
        ]);

        if ($validator->fails())
            return back()->withInput($request->input())->withErrors($validator);



    }
}
