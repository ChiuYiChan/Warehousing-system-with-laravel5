<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//use App\Models\Entity\User;
use Illuminate\Support\Facades\DB;

class WarehouwRecordController extends Controller{
    public function statePage(){
        return view('whrecord.allState');
    }
    public function merchandisePage(){
        $row_per_page=6;
        $mhRows=DB::table('merchandise')->paginate($row_per_page);
        $binding=[
            'mhRows'=>$mhRows,
        ];
        return view('whrecord.merchandise',$binding);
    }
    public function inPage(){
        $row_per_page=12;
        $inRows=DB::table('whrecord')
        ->where('type', '1')
        ->join('merchandise','whrecord.merchandise','=','merchandise.id')
        ->select('merchandise.mcode','merchandise.name','merchandise.price','whrecord.*')
        ->get();
        $merchdRow=DB::table('merchandise')->select('id', 'name')->get();
        $binding=[
            'inRows'=>$inRows,
            'merchdRow'=>$merchdRow
        ];
        return view('whrecord.restock',$binding);
    }
    public function inReAction(){
        $input = request()->all();
        $result=DB::table('whrecord')->where('id',$input['mid'])->get();
        $merchdRow=DB::table('merchandise')->select('id', 'name')->get();
        $binding=[
            'result'=>$result,
            'merchdRow'=>$merchdRow
        ];
        return view('whrecord.restockRevision',$binding);
    }
    public function inReActionPage(){
        return view('whrecord.restockRevision');
    }
    public function inReProcess(){
        $input = request()->all();
        $rules =[
            'remark'=>['max:100']
        ];
        //資料格式驗證
        $validator = Validator::make( $input,$rules );
        if($validator->fails()){ //錯誤回傳搭配Error mesage
            return redirect('/whrecord/restock/restock-revision')->withErrors($validator);
        };
        DB::table('whrecord')
            ->where('id', $input['mid'])
            ->update(['merchandise' => $input['merchandise'], 'num' => $input['num']]);
        if($input['remark']!=''){
            DB::table('whrecord')
            ->where('id', $input['mid'])
            ->update(['remark' => $input['remark']]);
        };
        return redirect('/whrecord/restock');
    }
    public function inDelProcess(){
        $input = request()->all();
        DB::table('whrecord')->where('id', '=', $input['mid'] )->delete();
        return redirect('/whrecord/restock');
    }
    public function inAddProcess(){
        $input = request()->all();
        DB::insert('insert into whrecord(merchandise, num, type, remark) values (?, ?, ?, ?)', [$input['merchandise'], $input['num'],1, $input['remark']]);
        return redirect('/whrecord/restock');
    }
    public function outPage(){
        $inRows=DB::table('whrecord')
        ->where('type', '0')
        ->join('merchandise','whrecord.merchandise','=','merchandise.id')
        ->select('merchandise.mcode','merchandise.name','merchandise.price','whrecord.*')
        ->get();
        $merchdRow=DB::table('merchandise')->select('id', 'name')->get();
        $binding=[
            'inRows'=>$inRows,
            'merchdRow'=>$merchdRow
        ];
        return view('whrecord.shipment',$binding);
    }
    public function outAddProcess(){
        
    }
}