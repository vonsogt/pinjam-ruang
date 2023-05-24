<?php

namespace App\Admin\Controllers;

use App\Models\RoomType;
use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RoomTypeController extends Controller
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
            ->header('Tipe Ruangan')
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
            ->header('Tipe Ruangan')
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
            ->header('Tipe Ruangan')
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
            ->header('Tipe Ruangan')
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
        $grid = new Grid(new RoomType);

        $grid->id('ID');

        $grid->name('Nama');
        $grid->is_active('Aktif?')->bool();

        $grid->created_at(trans('admin.created_at'))
            ->display(function ($created_at) {
                return date('d M Y H:i:s', strtotime($created_at));
            })
            ->sortable();
        $grid->updated_at(trans('admin.updated_at'))
            ->display(function ($created_at) {
                return date('d M Y H:i:s', strtotime($created_at));
            })
            ->sortable();

        // Role & Permission
        if (!\Admin::user()->can('create.room_types'))
            $grid->disableCreateButton();

        $grid->actions(function ($actions) {

            // The roles with this permission will not able to see the view button in actions column.
            if (!\Admin::user()->can('edit.room_types')) {
                $actions->disableEdit();
            }
            // The roles with this permission will not able to see the show button in actions column.
            if (!\Admin::user()->can('list.room_types')) {
                $actions->disableView();
            }
            // The roles with this permission will not able to see the delete button in actions column.
            if (!\Admin::user()->can('delete.room_types')) {
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
        $show = new Show(RoomType::findOrFail($id));

        $show->id('ID');

        $show->name('Nama');
        $show->is_active('Aktif?')->using(['1' => 'Ya', '0' => 'Tidak']);

        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        // Role & Permission
        $show->panel()
            ->tools(function ($tools) {
                // The roles with this permission will not able to see the view button in actions column.
                if (!\Admin::user()->can('edit.room_types'))
                    $tools->disableEdit();

                // The roles with this permission will not able to see the show button in actions column.
                if (!\Admin::user()->can('list.room_types'))
                    $tools->disableList();

                // The roles with this permission will not able to see the delete button in actions column.
                if (!\Admin::user()->can('delete.room_types'))
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
        $form = new Form(new RoomType);

        if ($form->isEditing())
            $form->display('id', 'ID');

        $form->text('name', 'Nama');
        $form->switch('is_active', 'Aktif?')->states([
            'on' =>     ['value' => 1, 'text' => 'Ya', 'color' => 'success'],
            'off' =>    ['value' => 0, 'text' => 'Tidak', 'color' => 'danger'],
        ]);

        if ($form->isEditing()) {
            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        }

        return $form;
    }
}
