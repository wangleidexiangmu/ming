<?php

namespace App\Http\Controllers\Weixin;
use   Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use  App\Model\weixin\weixin;
use App\Model\weixin\txt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Model\GoodsModel;
use App\Model\info;
use Illuminate\Support\Str;
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
            $arr = txt::insert($info);

            // var_dump($arr);exit;
            if ($txt == '最新商品') {
                $goods = GoodsModel::where(['is_new' => 1])->get();
                //var_dump($goods);exit;
                $url = 'http://1809wanglei.comcto.com/jump?id=1';
                foreach ($goods as $v) {
                    $res = ' <xml>
  <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
  <FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
  <CreateTime>' . time() . '</CreateTime>
  <MsgType><![CDATA[news]]></MsgType>
  <ArticleCount>1</ArticleCount>
  <Articles>
    <item>
      <Title><![CDATA[' . $v->name . ']]></Title>
      <Description><![CDATA[' . $v->name . ']]></Description>
      <PicUrl><![CDATA[picurl]]></PicUrl>
      <Url><![CDATA[' . $url . ']]></Url>
    </item>
  </Articles>
</xml>';
                    echo $res;
                }


            }
        }

    }

    public function goods(Request $request)
    {
        $id = $request->get('id');
        $res = GoodsModel::where(['id' => $id])->first();
        //计算签名
        $nonceStr = Str::random(10);
        $ticket = getJsapiTicket();
        $timestamp = time();
        $current_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $string1 = "jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$current_url";
        $sign = sha1($string1);
        $js_config = [
            'appId' => env('WX_APP_ID'),        //公众号APPID
            'timestamp' => $timestamp,
            'nonceStr' => $nonceStr,   //随机字符串
            'signature' => $sign,                      //签名
        ];
        $data = [
            'jsconfig' => $js_config
        ];
        return view('weixin.js', $data,['res'=>$res]);


    }

    public function prower(){
       $url=urlEncode('http://1809wanglei.comcto.com/geturl');
      // return $url;
        $code='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WX_APP_ID').'&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect ';

    }
    public function geturl(){

     //   echo '<pre>';print_r($_GET);echo '</pre>';

        echo '<pre>';print_r($_GET);echo '</pre>';

        $code = $_GET['code'];

        //获取 access_token
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WX_APP_ID').'&secret='.env('WX_APP_SEC').'&code='.$code.'&grant_type=authorization_code';
        $response = json_decode(file_get_contents($url),true);

        echo '<pre>';print_r($response);echo '</pre>';
        $access_token = $response['access_token'];
        $openid = $response['openid'];
        //获取用户信息
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $user_info = json_decode(file_get_contents($url),true);

       // echo '<pre>';print_r($user_info);echo '</pre>';

       echo '<pre>';print_r($user_info);echo '</pre>';


        $openid=$user_info['openid'];
        $wx_id='oYL3b5krtrmqxlwXs0A_7cv4vaJg';
       $res= info::where(['openid'=>$user_info['openid']])->first();
     // echo $res;exit;
        if($res){
            echo '
<xml><ToUserName><![CDATA[' . $openid . ']]></ToUserName>
<FromUserName><![CDATA['.$wx_id.']]></FromUserName>
<CreateTime>' . time() . '</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[' . '欢迎回来 ' . $user_info['nickname'] . ']]></Content>
</xml>';
            echo '欢迎回来';
        }else{
            $info=[
                'openid'=>$user_info['openid'],
                'nickname'=>$user_info['nickname'],
                'sex'=>$user_info['sex'],
                'language'=>$user_info['language'],
                'city'=>$user_info['city'],
                'province'=>$user_info['province'],
                'country'=>$user_info['country'],
                'head'=>$user_info['headimgurl']
            ];
            info::insert($info);
            echo '
<xml><ToUserName><![CDATA[' . $openid . ']]></ToUserName>
<FromUserName><![CDATA['.$wx_id.']]></FromUserName>
<CreateTime>' . time() . '</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[' . '欢迎关注 ' . $user_info['nickname'] . ']]></Content>
</xml>';
            echo '欢迎关注';
        }


}
}