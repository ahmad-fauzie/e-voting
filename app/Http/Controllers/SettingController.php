<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){
        return view('setting.index');
    }

    public function fetchUser(){
        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'password' => $user->password,
        ]);
    }

    public function update(Request $request){
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email,'.$userId]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 404,
                'message' => 'Email Sudah Digunakan!',
            ]);
        }
        $userData = ['name' => $request->name, 'email' => $request->email];
        User::whereId(Auth::user()->id)->update($userData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function updatePassword(Request $request){
        if(!Hash::check($request->lama, Auth::user()->password)){
            return response()->json([
                'status' => 404,
                'message' => 'Password Lama Tidak Sesuai!',
            ]);
        }
        if(strcmp($request->lama, $request->baru) == 0){
            return response()->json([
                'status' => 404,
                'message' => 'Password Baru Harus Berbeda Dengan Password Lama!',
            ]);
        }
        $user = User::find(Auth::user()->id);
        $user->update(['password' => Hash::make($request->baru)]);
        return response()->json([
            'status' => 200,
        ]);
        
    }
}
