<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Hasil;
use App\Models\Kandidat;
use App\Models\Waktu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jumlah = Siswa::count();
        $vote = Hasil::count();
        $notVote = $jumlah - $vote;
        $kandidat = Kandidat::count();
        return view('dashboard.index', compact(['jumlah', 'vote', 'notVote', 'kandidat']));
    }
}
