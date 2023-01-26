<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KandidatController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      return view('kandidat.index');
  }

  public function fetchAll() {
    $kandidats = Kandidat::all();
    $output = '';
    if ($kandidats->count() > 0) {
      $output .= '<div class="table-responsive">
          <table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Visi</th>
                <th>Misi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>';
            $no = 1;
      foreach ($kandidats as $kandidat) {
        $output .= '<tr>
                <td>' . $no++ . '</td>
                <td><img src="storage/kandidats/' . $kandidat->foto . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $kandidat->name . '</td>
                <td>' . $kandidat->email . '</td>
                <td>' . $kandidat->nis . '</td>
                <td>' . $kandidat->kelas . '</td>
                <td style="text-transform: uppercase;">' . $kandidat->jurusan . '</td>
                <td>' . $kandidat->visi . '</td>
                <td>' . $kandidat->misi . '</td>
                <td>
                  <a href="#" id="' . $kandidat->id . '" class="mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editKandidatModal"><i class="bi-pencil-square h5 text-yellow"></i></a>

                  <a href="#" id="' . $kandidat->id . '" class="mx-1 deleteIcon"><i class="bi-trash h5 text-danger"></i></a>
                </td>
              </tr>';
      }
      $output .= '</tbody></table></div>';
      echo $output;
    } else {
      echo '<h1 class="text-center text-secondary my-5">Data Kandidat Tidak Tersedia!</h1>';
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);
    $file = $request->file('foto');
    if(Kandidat::where('nis', $request->nis)->first() == null && Kandidat::where('email', $request->email)->first() == null){
      $fileName = time() . '.' . $file->getClientOriginalExtension();
      $file->storeAs('public/kandidats', $fileName);
      $kandidatData = ['name' => $request->name, 'email' => $request->email, 'nis' => $request->nis, 'kelas' => $request->kelas, 'jurusan' => $request->jurusan, 'visi' => $request->visi, 'misi' => $request->misi, 'foto' => $fileName];
      Kandidat::create($kandidatData);
      return response()->json([
        'status' => 200,
      ]);
    }
    return response()->json([
      'status' => 404,
    ]);
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request) {
    $id = $request->id;
    $kandidat = Kandidat::find($id);
    return response()->json($kandidat);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request) {
    $fileName = '';
    $kandidat = Kandidat::find($request->kandidat_id);
    if(!($request->nis != $kandidat->nis xor Kandidat::where('nis', $request->nis) == null) && !($request->email != $kandidat->email xor Kandidat::where('email', $request->email) == null)){
      if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/kandidats', $fileName);
        if ($kandidat->foto) {
          Storage::delete('public/kandidats/' . $kandidat->foto);
        }
      } else {
        $fileName = $request->kandidat_foto;
      }
  
      $kandidatData = ['name' => $request->name, 'email' => $request->email, 'nis' => $request->nis, 'kelas' => $request->kelas, 'jurusan' => $request->jurusan, 'visi' => $request->visi, 'misi' => $request->misi, 'foto' => $fileName];
  
      $kandidat->update($kandidatData);
      return response()->json([
        'status' => 200,
      ]);
    } else{
      return response()->json([
        'status' => 404,
      ]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function delete(Request $request) {
    $id = $request->id;
    $kandidat = Kandidat::find($id);
    if ($kandidat->foto) {
      Storage::delete('public/kandidats/' . $kandidat->foto);
      Kandidat::destroy($id);
    }
        return response()->json([
      'status' => 200,
    ]);
  }

  public function deleteAll(Request $request) {
    $kandidats = Kandidat::all();
    foreach($kandidats as $kandidat) {
        if ($kandidat->foto) {
            Storage::delete('public/kandidats/' . $kandidat->foto);
        }
    }
    Kandidat::truncate();
        return response()->json([
      'status' => 200,
    ]);
  }
}
