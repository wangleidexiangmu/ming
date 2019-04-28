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
}
