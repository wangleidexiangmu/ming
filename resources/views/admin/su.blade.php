
<tabel border="1">
        <tr>
            <td>图片</td>
        </tr>
@foreach( $res as $v)
    <tr>
        <td>{{$v->image}}</td>
    </tr>
    @endforeach
    </tabel>
