<?php

namespace App\Exports;

use App\Models\Feedback;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class FeedbackExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return Feedback::all();
    }

    public function map($feedback): array
    {
        return [
            $feedback->id,
            $feedback->id_user,
            $feedback->name,
            $feedback->login,
            $feedback->daftar,
            $feedback->reset,
            $feedback->dashboard,
            $feedback->siswa,
            $feedback->kandidat,
            $feedback->voting,
            $feedback->qna,
            $feedback->hasil,
            $feedback->jadwal,
            $feedback->profile,
            $feedback->rating,
            $feedback->feedback,
            $feedback->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Id_User',
            'Name',
            'Login',
            'Daftar',
            'Reset',
            'Dashboard',
            'Siswa',
            'Kandidat',
            'Voting',
            'Qna',
            'Hasil',
            'Jadwal',
            'Profile',
            'Rating',
            'Feedback',
            'Created_At',
        ];
    }
}
