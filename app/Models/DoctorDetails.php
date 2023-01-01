<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorDetails extends Model
{
    use HasFactory;
    protected $table = 'doctor_details';
    protected $fillable = ['dr_id ', 'dr_type'];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
