<?php

namespace App\Admin\Controllers;

use App\Models\BorrowRoom;
use App\Http\Controllers\Controller;
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
        $grid->approved_by_lecturer_status('approved_by_lecturer_status');
        $grid->admin_id('admin_id');
        $grid->approved_by_admin_status('approved_by_admin_status');
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
        $show->approved_by_lecturer_status('approved_by_lecturer_status');
        $show->admin_id('admin_id');
        $show->approved_by_admin_status('approved_by_admin_status');
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

        $form->display('ID');
        $form->text('borrower_id', 'borrower_id');
        $form->text('room_id', 'room_id');
        $form->text('borrow_at', 'borrow_at');
        $form->text('until_at', 'until_at');
        $form->text('lecturer_id', 'lecturer_id');
        $form->text('approved_by_lecturer_status', 'approved_by_lecturer_status');
        $form->text('admin_id', 'admin_id');
        $form->text('approved_by_admin_status', 'approved_by_admin_status');
        $form->text('processed_at', 'processed_at');
        $form->text('returned_at', 'returned_at');
        $form->text('notes', 'notes');
        $form->display(trans('admin.created_at'));
        $form->display(trans('admin.updated_at'));

        return $form;
    }
}
