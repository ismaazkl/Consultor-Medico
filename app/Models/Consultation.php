<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'patient_id','doctor_id','visit_date','visit_time',
        'title','diagnosis','treatment','notes','next_visit'
    ];

    protected $casts = [
        'visit_date' => 'date',
        'next_visit' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
