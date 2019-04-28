<?php

namespace App\Admin\Controllers;

use App\Model\weixin\weixin;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use GuzzleHttp\Client;
use http\Env\Request;
use Illuminate\Support\Facades\Input;
class SendController extends Controller
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
            ->header('消息管理')
            ->description('群发消息')
            ->body(view('admin.weixin.send'));
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
        $grid = new Grid(new weixin);

        $grid->w_id('W id');
        $grid->openid('Openid');
        $grid->nickname('Nickname');
        $grid->sex('Sex');
        $grid->headimgurl('Headimgurl');
        $grid->sub_status('Sub status');

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
        $show = new Show(weixin::findOrFail($id));

        $show->w_id('W id');
        $show->openid('Openid');
        $show->nickname('Nickname');
        $show->sex('Sex');
        $show->headimgurl('Headimgurl');
        $show->sub_status('Sub status');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new weixin);

        $form->number('w_id', 'W id');
        $form->text('openid', 'Openid');
        $form->text('nickname', 'Nickname');
        $form->number('sex', 'Sex');
        $form->text('headimgurl', 'Headimgurl');
        $form->switch('sub_status', 'Sub status')->default(1);

        return $form;
    }
    public function allsend($openid_arr,$content){
        $msg=[
            "touser"=>$openid_arr,
            "msgtype"=>"text",
            "text"=>[
                "content"=>$content
            ]
        ];
        $data=json_encode($msg,JSON_UNESCAPED_UNICODE);
        // echo $data;
        $token=getWxAccessToken();
        $url='https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$token.'';
        $clinet= new Client();
        //发送json字符串
        $response= $clinet->request('POST',$url,[
            'body'=>$data
        ]);
        return $response->getBody();

    }
    public function send(Content $content){
        $input=Input::all();
       var_dump($input);
        $msg="abc";
     // $msg=$_POST();
       // $msg=$content->input();
        $userlist=weixin::where(['sub_status'=>1])->get()->toArray();
        //var_dump($userlist);
        $openid_arr=array_column($userlist,'openid');
        $result=$this->allsend($openid_arr,$msg);
              return $content
            ->header('')
            ->description('')
            ->body( view('admin.weixin.send',['userlist'=>$userlist]));


    }
}
