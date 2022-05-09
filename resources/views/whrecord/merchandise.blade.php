
@extends('layout.main')


@section('styles')
    <style>
        .box{
        	background:#0B1013;
        	width:90%;
            max-width:300px;
            height:300px;
        }
        .topCenter{
        	width:70%;
            height:auto;
            margin:0 auto;
        }
		.topCenter>img{
        	margin-top:10%;
        	width:100%;
            height:120px;
        }
        .center{
        	text-align:center;
        	margin:10% auto;
        	width:70%;
            height:50%;
        }
        
    </style>
@endsection

@section('content')
<div style='margin-top:100px;'>

    <div class="container">
        <?php 
           $count=0;
        ?>
         @foreach($mhRows as $row)
            <?php 
                $count++;
                if($count%3==1) echo"<div class='row'>";
            ?>
            <div class="col-4">
                <div class='box'>
                    <div class='topCenter'>
                        <img href='#'>
                    </div>
                    <div class='center'>
                        <p>{{$row->name}}</p>
                        <p>{{$row->mcode}}</p>
                        <p>price {{$row->price}}$</p>
                    </div>
                </div>
            </div>
            <?php 
                if($count%3==0) echo"</div>";
            ?>
        @endforeach
    </div>
</div>
@endsection