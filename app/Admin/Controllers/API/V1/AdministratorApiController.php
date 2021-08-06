<?php

namespace App\Admin\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;

class AdministratorApiController extends Controller
{

    /**
     * Get all administrator where has role `mahasiswa`
     *
     * @param  mixed $request
     * @return void
     */
    public function getCollegeStudents(Request $request)
    {
        $q = $request->get('q');

        return Administrator::whereHas('roles', function ($query) {
            $query->where('slug', 'mahasiswa');
        })->where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    /**
     * Get all administrator where has role `dosen`
     *
     * @param  mixed $request
     * @return void
     */
    public function getLecturers(Request $request)
    {
        $q = $request->get('q');

        return Administrator::whereHas('roles', function ($query) {
            $query->where('slug', 'dosen');
        })->where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    /**
     * Get all administrator where has role `tata-usaha`
     *
     * @param  mixed $request
     * @return void
     */
    public function getAdministrators(Request $request)
    {
        $q = $request->get('q');

        return Administrator::whereHas('roles', function ($query) {
            $query->where('slug', 'tata-usaha');
        })->where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
