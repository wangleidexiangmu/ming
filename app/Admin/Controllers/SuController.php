<?php

namespace App\Admin\Controllers;

use App\Model\weixin\txt;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SuController extends Controller
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
            ->header('Index')
            ->description('description')
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
            ->header('Detail')
            ->description('description')
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
            ->header('Edit')
            ->description('description')
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new txt);

        $grid->t_id('T id');
        $grid->openid('Openid');
        $grid->text('Text');
        $grid->createtime('Createtime');
        $grid->image('Image');
        $grid->voice('Voice');

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
        $show = new Show(txt::findOrFail($id));

        $show->t_id('T id');
        $show->openid('Openid');
        $show->text('Text');
        $show->createtime('Createtime');
        $show->image('Image');
        $show->voice('Voice');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new txt);

        $form->number('t_id', 'T id');
        $form->text('openid', 'Openid');
        $form->text('text', 'Text');
        $form->number('createtime', 'Createtime');
        $form->image('image', 'Image');
        $form->text('voice', 'Voice');

        return $form;
    }
}
