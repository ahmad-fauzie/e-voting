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
                $output .= '<div class="col-12 col-md-4 overflow-auto mx-md-auto" style="max-height: 100vh;">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="text-center m-4">
                            <img src="storage/kandidats/' . $kandidat->foto . '" alt="" width="150"
                                class="rounded-circle">
                        </div>
                        <div class="divider">
                            <div class="divider-text bg-transparent px-2">
                                <h3 class="card-title text-center m-0">' . $kandidat->name . '</h3>
                            </div>
                        </div>
                        <div class="card-right align-items-center p-3 pt-0 text-uppercase">
                            <h5 class="text-white">Visi :</h5>
                            <p class="text-capitalize fs-6">' . $kandidat->visi . '</p>
                            <h5 class="text-white mt-4">Misi :</h5>
                            <pre class="text-capitalize fs-6 text-white mb-0" style="white-space: pre-wrap; font-family: Raleway;">' . $kandidat->misi . '
                            </pre>
                        </div>
                    </div>
                    <div class="text-center mb-3">';
                if($hasil->contains('id_user', $user->id)){
                    $output .= '<a href="#" class="btn icon icon-left btn-danger"><i class="bi-exclamation-circle"></i> Anda Sudah Memilih</a>';
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
