<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Hasil;
use App\Models\Siswa;
use App\Models\Waktu;
use App\Exports\HasilExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Carbon\Carbon;
use DB;
// use Excel;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hasil.index');
            
    }

    public function fetchAll(){
        $kandidats = Kandidat::all();
        $waktu = Waktu::all();
        $hasils = Hasil::all();
        $jumlah = $hasils->count();

        if($jumlah > 0){
            $voting = collect([]);
            foreach($hasils as $hasil){
                foreach($kandidats as $kandidat){
                    $hash = hash('sha512', $hasil->id_user . $kandidat->id);
                    if($hash == $hasil->pesan){
                        $voting->push(['id_user' => $hasil->id_user, 'id_kandidat' => $kandidat->id, 'name' => $kandidat->name]);
                    }
                }
            }
            
            $dataPoints = [];
            
            $group = $voting->groupBy('name')->map(function ($row, $key) {
                return [
                    'name'  => $key,
                    'total_usage'  => $row->count(),
                ];
            });

            foreach ($group as $grup) {
                    $dataPoints[] = [
                    'name' => $grup['name'],
                    'y' => floatval($grup['total_usage'])
                ];
            }
            
            $grup = $group->sortBy('total_usage', SORT_REGULAR, true);
            return response()->json([
                'status' => 200,
                'data' => count($dataPoints) == 0 ? 0 : $dataPoints,
                'waktu_count' => !$waktu->isEmpty(),
                'jumlah' => $jumlah,
                'waktu' => $waktu->isEmpty() ? 0 : $waktu,
                'grup' => $grup,
                'win' => $grup->first()['name'],
            ]);
        } 
        return response()->json([
            'status' => 200,
            'waktu_count' => !$waktu->isEmpty(),
            'waktu' => $waktu->isEmpty() ? 0 : $waktu,
            'jumlah' => $jumlah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $siswa = Siswa::all();
        $vote = Siswa::where('status', 'Sudah Memilih')->count();
        $notVote = Siswa::where('status', 'Belum Memilih')->count();
        $date = Carbon::now()->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $tanggal =  $date->format(', j F Y');
        $tahun = $date->format('Y');

        $data = [
            'gambar' => $request->gambar,
            'tanggal' => $tanggal,
            'tahun' => $tahun,
            'hasils' => $request->hasil,
            'siswa' => $siswa,
            'vote' => $vote,
            'notVote' => $notVote,
            'win' => $request->win,
        ];
        $pdf = PDF::loadView('hasil.pdf', $data);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('hasil.pdf');
    }

    public function upload(Request $request){
        $img = $request->svg;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
