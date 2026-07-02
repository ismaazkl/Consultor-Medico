<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id', 'nombre', 'email', 'telefono', 'tipo', 'fecha_deseada', 'mensaje', 'status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
