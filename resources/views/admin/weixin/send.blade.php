<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<form action="send" method="post">
    <table border="1">
        <tr>
            <td>请选择</td>
            <td>
                id
            </td>
            <td>
                openid
            </td>
            <td>昵称</td>

        </tr>
        @foreach($userlist as $v)
            <tr>
                <td><input type="checkbox" name="id" value="{{$v['w_id']}}"></td>
                <td>{{$v['w_id']}}</td>
                <td>
                    {{$v['openid']}}
                </td>
                <td>{{$v['nickname']}}</td>
            </tr>
        @endforeach
    </table>
   发送内容 <input type="text" name="txt"><br>
    <input type="submit" value="提交">
</form>
</body>
</html>
