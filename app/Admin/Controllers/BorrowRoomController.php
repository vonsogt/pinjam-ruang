<?php

namespace App\Admin\Controllers;

use App\Enums\ApprovalStatus;
use App\Models\BorrowRoom;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Carbon\Carbon;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BorrowRoomController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Pinjam Ruang')
            ->description(trans('admin.list'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Pinjam Ruang')
            ->description(trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Pinjam Ruang')
            ->description(trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Pinjam Ruang')
            ->description(trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BorrowRoom);

        $grid->id('ID');
        $grid->column('borrower.name', 'Peminjam');
        $grid->column('room.name', 'Ruangan');
        $grid->column('borrow_at', 'Mulai Pinjam')->display(function ($title, $column) {
            return Carbon::parse($title)->format('d M Y');
        });
        $grid->column('until_at', 'Lama Pinjam (hari)')->display(function ($title, $column) {
            $borrow_at = Carbon::parse($this->borrow_at);
            $until_at = Carbon::parse($title);
            $count_days = $borrow_at->diffInDays($until_at, false);

            return ($count_days + 1) . ' hari';
        });
        $grid->column('lecturer.name', 'Dosen');
        $grid->column('status', 'Status')->display(function ($title, $column) {
            $lecturer_approval_status = $this->lecturer_approval_status;
            $admin_approval_status = $this->admin_approval_status;

            if ($lecturer_approval_status == 1) {
                if ($admin_approval_status == 1)
                    $val = ['success', 'Sudah disetujui TU'];
                else if ($admin_approval_status == 0)
                    $val = ['info', 'Menunggu persetujuan TU'];
                else
                    $val = ['danger', 'Ditolak TU'];
            } else if ($lecturer_approval_status == 0) {
                $val = ['info', 'Menunggu persetujuan Dosen'];
            } else {
                $val = ['danger', 'Ditolak Dosen'];
            }

            return '<span class="label-' . $val[0] . '" style="width: 8px;height: 8px;padding: 0;border-radius: 50%;display: inline-block;"></span>&nbsp;&nbsp;'
                . $val[1];
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BorrowRoom::findOrFail($id));

        $show->id('ID');
        $show->field('borrower.name', 'Peminjam');
        $show->field('room.name', 'Ruangan');
        $show->field('borrow_at', 'Mulai Pinjam');
        $show->field('until_at', 'Selesai Pinjam');
        $show->field('lecturer.name', 'Dosen');
        $show->field('lecturer_approval_status', 'Status Persetujuan Dosen')->using(ApprovalStatus::asSelectArray());;
        $show->field('admin.name', ' Tata Usaha');
        $show->field('admin_approval_status', 'Status Persetujuan Tata Usaha')->using(ApprovalStatus::asSelectArray());;
        $show->field('processed_at', 'Diproses Pada');
        $show->field('returned_at', 'Diselesaikan Pada');
        $show->field('notes', 'Catatan');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BorrowRoom);

        if ($form->isEditing())
            $form->display('id', 'ID');

        // Mahasiswa Form
        $form->select('borrower_id', 'Peminjam')->options(function ($id) {
            $college_students = Administrator::find($id);
            if ($college_students)
                return [$college_students->id => $college_students->name];
        })->ajax('/admin/api/college-students');
        $form->select('room_id', 'Ruangan')->options(function ($id) {
            $room = Room::find($id);
            if ($room)
                return [$room->id => $room->name];
        })->ajax('/admin/api/rooms');
        $form->datetime('borrow_at', 'Mulai Pinjam')->format('YYYY-MM-DD HH:mm');
        $form->datetime('until_at', 'Selesai Pinjam')->format('YYYY-MM-DD HH:mm');

        // Persetujuan Dosen
        $form->select('lecturer_id', 'Dosen')->options(function ($id) {
            $lecturers = Administrator::find($id);
            if ($lecturers)
                return [$lecturers->id => $lecturers->name];
        })->ajax('/admin/api/lecturers');
        $form->radio('lecturer_approval_status', 'Status Persetujuan Dosen')->options(ApprovalStatus::asSelectArray());

        // Persetujuan dan administrasi Tata usaha
        $form->select('admin_id', 'Tata Usaha')->options(function ($id) {
            $administrators = Administrator::find($id);
            if ($administrators)
                return [$administrators->id => $administrators->name];
        })->ajax('/admin/api/administrators');
        $form->radio('admin_approval_status', 'Status Persetujuan Tata Usaha')->options(ApprovalStatus::asSelectArray());
        $form->datetime('processed_at', 'Diproses Pada')->format('YYYY-MM-DD HH:mm');
        $form->datetime('returned_at', 'Diselesaikan Pada')->format('YYYY-MM-DD HH:mm');
        $form->textarea('notes', 'Catatan');

        if ($form->isEditing()) {
            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        }

        return $form;
    }
}
