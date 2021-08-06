<?php

namespace App\Admin\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomApiController extends Controller
{
    /**
     * Get all rooms
     *
     * @param  mixed $request
     * @return void
     */
    public function getRooms(Request $request)
    {
        $q = $request->get('q');

        // Get room.name with room_types.name
        return Room::join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->select('rooms.id as id', \DB::raw("CONCAT(rooms.name, ' - ', room_types.name) as text"))
            ->where('rooms.name', 'like', "%$q%")->paginate(null, ['id', 'text']);
    }
}
