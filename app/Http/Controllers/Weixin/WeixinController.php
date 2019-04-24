<?php

namespace App\Http\Controllers\Weixin;
use   Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use  App\Model\weixin\weixin;
use App\Model\weixin\txt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Model\GoodsModel;
class WeixinController extends Controller
{
    public function valid()
    {
        echo $_GET['echostr'];
    }

    public function wxEvent()
    {
        //接收微信服务器推送
        $content = file_get_contents("php://input");
        $time = date('Y-m-d H:i:s');
        $str = $time . $content . "\n";
        file_put_contents("logs/wx_event.log", $str, FILE_APPEND);
        // var_dump($content);exit;
        $data = simplexml_load_string($content);
        //$data = (array)simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);
        // var_dump($data);exit;
        $type = $data->MsgType;
        //var_dump($type);exit;


        $wx_id = $data->ToUserName;// 公众号ID
        $openid = $data->FromUserName;//用户OpenID
        $event = $data->Event;//事件类型
        if ($event == 'subscribe') {        //扫码关注事件
            //根据openid判断用户是否已存在
            $local_user = weixin::where(['openid' => $openid])->first();
            if ($local_user) {
                //用户之前关注过
                echo '
                    <xml>
                    <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
                    <FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
                    <CreateTime>' . time() . '</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[' . '欢迎回来 ' . $local_user['nickname'] . ']]></Content>
                    </xml>';
            } else {          //用户首次关注
                //获取用户信息
                $u = $this->getUserInfo($openid);
                //用户信息入库
                $u_info = [
                    'openid' => $u['openid'],
                    'nickname' => $u['nickname'],
                    'sex' => $u['sex'],
                    'headimgurl' => $u['headimgurl'],
                ];
                $id = weixin::insertGetId($u_info);
                echo '
                    <xml>
                    <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
                    <FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
                    <CreateTime>' . time() . '</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[' . '欢迎关注 ' . $u['nickname'] . ']]></Content>
                    </xml>';
            }
        }


        if ($type == 'text') {
            $txt = $data->Content;//文本信息
            // var_dump($txt);exit;
            $addtime = $data->CreateTime;//时间
            file_put_contents("logs/txt.log", $str, FILE_APPEND);
            $openid = $data->FromUserName;
            //$u=$this->getUserInfo($openid);
            $info = [
                'openid' => $openid,
                'text' => $txt,
                'createtime' => $addtime,
            ];
          $arr=txt::insert($info);

             // var_dump($arr);exit;
            if ($txt=='最新商品') {
              $goods=  GoodsModel::where(['is_new'=>1])->get();
               //var_dump($goods);exit;
<<<<<<< HEAD
                $id=$goods->id;
            $url='http://www.1809wanglei.comcto.com/jump?$id';
=======

            $url='http://www.xiaoming.com/jump?id=1';
>>>>>>> beeff1cc1fdfd3163cd40fd0ac782f07ebbe3fd0
            foreach ($goods as $v){
              $res= ' <xml>
  <ToUserName><![CDATA['.$openid.']]></ToUserName>
  <FromUserName><![CDATA['.$wx_id.']]></FromUserName>
  <CreateTime>' . time() . '</CreateTime>
  <MsgType><![CDATA[news]]></MsgType>
  <ArticleCount>1</ArticleCount>
  <Articles>
    <item>
      <Title><![CDATA['.$v->name.']]></Title>
      <Description><![CDATA['.$v->name.']]></Description>
      <PicUrl><![CDATA[picurl]]></PicUrl>
      <Url><![CDATA['.$url.']]></Url>
    </item>
  </Articles>
</xml>';
              echo $res;
            }


            }
        }

    }
    public function goods(Request $request){
       $id=$request->get('id');
       $res= GoodsModel::where(['id'=>$id])->first();
     // echo $res;
        echo $res['name'];
        echo $res['price'];
    }
}