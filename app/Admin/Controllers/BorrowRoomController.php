<?php

namespace App\Admin\Controllers;

use App\Enums\ApprovalStatus;
use App\Models\BorrowRoom;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Encore\Admin\Admin;
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
        $grid->borrower_id('borrower_id');
        $grid->room_id('room_id');
        $grid->borrow_at('borrow_at');
        $grid->until_at('until_at');
        $grid->lecturer_id('lecturer_id');
        $grid->lecturer_approval_status('lecturer_approval_status');
        $grid->admin_id('admin_id');
        $grid->admin_approval_status('admin_approval_status');
        $grid->processed_at('processed_at');
        $grid->returned_at('returned_at');
        $grid->notes('notes');
        $grid->created_at(trans('admin.created_at'));
        $grid->updated_at(trans('admin.updated_at'));

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
        $show->borrower_id('borrower_id');
        $show->room_id('room_id');
        $show->borrow_at('borrow_at');
        $show->until_at('until_at');
        $show->lecturer_id('lecturer_id');
        $show->lecturer_approval_status('lecturer_approval_status');
        $show->admin_id('admin_id');
        $show->admin_approval_status('admin_approval_status');
        $show->processed_at('processed_at');
        $show->returned_at('returned_at');
        $show->notes('notes');
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
            $form->display('ID');

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
            $form->display(trans('admin.created_at'));
            $form->display(trans('admin.updated_at'));
        }

        return $form;
    }
}
