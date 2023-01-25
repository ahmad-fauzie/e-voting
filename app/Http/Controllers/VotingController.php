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
            $no = 0;
            foreach ($kandidats as $kandidat) {
                $output .= '<div class="col-12 col-md-4 mx-md-auto">
                <div class="card card-statistic">
                    <div class="card-body p-0 overflow-auto">
                        <div class="d-flex justify-content-center align-item-center text-center m-4" style="min-height: 150px;">
                            <img src="storage/kandidats/' . $kandidat->foto . '" alt="" width="150"
                                class="rounded-circle">
                        </div>
                        <div class="divider">
                            <div class="divider-text bg-transparent px-2">
                                <h2 class="card-title text-center m-0">0' . ++$no . '</h2>
                            </div>
                        </div>
                        <div class="text-white mb-3" style="text-align: center;">
                            <h3 class="card-title text-center m-0 mb-4">' . $kandidat->name . '</h3>
                            <i class="bi bi-chevron-double-down mb-4" id="visiMisiButton" onclick="visiMisiButton()" style="">Visi Misi</i>
                        </div>
                        <div class="card-right align-items-center p-3 pt-0 text-uppercase mt-3" id="visiMisi" style="">
                            <h5 class="text-white">Visi :</h5>
                            <p class="text-capitalize fs-6">' . $kandidat->visi . '</p>
                            <h5 class="text-white mt-4">Misi :</h5>
                            <pre class="text-capitalize fs-6 text-white mb-0" style="white-space: pre-wrap; font-family: Raleway;">' . $kandidat->misi . '
                            </pre>
                            <i class="bi bi-chevron-double-up mb-2 text-white" onclick="visiMisi()" style="display: grid; cursor: pointer; text-align:center;"></i>
                        </div>
                    </div>
                    <div class="card-footer text-center mb-0 py-3">';
                if($hasil->contains('id_user', $user->id)){
                    $output .= '<a href="#" class="btn icon icon-left btn-danger"><i class="bi-exclamation-circle"></i> Kamu Sudah Memilih</a>';
                }else{
                    $output .='<a href="#" id="' . $kandidat->id . '" class="btn icon icon-left btn-primary voting"><i class="bi-pin-angle"></i> Pilih</a>';
                }
                $output .='</div>
                    </div>
                </div>';
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
