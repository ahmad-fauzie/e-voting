<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waktu;
use DateTime;

class WaktuController extends Controller
{
    public function index()
    {
        return view('waktu.index');
    }

    public function fetchAll()
    {
        $waktus = Waktu::all();
        $output = '';
      if ($waktus->count() > 0) {
        $output .= '<div class="table-responsive">
              <table class="table table-striped table-sm text-center align-middle">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Waktu Awal</th>
                  <th>Waktu Akhir</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>';
              $no = 1;
        foreach ($waktus as $waktu) {
          $output .= '<tr>
                  <td>' . $no++ . '</td>
                  <td>' . $waktu->waktu_awal . '</td>
                  <td>' . $waktu->waktu_akhir . '</td>
                  <td>
                    <a href="#" id="' . $waktu->id . '" class="mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editWaktuModal"><i class="bi-pencil-square h5 text-yellow"></i></a>

                    <a href="#" id="' . $waktu->id . '" class="mx-1 deleteIcon"><i class="bi-trash h5 text-danger"></i></a>
                  </td>
                </tr>';
        }
        $output .= '</tbody></table></div>';
      } else {
        $output = '<h1 class="text-center text-secondary my-5">Jadwal Pemilihan Tidak Tersedia!</h1>';
      }

      return response()->json([
        'status' => 200,
        'data' => $output,
        'count' => $waktus->count(),
      ]);
    }

    public function store(Request $request){
      if($request->awal != $request->akhir){
        $waktuData = ['waktu_awal' => $request->awal, 'waktu_akhir' => $request->akhir];
        Waktu::create($waktuData);
        return response()->json([
          'status' => 200,
        ]);
      }
      return response()->json([
        'status' => 404,
      ]);
    }

    public function edit(Request $request)
    {
      $id = $request->id;
      $waktu = Waktu::find($id);
      $awal = (new DateTime($waktu->waktu_awal))->format('Y-m-d');
      $akhir = (new DateTime($waktu->waktu_akhir))->format('Y-m-d');

      $data = [
        'id' => $waktu->id,
        'waktu_awal' => $awal,
        'waktu_akhir' => $akhir,
      ];
      return response()->json($data);
    }

    public function update(Request $request)
    {
      if($request->awal != $request->akhir){
        $waktu = Waktu::find($request->waktu_id);
        $waktuData = ['waktu_awal' => $request->awal, 'waktu_akhir' => $request->akhir];
  
        $waktu->update($waktuData);
        return response()->json([
          'status' => 200,
        ]);
      }
      return response()->json([
        'status' => 404,
      ]);
    }

    public function delete(Request $request) {
      $id = $request->id;
          Waktu::destroy($id);
          return response()->json([
        'status' => 200,
      ]);
    }

}
