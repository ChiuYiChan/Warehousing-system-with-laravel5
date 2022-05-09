@extends('layout.main')
@section('styles')
<style>
    .table{
        margin-top:7%;
    }
    .hidden{
        visibility:hidden;
    }
    .visible:hover .hidden{
        visibility:visible;
    }
    #dailog{
        display:none;
        position:absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%,-50%);
        z-index: 5;
        background:#0B1013;
        width:50%;
        height:300px;
        min-width:300px;
    }
    #dailog table{
        width: 200px;
        margin: 0 auto;
    }
    span{
      	font-size:20px;
        color: #434343;
      	position: relative;
        left: 80%;
        top: 10%;
    }
    table input[type="number"],select{
        outline: 0;
        color: #fff;
        width: 100px;
        height:30px;
        border: 1px solid rgba(0,0,0,.5);
        background: #171717;
        margin: 0 auto 20px auto;
    }
    table input[type="text"]{
        outline: 0;
        color: #fff;
        width: 220px;
        height:30px;
        border: 1px solid rgba(0,0,0,.5);
        background: #171717;
        margin: 0 auto 20px auto;
    }
    table input[type="submit"]{
        outline: 0;
        color: #fff;
        height:30px;
        border: 1px solid rgba(0,0,0,.5);
        background: #434343;
    }
    #addNew{
        position: fixed;
        z-index: 3;
        top: 10%;
        right: 10%;
        width: 100px;
        height: 100px;
    }
    </style>
<script type="text/javascript" src="{{asset('assets/js/warehouse.js')}}"></script>
@endsection
@section('content')
<div id='addNew'>
    <input type="image" name="addNew_btn" src="{{ asset('assets/img/add.png') }}" width="40px"  onclick='addNew()'>
</div>
<table class="table table-hover table-dark">
    <thead>
        <tr>
            <th scope="col">編號</th>
            <th scope="col">名稱</th>
            <th scope="col">單價</th>
            <th scope="col">數量</th>
            <th scope="col">總金額</th>
            <th scope="col">備註</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inRows as $row)
        <tr class="visible">
            <td>{{$row->mcode}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->price}}</td>
            <td>{{$row->num}}</td>
            <td>{{$row->num*$row->price}}</td>
            <td>{{$row->remark}}
                <div class="hidden">
                    <form action="/whrecord/restock/restock-revision" method="post" style="display:inline;">
                        {!! csrf_field() !!}
                        <input type="hidden" name="mid" value="{{$row->id}}">
                        <input type="image" src="{{ asset('assets/img/revision.png') }}" width="22px">
                    </form>
                    <form action="/whrecord/restock/delete" method="post" style="display:inline;" onSubmit="return checkAgain()">
                        {!! csrf_field() !!}
                        <input type="hidden" name="mid" value="{{$row->id}}">
                        <input type="image" name="submit" src="{{ asset('assets/img/delete.png') }}" width="22px">
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
<div id='dailog'>
<form action='/whrecord/shipment' method='post'>
    {!! csrf_field() !!}
    <table>
        <span onclick="closedlg()">x</span>
        <tr>
            <td colspan="2"><h3>ADD</h3></td>
        </tr>
        <tr>
            <td width="50%">
                <label for='merchandise'>品項</label>
                <select name="merchandise">
                    @foreach($merchdRow as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </td>
            <td width='50%'>
                <label for='num'>數量</label>
                <input type="number"  name="num" min=0>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for='remark'>備註</label>
                <input type="text" name="remark">
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="submit" value="submit"></td>
        </tr>
    </table>
</form>
</div>
@endsection

