<?php

namespace App\Exports;

use App\Models\Kandidat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class HasilExport implements FromArray, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function collection()
    {
        return Kandidat::all();
    }

    public function map($row): array
    {
        $fields = [
            $row->nis,
            $row->name,
            $row->email,
            $row->kelas,
            $row->jurusan,
            $row->visi,
            $row->misi,
        ];
        return $fields;
    }
}
