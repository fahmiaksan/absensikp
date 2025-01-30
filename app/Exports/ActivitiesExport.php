<?php

namespace App\Exports;

use App\Models\Activity;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat as StyleNumberFormat;

class ActivitiesExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    public function collection()
    {
        return Activity::with('user')->get(); // Mengambil semua aktivitas dengan relasi pengguna  
    }

    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Nama',
            'Deskripsi',
            'Status',
            'Tanggal Dibuat',
        ];
    }

    public function map($activity): array
    {
        return [
            $activity->id,
            $activity->user->name,
            $activity->name,
            $activity->activity_text,
            $activity->status,
            Carbon::parse($activity->created_at)->format('d M Y H:i:s'),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => StyleNumberFormat::FORMAT_DATE_DATETIME, // Format untuk created_at
        ];
    }
}
