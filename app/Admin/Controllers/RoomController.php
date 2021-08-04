<?php

namespace App\Admin\Controllers;

use App\Enums\RoomStatus;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RoomController extends Controller
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
            ->header('Ruangan')
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
            ->header('Ruangan')
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
            ->header('Ruangan')
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
            ->header('Ruangan')
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
        $grid = new Grid(new Room);

        $grid->id('ID');
        $grid->name('name');
        $grid->max_people('max_people');
        $grid->status('status');
        $grid->notes('notes');
        $grid->room_type('room_type');
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
        $show = new Show(Room::findOrFail($id));

        $show->id('ID');
        $show->name('name');
        $show->max_people('max_people');
        $show->status('status');
        $show->notes('notes');
        $show->room_type('room_type');
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
        $form = new Form(new Room);

        if ($form->isEditing())
            $form->display('id', 'ID');

        $form->text('name', 'Nama');
        $form->select('room_type_id', 'Tipe Ruangan')->options(function ($id) {
            return RoomType::all()->pluck('name', 'id');
        });
        $form->slider('max_people', 'Maksimal Orang')->options([
            'min' => 1,
            'max' => 100,
            'from' => 20,
            'postfix' => ' orang'
        ]);
        $form->radio('status', 'Status')->options(RoomStatus::asSelectArray())->stacked();
        $form->textarea('notes', 'Catatan');

        if ($form->isEditing()) {
            $$form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        }

        return $form;
    }
}
