<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function array(): array
    {
        return [
            [
                '1234',
                'Muhammad Mutawali',
                'mutawali@gmail.com'
            ],
            [
                '567',
                'Ahmad Fauzan',
                'fauzan@gmail.com',
            ],
            [
                '890',
                'Wisnu Chandra',
                'wisnu@gmail.com'
            ],
            [
                '87537',
                'Putri Amelia',
                'putri@gmail.com'
            ],
            [
                '08372',
                'Rizqi Amalia',
                'rizqi@gmail.com'
            ],
        ];
    }
}
