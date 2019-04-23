<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use function Symfony\Component\Console\Tests\Command\createClosure;

class JsController extends Controller
{
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
    public function getImg()
    {
        echo '<pre>';print_r($_GET);echo '</pre>';
    }
    public function downlodimg($dir,$serverId){
        $access_token=get_access_token();
        $Folder=ROOT_PATH.'/logs/'.$dir."/".date('Y-m');
        if(!file_exists($Folder)){
            createFolder($Folder);
        }
        $filename="bm_".rand(1,100).('YmdHis').'.jpg';
        $filedir='logs/'.$dir."/".data('Y-m');
        $strgetName=$Folder."/".$filename;
        
    }
}
