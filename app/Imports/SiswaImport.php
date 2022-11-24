<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;

    public function model(array $row){
        $data = Siswa::all();

        if(Siswa::where('nis', $row[0])->first() == null && Siswa::where('email', $row[2])->first() == null ){
            return new Siswa([
                'id_user'   =>  '',
                'name'      =>  $row[1],
                'email'     =>  $row[2],
                'nis'       =>  $row[0],
                'status'    =>  'Belum Memilih'
            ]);
        }
    }

    public function rules(): array{
        return [
            '0' =>  Rule::unique('siswa', 'email'),
            '1' =>  Rule::unique('siswa', 'nis'),
        ];
    }
}
