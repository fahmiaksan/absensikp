<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;

class Activity extends Model implements FromCollection
{

    public function collection()
    {
        return User::all();
    }

    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'activity_text',
        'status'
    ];

    protected $hidden = ['updated_at'];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
