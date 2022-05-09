<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>warehouse</title>
    <style>
        body{
            background:#1C1C1C;
            color: #947A6D;
        }
        .navbar-custom{
        	background:#0B1013;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-text,
        .nav-item a{
            color: #947A6D;
        }
        .main{
            width:400px;
            height:50%;
            margin:15% auto;
        }
        input,select{
            outline: 0;
            color: #fff;
            width: 300px;
            height:30px;
            border: 1px solid rgba(0,0,0,.5);
            background: rgba(0,0,0,.25);
			margin: 0 auto 20px auto;
        }
        input[type="submit"]{
            width: 110px;
            height:35px;
            margin: 0 auto;
            background: #666666;
        }
    </style>
</head>
<body>
    @include('components.validationErrorMessage')
    <div class="main">
    @foreach($result as $result)
        <form action="/whrecord/restock/revision" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="mid" value="{{$result->id}}">
            <div>
                <label for="merchandise">商品</label>
                <select name="merchandise">
                    @foreach($merchdRow as $row)
                        <option {{($row->id)==($result->merchandise) ? 'selected': '' }} value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="num">數量</label>
                <input type="number" name="num" value="{{$result->num}}" min="1" max="1000">
            </div>
            <div>
                <label for="remark">備註</label>
                <input type="text" name="remark" value="{{$result->remark}}">
            </div>
            <input type="submit" name="submit" value="submit">
        </form>
    @endforeach        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>