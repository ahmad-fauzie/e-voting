<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Hasil;
use App\Imports\SiswaImport;
use App\Exports\SiswaExport;
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
        $user = User::all();
        if($siswa->id_user != ''){
          return response()->json([
            'status' => 404,
            'siswa' => $siswa,
            'message' => 'Data Ini Sudah Terdaftar!',
          ]);
        }
        return response()->json([
          'status' => 200,
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
          return response()->json([
            'status' => 200,
          ]);
        } else if(User::find($siswa->id_user == null) && (!(($request->nis != $siswa->nis) xor Siswa::where('nis', $request->nis)->first() == null) && !(($request->email != $siswa->email) xor Siswa::where('email', $request->email)->first() == null))){
          $user = User::find($siswa->id_user);
          $siswa->update($siswaData);
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
      User::where('level', 'siswa')->delete();
      Siswa::truncate();
      return response()->json([
        'status' => 200,
      ]);
    }
}
