<?php

namespace App\Http\Controllers\Goods;
use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    public function goods(){
       $goods= GoodsModel::get();
       return view('goods.goods',['goods'=>$goods]);
    }
    public function goodsdetail(Request $request){

       $id= $request->get('id');
       // var_dump($id);exit;
        $goods= GoodsModel::where(['id'=>$id])->first();
       $ask_num=$goods->ask_num;
       $ask_num=$ask_num+1;
       // echo $ask_num;exit;
        $num=GoodsModel::where(['id'=>$id])->update(['ask_num'=>$ask_num]);
        //var_dump($num);exit;
        return view('goods.goodsdetail',['goods'=>$goods]);
    }
    /*
      * 商品详情
      * */
    public function ask(){
        $goods_id = intval($_GET['id']);
//        print_r($goods_id);
        $key = $goods_id;
        $redis_view_keys = 'ss:goods:view';  //获取商品浏览排名
//        print_r($redis_view_keys);
        $history = Redis::incr($key);  //商品浏览次数
//        echo $history;die;
        Redis::zAdd($redis_view_keys,$history,$goods_id);

        $arr = GoodsModel::where(['id'=>$goods_id])->first();
//         var_dump($arr);die;
        if($arr){
            GoodsModel::where(['id'=>$goods_id])->update(['ask_num'=>$arr['ask_num']+1]);//0
        }else{
            $detail = [
                'ask_num'=> $arr['ask_num'] +1,
            ];
            GoodsModel::insertGetId($detail);
        }

//        //哈希
//        $redis_key = 'h:goods_info'.$goods_id;
//        $cache_info = Redis::hGetAll($redis_key);
////        print_r($cache_info);
//        if ($cache_info){
////            echo '有';
//        }else{
////            echo '无';
//            $goods_info = GoodsModel::where(['id'=>$goods_id])->first()->toArray();
////            echo '<pre>';print_r($goods_info);echo '</pre>';echo '<hr>';
//            Redis::hMset($redis_key,$goods_info);
//        }

        $list1 = Redis::Zrangebyscore($redis_view_keys,0,10000,['withscores'=>true]);  //正序
//        echo '<pre>';print_r($list1);echo '</pre>';echo '<hr>';
        $list2 = Redis::Zrevrange($redis_view_keys,0,10000,true);  //倒序
     //  echo '<pre>';print_r($list2);echo '</pre>';echo '<hr>';

        //浏览历史
        $info = [];
        foreach ($list2 as $k=>$v){
            $info[] = GoodsModel::where(['id'=>$k])->first()->toArray();
//            print_r($info);
        }

        $arr = GoodsModel::where('id',$goods_id)->get();

        return view('goods.goodsdetail',['arr'=>$arr,'info'=>$info]);
    }

}
