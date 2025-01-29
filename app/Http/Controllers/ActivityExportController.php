<?php  
  
namespace App\Http\Controllers;  
  
use App\Models\Activity;  
use PhpOffice\PhpSpreadsheet\Spreadsheet;  
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;  
use Illuminate\Http\Request;  
  
class ActivityExportController extends Controller  
{  
    public function export()  
    {  
        // Membuat spreadsheet baru  
        $spreadsheet = new Spreadsheet();  
        $sheet = $spreadsheet->getActiveSheet();  
  
        // Menambahkan header kolom  
        $sheet->setCellValue('A1', 'ID');  
        $sheet->setCellValue('B1', 'User');  
        $sheet->setCellValue('C1', 'Nama');  
        $sheet->setCellValue('D1', 'Deskripsi');  
        $sheet->setCellValue('E1', 'Status');  
        $sheet->setCellValue('F1', 'Tanggal Dibuat');  
  
        // Mengambil data aktivitas  
        $activities = Activity::with('user')->get();  
  
        // Menambahkan data ke spreadsheet  
        $row = 2; // Mulai dari baris kedua  
        foreach ($activities as $activity) {  
            $sheet->setCellValue('A' . $row, $activity->id);  
            $sheet->setCellValue('B' . $row, $activity->user->name);  
            $sheet->setCellValue('C' . $row, $activity->name);  
            $sheet->setCellValue('D' . $row, $activity->activity_text);  
            $sheet->setCellValue('E' . $row, ucfirst($activity->status));  
            $sheet->setCellValue('F' . $row, $activity->created_at->format('Y-m-d H:i:s'));  
            $row++;  
        }  
  
        // Menyimpan file Excel  
        $writer = new Xlsx($spreadsheet);  
        $fileName = 'activities.xlsx';  
          
        // Mengatur header untuk download  
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
        header('Content-Disposition: attachment; filename="' . $fileName . '"');  
        header('Cache-Control: max-age=0');  
          
        // Menyimpan ke output  
        $writer->save('php://output');  
        exit;  
    }  
}  
