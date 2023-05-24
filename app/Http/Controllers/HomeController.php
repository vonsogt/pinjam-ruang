<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['rooms'] =    Room::with('room_type')->get();

        // Get admin where role is dosen and get name and id
        $data['lecturers'] = Administrator::whereHas('roles', function ($query) {
            $query->where('slug', 'dosen');
        })->get()->pluck('name', 'id');

        return view('index', compact('data'));
    }

    public function rooms()
    {
        $data['rooms'] = Room::with('room_type')->get();
        $data['lecturers'] = Administrator::whereHas('roles', function ($query) {
            $query->where('slug', 'dosen');
        })->get();

        return view('pages.rooms', compact('data'));
    }
}
