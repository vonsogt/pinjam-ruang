<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Box;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dasbor')
            ->description('Pinjam ruang')
            ->row(function (Row $row) {
                // Widget for users
                $row->column(3, function (Column $column) {
                    $count_users = \DB::table('admin_users')->count();
                    $infoBox = new InfoBox('Pengguna', 'users', 'aqua', route('admin.auth.users.index'), $count_users);
                    $column->append($infoBox);
                });

                // Widget for room types
                $row->column(3, function (Column $column) {
                    $count_room_types = \DB::table('room_types')->count();
                    $infoBox = new InfoBox('Tipe Ruangan', 'cubes', 'green', route('admin.auth.users.index'), $count_room_types);
                    $column->append($infoBox);
                });

                // Widget for rooms
                $row->column(3, function (Column $column) {
                    $count_rooms = \DB::table('rooms')->count();
                    $infoBox = new InfoBox('Ruangan', 'trello', 'yellow', route('admin.auth.users.index'), $count_rooms);
                    $column->append($infoBox);
                });

                // Widget for borrow rooms
                $row->column(3, function (Column $column) {
                    $count_borrow_rooms = \DB::table('borrow_rooms')->count();
                    $infoBox = new InfoBox('Peminjaman', 'calendar', 'red', route('admin.auth.users.index'), $count_borrow_rooms);
                    $column->append($infoBox);
                });
            });
    }
}
