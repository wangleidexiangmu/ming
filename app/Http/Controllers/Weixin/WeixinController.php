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
use App\Model\weixin\tmp_wx_users;
use GuzzleHttp\Client;
class WeixinController extends Controller
{
    public function valid()
    {
        echo $_GET['echostr'];
    }
    //获取微信用户信息
    public function getUserInfo($openid)
    {
        $token=getWxAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
        // var_dump($url);exit;
        $data = file_get_contents($url);
        $u = json_decode($data,true);
        return $u;
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
        $eventkey=$data->EventKey;//二维码
        $picurl='http://image.baidu.com/search/detail?ct=503316480&z=0&ipn=d&word=%E5%9B%BE%E7%89%87jpg&hs=2&pn=0&spn=0&di=78031135380&pi=0&rn=1&tn=baiduimagedetail&is=0%2C0&ie=utf-8&oe=utf-8&cl=2&lm=-1&cs=2322346566%2C2175418725&os=1836096180%2C2499822995&simid=0%2C0&adpicid=0&lpn=0&ln=30&fr=ala&fm=&sme=&cg=&bdtype=0&oriquery=%E5%9B%BE%E7%89%87jpg&objurl=http%3A%2F%2Fimg.jieju.cn%2Fuserfiles%2Fupload%2Fimage%2F20180820%2F6367035969868343062045193.jpg&fromurl=ippr_z2C%24qAzdH3FAzdH3Fooo_z%26e3B3tj37_z%26e3BvgAzdH3FNjofAzdH3Fda8babdaAzdH3FDjpwtsbacl9c_z%26e3Bfip4s&gsm=0&islist=&querylist=';
        $url='http://1809wanglei.comcto.com/puball';

        if ($event == 'SCAN') {        //扫码关注事
            $local_user = tmp_wx_users::where(['openid' => $openid])->first();
            if ($local_user) {
                $t = "商品";
                $m = "商品详情";
                echo '
<xml>
<ToUserName><![CDATA[' . $openid . ']]></ToUserName>
<FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
<CreateTime>' . time() . '</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[' . $t . ']]></Title>
<Description><![CDATA[' . $m . ']]></Description>
<PicUrl><![CDATA[' . $picurl . ']]></PicUrl>
<Url><![CDATA[' . $url . ']]></Url>
</item>
</Articles>
</xml>';
            } else {
                $t = "商品";
                $m = "商品详情";
                //获取用户信息
                $u = $this->getUserInfo($openid);
                //用户信息入库
                $u_info = [
                    'openid' => $u['openid'],
                    'nickname' => $u['nickname'],
                    'sex' => $u['sex'],
                    'headimgurl' => $u['headimgurl'],
                    'eventkey' => substr($eventkey, 8),
                ];
                $id = tmp_wx_users::insertGetId($u_info);
                echo '
<xml>
<ToUserName><![CDATA[' . $openid . ']]></ToUserName>
<FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
<CreateTime>' . time() . '</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[' . $t . ']]></Title>
<Description><![CDATA[' . $m . ']]></Description>
<PicUrl><![CDATA[' . $picurl . ']]></PicUrl>
<Url><![CDATA[' . $url . ']]></Url>
</item>
</Articles>
</xml>';
            }
        }//else if ($eventkey == ''&& $event == 'subscribe') {
//               //根据openid判断用户是否已存在
//               $local_user = weixin::where(['openid' => $openid])->first();
//              if ($local_user) {
//                  //用户之前关注过
//                   echo '
//                   <xml>
//                   <ToUserName><![CDATA['.$openid.']]></ToUserName>
//                  <FromUserName><![CDATA['.$wx_id.']]></FromUserName>
//                   <CreateTime>'.time().'</CreateTime>
//                  <MsgType><![CDATA[text]]></MsgType>
//                  <Content><![CDATA['.'欢迎回来 '.$local_user['nickname'].']]></Content>
//                   </xml>';
//
//               } else {
//                   //获取用户信息
//                   $u = $this->getUserInfo($openid);
//                   //用户信息入库
//                   $u_info = [
//                        'openid' => $u['openid'],
//                      'nickname' => $u['nickname'],
//                       'sex' => $u['sex'],
//                        'headimgurl' => $u['headimgurl'],
//                    ];
//                  $id = weixin::insertGetId($u_info);
//                   echo '
//                   <xml>
//                   <ToUserName><![CDATA['.$openid.']]></ToUserName>
//                   <FromUserName><![CDATA['.$wx_id.']]></FromUserName>
//                   <CreateTime>'.time().'</CreateTime>
//                    <MsgType><![CDATA[text]]></MsgType>
//                   <Content><![CDATA['.'欢迎关注'.$u['nickname'].']]></Content>
//                   </xml>';
//               }
//            }










        if ($type == 'text') {
            $txt = $data->Content;//文本信息
            // var_dump($txt);exit;
            $shop =GoodsModel::where(['name'=>$txt])->get();
            if($shop) {
                $shop =GoodsModel::where(['name'=>$txt])->first();
                $id=$shop['id'];
                $url = 'http://1809wanglei.comcto.com/jump?id=$id';
                    $res = '<xml>
  <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
  <FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
  <CreateTime>' . time() . '</CreateTime>
  <MsgType><![CDATA[news]]></MsgType>
  <ArticleCount>1</ArticleCount>
  <Articles>
    <item>
      <Title><![CDATA[' . $shop['name'] . ']]></Title>
      <Description><![CDATA['.$shop['name'].']]></Description>
      <PicUrl><![CDATA[picurl]]></PicUrl>
      <Url><![CDATA['.$url.']]></Url>
    </item>
  </Articles>
</xml>';
echo $res;
            }else {

            $goods= GoodsModel::where(['id'=>1])->first();

                $url = 'http://1809wanglei.comcto.com/jump?id=1';
                    $res = '<xml>
<ToUserName><![CDATA['.$openid.']]></ToUserName>
<FromUserName><![CDATA['.$wx_id.']]></FromUserName>
<CreateTime>'.time().'</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
  <Title><![CDATA['.$goods['name'].']]></Title>
  <Description><![CDATA['.$goods['name'].']]></Description>
  <PicUrl><![CDATA[picurl]]></PicUrl>
  <Url><![CDATA['.$url.']]></Url>
</item>
</Articles>
</xml>';
                    echo $res;

            }
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
                    $res = '<xml>
  <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
  <FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
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
        return view('weixin.js', $data,['res'=>$res],['id'=>$id]);


    }

    public function prower(){
       $url=urlEncode('http://1809wanglei.comcto.com/geturl');
      // return $url;
        $code='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WX_APP_ID').'&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect ';

    }
    public function geturl(){

     //   echo '<pre>';print_r($_GET);echo '</pre>';

       // echo '<pre>';print_r($_GET);echo '</pre>';

        $code = $_GET['code'];

        //获取 access_token
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WX_APP_ID').'&secret='.env('WX_APP_SEC').'&code='.$code.'&grant_type=authorization_code';
        $response = json_decode(file_get_contents($url),true);

        //echo '<pre>';print_r($response);echo '</pre>';
        $access_token = $response['access_token'];
        $openid = $response['openid'];
        //获取用户信息
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $user_info = json_decode(file_get_contents($url),true);

       // echo '<pre>';print_r($user_info);echo '</pre>';

       //echo '<pre>';print_r($user_info);echo '</pre>';


        $openid=$user_info['openid'];
        $wx_id='oYL3b5krtrmqxlwXs0A_7cv4vaJg';
       $res= info::where(['openid'=>$user_info['openid']])->first();
     // echo $res;exit;
        if($res){
            echo '
<xml><ToUserName><![CDATA['.$openid.']]></ToUserName>
<FromUserName><![CDATA['.$wx_id.']]></FromUserName>
<CreateTime>'.time().'</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA['.'欢迎回来'.$user_info['nickname'].']]></Content>
</xml>';
            echo '欢迎回来';
            header('Refresh:3;url=/order/list');
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
<xml><ToUserName><![CDATA['.$openid.']]></ToUserName>
<FromUserName><![CDATA['.$wx_id.']]></FromUserName>
<CreateTime>'.time().'</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA['.'欢迎关注'.$user_info['nickname'].']]></Content>
</xml>';
            echo '欢迎关注';
            header('Refresh:3;url=/order/list');
        }


}
    public function card(){
        $token=getWxAccessToken();
        $res='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token.'';
        $arrInfo =[
            "button"=>[
                [
                    "type"=>"view",
                    "name"=>"最新福利",
                    "url"=>"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxe750a38a8fe84b93&redirect_uri=http%3A%2F%2F1809wanglei.comcto.com%2Fgeturl&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect",
                ],

            ] ,
        ];


        $data=json_encode($arrInfo,JSON_UNESCAPED_UNICODE);//处理中文编码
        //发送请求
        $clinet= new Client();
        //发送json字符串
        $response=$clinet->request('POST',$res,[
            'body'=>$data
        ]);
        //处理相应
        $reslut=$response->getBody();
        //转数组
        $arr = json_decode($reslut,true);
        //判断错误信息


    }
//    public function url(){
//        $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxe750a38a8fe84b93&redirect_uri=http%3A%2F%2F1809wanglei.comcto.com%2Fgeturl&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
//    }
}