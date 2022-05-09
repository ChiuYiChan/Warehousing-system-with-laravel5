<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//use App\Models\Entity\User;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller{
    public function signUpPAge(){
        return view('user.signUp');
    }
    public function signUpProcess(){
        $input = request()->all();
        $rules =[
            'email'=>['max:100'],
            'psw'=>['min:6','alpha_num']
        ];
        $validator = Validator::make( $input,$rules );
        if($validator->fails()){
            return redirect('/user/sign-up')->withErrors($validator);
        };
        $oldCheck = DB::table('user')->where('userName', $input['email']);
        if(count($oldCheck)==0){
            //User::create($input);
            if (DB::insert('insert into user(userName, userPasswd) values (?, ?)', [$input['email'], sha1($input['psw'])])){
                return redirect('/user/sign-in');
            }else{
                return redirect('/user/sign-up');
            }
        }else{
            $error_message =[
                'msg'=>[
                    '帳號名稱已被使用',
                ],
            ];
            return redirect('/user/sign-up')->withErrors($error_message);
        }

    }
    public function signInPAge(){
        return view('user.signIn');
    }
    public function signInProcess(){
        $input = request()->all();
        $rules =[
            'email'=>['max:100'],
            'psw'=>['min:6','alpha_num']
        ];
        $validator = Validator::make( $input,$rules );
        if($validator->fails()){
            return redirect('/user/sign-in')->withErrors($validator)->withInput();
        };
        $psw = DB::table('user')->where('userName', $input['email'])->value('userPasswd');

        if($psw==sha1($input['psw'])){
            session()->put('userID', $input['email']);
            return redirect('/whrecord');
        }else{
            $error_message =[
                'msg'=>[
                    '密碼驗證錯誤',
                ],
            ];
            return redirect('/user/sign-in')->withErrors($error_message);
        }

    }
    public function signOut(){
        session()->forget('userID');
        return redirect('/user/sign-in');
    }
}