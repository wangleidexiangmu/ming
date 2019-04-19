<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <ul>

               <table border="1">
                   <tr>
                       <td>
                           订单id
                       </td>
                       <td>订单号</td>
                       <td>订单总价</td>
                       <td> 添加时间</td>
                       <td>支付方式</td>
                   </tr>
                   @foreach($list as $k=>$v)
                   <tr>
                       <td>
                           {{ $v['oid']  }}
                       </td>
                       <td>{{$v['order_sn']}}</td>
                       <td>{{$v['order_amount']}}</td>
                       <td>{{date("Y-m-d H:i:s",$v['add_time'])}}</td>
                       <td><a target="_blank" href="/pay/weixin?oid={{$v['oid']}}"> 微信支付 </a></td>
                   </tr>
                   @endforeach


               </table>



        </ul>
    </div>
</div>
</body>
</html>