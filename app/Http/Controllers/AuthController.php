<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function index(){
        if ($user = Auth::user()) {
            if ($user->level == 'admin') {
                return redirect()->intended('kandidat');
            } elseif ($user->level == 'siswa') {
                return redirect()->intended('voting ');
            }
        }
        return view('auth.login');
    }

    public function proses_login(Request $request){
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('email','password');

            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                if ($user->level == 'admin') {
                    return redirect()->intended('kandidat');
                } elseif ($user->level == 'siswa') {
                    return redirect()->intended('voting');
                }
                return redirect()->intended('/');
            }

        return redirect('/')
                                ->withInput()
                                ->withErrors(['login_gagal' => 'Email Dan Password Salah!']);
    }

    public function register(){
        if ($user = Auth::user()) {
            if ($user->level == 'admin') {
                return redirect()->intended('kandidat');
            } elseif ($user->level == 'siswa') {
                return redirect()->intended('voting ');
            }
        }
        return view('auth.register');
    }

    public function proses_register(Request $request){
        $request->validate(
        [
            'nama'  =>  'required',
            'nis'   =>  'required',
            'email' =>  'required',
            'password' => 'required|min:8',
        ]);
        $kredensil = $request->only('nis', 'email');

        // if(User::where('nis', $kredensil)->first() == null && Siswa::where('nis', $kredensil)->first() != null){
        if(!Auth::attempt($kredensil) && Siswa::where('nis', $request->nis)->first() != null && Siswa::where('email', $request->email)->first() != null){
            $data = $request->all();
            $check = $this->create($data);
            
            $kredensil1 = $request->only('email','password');

            if (Auth::attempt($kredensil1)) {
                $user = Auth::user();
                Siswa::where('nis', $kredensil)->update(['id_user' => $user->id]);
                if ($user->level == 'admin') {
                    return redirect()->intended('kandidat');
                } elseif ($user->level == 'siswa') {
                    return redirect()->intended('voting');
                }
                return redirect()->intended('/');
            }
        } else if(User::where('nis', $request->nis)->first() != null || User::where('email', $request->email)->first() != null){
            return redirect('daftar')
                                ->withInput()
                                ->withErrors(['register_gagal' => 'NIS atau Email sudah terdaftar!']);
        }else{
            return redirect('daftar')
                                ->withInput()
                                ->withErrors(['register_gagal' => 'Data Tidak Cocok!']);
        }
    }

    public function create (array $data){
        return User::create([
            'name'  =>  $data['nama'],
            'nis'   =>  $data['nis'],
            'email' =>  $data['email'],
            'password'  =>  Hash::make($data['password']),
            'level' =>  'siswa',
        ]);
    }

    public function logout(Request $request){
       $request->session()->flush();
       Auth::logout();
       return Redirect('/');
    }
}
