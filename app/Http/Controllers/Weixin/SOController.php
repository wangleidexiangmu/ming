<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
class SOController extends Controller
{

    public function so(){
        $token=getWxAccessToken();
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token.'';
        $data=[
            "action_name"=>"QR_LIMIT_SCENE",
            "action_info"=>[
                "scene"=>[
                    "scene_id"=>"123"
                ]
            ]
        ];
            $json=json_encode($data);
            $client= new Client();
            $response=$client->request('POST',$url,['body'=>$json]);
            $arr=json_decode($response->getBody(),true);
        $res='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.UrlEncode($arr['ticket']).'';
        echo $res;
    }
    public function puball(){
        return view('weixin.js');
    }
    public function jstest(){
        //计算签名
        $nonceStr = Str::random(10);
        $ticket = getJsapiTicket();
        $timestamp = time();
        $current_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
        $string1 = "jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$current_url";
        $sign = sha1($string1);
        $js_config = [
            'appId' => env('WX_APP_ID'),        //公众号APPID
            'timestamp' => $timestamp,
            'nonceStr' => $nonceStr,   //随机字符串
            'signature' => $sign,                      //签名
        ];
        $data = [
            'jsconfig'  => $js_config
        ];
        return view('weixin.js',$data);
    }
}
