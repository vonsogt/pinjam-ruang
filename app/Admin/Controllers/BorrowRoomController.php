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
use Encore\Admin\Form\Field;
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

        $admin_user = \Admin::user();
        // Show query only related to roles
        if ($admin_user->isRole('dosen'))
            $grid->model()->where('lecturer_id', $admin_user->id);
        else if ($admin_user->isRole('mahasiswa'))
            $grid->model()->where('borrower_id', $admin_user->id);
        else if ($admin_user->isRole('tata-usaha'))
            $grid->model()->whereIn('lecturer_approval_status', [ApprovalStatus::Disetujui(), ApprovalStatus::Ditolak()]);

        $grid->id('ID');
        $grid->column('borrower.name', 'Peminjam');
        $grid->column('room.name', 'Ruangan');
        $grid->column('borrow_at', 'Mulai Pinjam')->display(function ($borrow_at) {
            return Carbon::parse($borrow_at)->format('d M Y H:i');
        });
        $grid->column('until_at', 'Lama Pinjam')->display(function ($title, $column) {
            $borrow_at = Carbon::parse($this->borrow_at);
            $until_at = Carbon::parse($title);

            return $until_at->diffForHumans($borrow_at);
        });
        $grid->column('lecturer.name', 'Dosen');
        $grid->column('status', 'Status')->display(function ($title, $column) {
            $lecturer_approval_status = $this->lecturer_approval_status;
            $admin_approval_status =    $this->admin_approval_status;
            $returned_at =              $this->returned_at ?? null;
            $processed_at =             $this->processed_at ?? null;

            if ($lecturer_approval_status == 1) {
                if ($admin_approval_status == 1) {
                    if ($returned_at != null)
                        $val = ['success', 'Peminjaman selesai'];
                    else if ($processed_at != null)
                        $val = ['success', 'Ruangan sedang digunakan'];
                    else
                        $val = ['success', 'Sudah disetujui TU'];
                } else if ($admin_approval_status == 0)
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

        // Role & Permission
        if (!\Admin::user()->can('create.borrow_rooms'))
            $grid->disableCreateButton();

        $grid->actions(function ($actions) {

            // The roles with this permission will not able to see the view button in actions column.
            if (!\Admin::user()->can('edit.borrow_rooms')) {
                $actions->disableEdit();
            }
            // The roles with this permission will not able to see the show button in actions column.
            if (!\Admin::user()->can('list.borrow_rooms')) {
                $actions->disableView();
            }
            // The roles with this permission will not able to see the delete button in actions column.
            if (!\Admin::user()->can('delete.borrow_rooms')) {
                $actions->disableDelete();
            }
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
        $show->field('processed_at', 'Kunci Diambil Pada');
        $show->field('returned_at', 'Diselesaikan Pada');
        $show->field('notes', 'Catatan');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        // Role & Permission
        $show->panel()
            ->tools(function ($tools) {
                // The roles with this permission will not able to see the view button in actions column.
                if (!\Admin::user()->can('edit.borrow_rooms'))
                    $tools->disableEdit();

                // The roles with this permission will not able to see the show button in actions column.
                if (!\Admin::user()->can('list.borrow_rooms'))
                    $tools->disableList();

                // The roles with this permission will not able to see the delete button in actions column.
                if (!\Admin::user()->can('delete.borrow_rooms'))
                    $tools->disableDelete();
            });

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
        $admin_user = \Admin::user();
        $isDosen = $admin_user->isRole('dosen');
        $isTatausaha = $admin_user->isRole('tata-usaha');

        if ($form->isEditing())
            $form->display('id', 'ID');

        // Mahasiswa Form
        if ($isDosen) {
            $form->display('borrower.name', 'Peminjam');
            $form->display('room.name', 'Ruangan');
            $form->display('borrow_at', 'Lama Pinjam')->with(function () {
                $borrow_at = Carbon::parse($this->borrow_at);
                $until_at = Carbon::parse($this->until_at);
                $count_days = $borrow_at->diffInDays($until_at) + 1;

                if ($count_days == 1)
                    return $count_days . ' hari (' . $until_at->format('d M Y') . ')';
                else
                    return $count_days . ' hari (' . $borrow_at->format('d M Y') . ' s/d ' . $until_at->format('d M Y') . ')';
            });
        } else if ($isTatausaha) {
            $form->display('borrower.name', 'Peminjam');
            $form->display('room.name', 'Ruangan');
            $form->display('borrow_at', 'Lama Pinjam')->with(function () {
                $borrow_at = Carbon::parse($this->borrow_at);
                $until_at = Carbon::parse($this->until_at);
                $count_days = $borrow_at->diffInDays($until_at) + 1;

                if ($count_days == 1)
                    return $count_days . ' hari (' . $until_at->format('d M Y') . ')';
                else
                    return $count_days . ' hari (' . $borrow_at->format('d M Y') . ' s/d ' . $until_at->format('d M Y') . ')';
            });
        } else {
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
        }

        // BATAS

        if ($isDosen) {
            $form->display('created_at', 'Diajukan pada')->with(function () {
                return Carbon::parse($this->created_at)->format('d M Y');
            });
            $form->radio('lecturer_approval_status', 'Status Persetujuan Dosen')->options(ApprovalStatus::asSelectArray());
        } else if ($isTatausaha) {
            $form->display('created_at', 'Diajukan pada')->with(function () {
                return Carbon::parse($this->created_at)->format('d M Y');
            });
            $form->display('lecturer.name', 'Dosen');
            $form->display('lecturer_approval_status', 'Status Persetujuan Dosen')->with(function () {
                return ApprovalStatus::getDescription($this->lecturer_approval_status);
            });

            // Check if lecturer approved the borrow_rooms
            $form->hidden('admin_id');
            $form->radio('admin_approval_status', 'Status Persetujuan Tata Usaha')
                ->options(ApprovalStatus::asSelectArray())
                ->with(function ($value, Field $thisField) {
                    $lecturer_approval_status = $this->lecturer_approval_status;
                    if (
                        $lecturer_approval_status === ApprovalStatus::Pending
                        || $lecturer_approval_status === ApprovalStatus::Ditolak
                    )
                        $thisField->attribute('disabled', true);

                    return $value;
                });
            $form->datetime('processed_at', 'Kunci Diambil Pada')->format('YYYY-MM-DD HH:mm')->with(function ($value, Field $thisField) {
                $admin_approval_status = $this->admin_approval_status;
                if (
                    $admin_approval_status == null
                    || $admin_approval_status === ApprovalStatus::Pending
                    || $admin_approval_status === ApprovalStatus::Ditolak
                )
                    $thisField->attribute('readonly', 'readonly');
            });
            $form->datetime('returned_at', 'Diselesaikan Pada')->format('YYYY-MM-DD HH:mm')->with(function ($value, Field $thisField) {
                if ($this->processed_at == null)
                    $thisField->attribute('readonly', 'readonly');
            });
            $form->textarea('notes', 'Catatan');
            // }
        } else {
            // Approval Lecturer
            $form->select('lecturer_id', 'Dosen')->options(function ($id) {
                $lecturers = Administrator::find($id);
                if ($lecturers)
                    return [$lecturers->id => $lecturers->name];
            })->ajax('/admin/api/lecturers');
            $form->radio('lecturer_approval_status', 'Status Persetujuan Dosen')->options(ApprovalStatus::asSelectArray());

            // Approval administration and etc
            $form->select('admin_id', 'Tata Usaha')->options(function ($id) {
                $administrators = Administrator::find($id);
                if ($administrators)
                    return [$administrators->id => $administrators->name];
            })->ajax('/admin/api/administrators');
            $form->radio('admin_approval_status', 'Status Persetujuan Tata Usaha')->options(ApprovalStatus::asSelectArray());
            $form->datetime('processed_at', 'Kunci Diambil Pada')->format('YYYY-MM-DD HH:mm');
            $form->datetime('returned_at', 'Diselesaikan Pada')->format('YYYY-MM-DD HH:mm');
            $form->textarea('notes', 'Catatan');

            if ($form->isEditing()) {
                $form->display('created_at', trans('admin.created_at'));
                $form->display('updated_at', trans('admin.updated_at'));
            }
        }

        $form->saving(function (Form $form) {
            // if ($form->admin_id)
            $form->admin_id = \Admin::user()->id;
        });

        return $form;
    }
}
