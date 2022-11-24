<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Siswa;
use App\Models\Hasil;
use App\Models\Waktu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('voting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'id' =>  'required',
        ]);
        $hash = hash('sha512', $user->id . $request->id);
        $votingData = ['id_user' => $user->id, 'pesan' => $hash];
        Hasil::create($votingData); 

        $siswa = Siswa::where('id_user', $user->id)->firstOrFail();
        $siswaData = ['status' => 'Sudah Memilih'];
        $siswa->update($siswaData);

        return response()->json([
            'status' => 200,
            'id' => $request->id,
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
    public function edit($id)
    {
        //
    }

    public function info(){
        $user = Auth::user();
        $waktu = Waktu::all();
        $hasil = Hasil::all();
        $kandidats = Kandidat::all();
		$output = '';
		if ($kandidats->count() > 0) {
            foreach ($kandidats as $kandidat) {
				$output .= '<div class="card col-md-6" style="max-width: 500px; margin: auto; margin-top: 30px;">
                <div class="card"
                    style="align-items: center; padding:10px; margin:auto; margin-top:16px; text-transform: uppercase">
                    <div class="card-body" style="margin-bottom: -35px; text-align: center;">
                        <img src="storage/kandidats/' . $kandidat->foto . '"
                            class="card-img-top rounded" style="min-width: 50px; max-width: 150px"
                            alt="...">
                        <h6 class="card-title" style="margin-top:10px;">' . $kandidat->name . '</h6>
                        <p>' . $kandidat->kelas . ' '  . $kandidat->jurusan . '</p>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Visi</h5>
                    <p class="card-text">' . $kandidat->visi . '</p>
                    <h5 class="card-title">Misi</h5>
                    <p class="card-text">' . $kandidat->misi . '</p>
                </div>
                <div class="card-footer">';
                if($hasil->contains('id_user', $user->id)){
                    $output .= '<a href="#" class="btn btn-sm btn-danger" style="width: -moz-available; pointer-events: none;">Anda Sudah Memilih!</a>
                    </div>
                </div>';
                } else{
                    $output .= '<a href="#" id="' . $kandidat->id . '" class="btn btn-sm btn-success voting" style="width: -moz-available;">Pilih</a>
                        </div>
                    </div>';
                }
			}
		} else {
			$output = '<h1 class="text-center text-secondary my-5">Data Kandidat Tidak Tersedia!</h1>';
		}
        return response()->json([
			'status' => 200,
            'user'  => $user->id,
            'output' => $output,
            'waktu_count' => !$waktu->isEmpty(),
            'waktu' => $waktu->isEmpty() ? 0 : $waktu,
		]);
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
