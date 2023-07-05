<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kandidat;
use App\Models\User;
use App\Models\Hasil;
use App\Imports\SiswaImport;
use App\Exports\SiswaExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('siswa.index');
    }

    public function fetchAll() {
		$siswas = Siswa::all();
		$output = '';
		if ($siswas->count() > 0) {
			$output .= '<div class="table-responsive">
            <table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>';
            $no = 1;
			foreach ($siswas as $siswa) {
        $badge = $siswa->status == 'Sudah Memilih' ? 'success' : 'danger';
				$output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $siswa->name . '</td>
                <td>' . $siswa->nis . '</td>
                <td>' . $siswa->email . '</td>
                <td><span class="badge bg-' . $badge . '">' . $siswa->status . '</span></td>
                <td>
                  <a href="#" id="' . $siswa->id . '" class="mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editSiswaModal"><i class="bi-pencil-square h5 text-yellow"></i></a>

                  <a href="#" id="' . $siswa->id . '" class="mx-1 deleteIcon"><i class="bi-trash h5 text-danger"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table></div>';
		} else {
			$output = '<h1 class="text-center text-secondary my-5">Data Siswa Tidak Tersedia!</h1>';
		}
    return response()->json([
      'data' => $output,
    ]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
      return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeImport(Request $request)
    {
        $this->validate($request, [
            'siswa' =>  'required'
        ]);
    
        Excel::import(new SiswaImport, $request->file('siswa'));

        return response()->json([
          'status' => 200,
        ]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' =>  'required',
        'email' => 'required',
        'nis' => 'required'
      ]);

      if(Siswa::where('nis', $request->nis)->first() == null && Siswa::where('email', $request->email)->first() == null){
        $siswaData = ['id_user' => '', 'name' => $request->name, 'email' => $request->email, 'nis' => $request->nis, 'status' => 'Belum Memilih'];
        Siswa::create($siswaData);
        return response()->json([
          'status' => 200,
        ]);
      }
      return response()->json([
        'status' => 404,
      ]);

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
    public function edit(Request $request)
    {
        $id = $request->id;
        $siswa = Siswa::find($id);
        // $kandidat = Kandidat::all();
        $user = User::all();
        $id_kandidat = '';
        if(Kandidat::where('email', $siswa->email)->where('nis', $siswa->nis)->first() != null){
          $kandidats = Kandidat::where('email', $siswa->email)->where('nis', $siswa->nis)->first();
          $kandidat = Kandidat::find($kandidats->id);
          $id_kandidat = $kandidat->id;
        }
        if($siswa->id_user != ''){
          return response()->json([
            'status' => 406,
            'siswa' => $siswa,
            'kandidat' => $id_kandidat,
            'message' => $id_kandidat != '' ? 'Data Ini Sudah Terdaftar Dan Menjadi Kandidat!' : 'Data Ini Sudah Terdaftar!',
          ]);
        }
        else if($siswa->id_user == '' && $id_kandidat != ''){
          return response()->json([
            'status' => 406,
            'siswa' => $siswa,
            'kandidat' => $id_kandidat,
            'message' => 'Data Ini Sudah Terdaftar Sebagai Kandidat!',
          ]);
        }
        return response()->json([
          'status' => 200,
          'kandidat' => $id_kandidat,
          'siswa' => $siswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $siswa = Siswa::find($request->siswa_id);

      $siswaData = ['name' => $request->name, 'email' => $request->email, 'nis' => $request->nis];
        if(User::find($siswa->id_user != null) && (!(($request->nis != $siswa->nis) xor User::where('nis', $request->nis)->first() == null) && !(($request->email != $siswa->email) xor User::where('email', $request->email)->first() == null)) && (!(($request->nis != $siswa->nis) xor Siswa::where('nis', $request->nis)->first() == null) && !(($request->email != $siswa->email) xor Siswa::where('email', $request->email)->first() == null))){
          $user = User::find($siswa->id_user);
          $siswa->update($siswaData);
          $user->update($siswaData);
          if($request->siswa_id_kandidat != ''){
            $kandidat = Kandidat::find($request->siswa_id_kandidat);
            $kandidat->update($siswaData);
          }
          return response()->json([
            'status' => 200,
          ]);
        } else if(User::find($siswa->id_user == null) && (!(($request->nis != $siswa->nis) xor Siswa::where('nis', $request->nis)->first() == null) && !(($request->email != $siswa->email) xor Siswa::where('email', $request->email)->first() == null))){
          $user = User::find($siswa->id_user);
          $siswa->update($siswaData);
          if($request->siswa_id_kandidat != ''){
            $kandidat = Kandidat::find($request->siswa_id_kandidat);
            $kandidat->update($siswaData);
          }
          return response()->json([
            'status' => 200,
          ]);
        } else{
          return response()->json([
            'status' => 404,
          ]);
        }
    }

    public function delete(Request $request) {
      $siswa = Siswa::find($request->id);
      $user = User::find($siswa->id_user);
      $hasil = Hasil::where('id_user', $siswa->id_user)->first();
      if($user != null){
        User::destroy($user->id);
      }
      if($hasil != null){
        Hasil::destroy($hasil->id);
      }
      Siswa::destroy($siswa->id);
      return response()->json([
        'status' => 200,
      ]);
    }

    public function deleteAll(Request $request) {
      $count = Hasil::whereIn('id_user', function($query) {
        $query->select('id_user')->from('siswas');
      })->count();
      if ($count > 0) {
        Hasil::whereIn('id_user', function($query) {
          $query->select('id_user')->from('siswas');
        })->delete();
      }
      User::where('level', 'siswa')->delete();
      Siswa::truncate();
      return response()->json([
        'status' => 200,
      ]);
    }
}
