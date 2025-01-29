<?php  
  
  namespace App\Exports;  
 
  use App\Models\Activity;  
  use Maatwebsite\Excel\Concerns\FromCollection;  
  use Maatwebsite\Excel\Concerns\WithHeadings;  
 
  class ActivitiesExport implements FromCollection, WithHeadings  
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
  }  
