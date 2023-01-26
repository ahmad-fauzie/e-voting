<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kandidat;
use App\Models\Waktu;
use App\Models\Message;
use App\Models\Hasil;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        return view('setting.index');
    }

    public function deleteVoting(){
        Hasil::truncate();
        return response()->json([
            'status' => 200,
        ]);
    }

    public function deleteAll(){
        User::where('level', 'siswa')->delete();
        Siswa::truncate();
        Kandidat::truncate();
        Storage::deleteDirectory('public/kandidats');
        Waktu::truncate();
        Message::truncate();
        Hasil::truncate();
        return response()->json([
            'status' => 200,
        ]);
    }
}
