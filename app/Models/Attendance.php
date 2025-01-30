<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;

class Attendance extends Model implements FromCollection
{

    use HasFactory;


    public function collection()
    {
        return Attendance::all();
    }

    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getDurationAttribute()
    {
        if ($this->check_in && $this->check_out) {
            $start = \Carbon\Carbon::parse($this->check_in);
            $end = \Carbon\Carbon::parse($this->check_out);
            return $end->diff($start)->format('%H:%I:%S');
        }

        return null;
    }
}
