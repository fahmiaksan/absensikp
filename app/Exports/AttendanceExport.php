<?php

namespace App\Exports;

use App\Models\Attendance;
use Carbon\Carbon;
use Faker\Core\Number;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\NumberFormat;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat as StyleNumberFormat;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Attendance::with('user')->get(); // Mengambil semua aktivitas dengan relasi pengguna  
    }


    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Check_in',
            'Check_out',
            'Duration',
        ];
    }

    public function map($attendance): array
    {
        return [
            $attendance->id,
            $attendance->user->name,
            Carbon::parse($attendance->check_in)->format('d M Y H:i:s'),
            Carbon::parse($attendance->check_in)->format('d M Y H:i:s'),
            $attendance->getDurationAttribute(),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => StyleNumberFormat::FORMAT_DATE_DATETIME, // Format untuk Check_in
            'D' => StyleNumberFormat::FORMAT_DATE_DATETIME, // Format untuk Check_out
        ];
    }
}
