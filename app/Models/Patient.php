<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = [
        'first_name','last_name','birth_date','gender','id_number',
        'phone','email','address','blood_type','insurance',
        'allergies','chronic_conditions','current_medications',
        'notes','status','avatar_color',
        'emergency_contact_name','emergency_contact_relation','emergency_contact_phone'
    ];

    protected $casts = ['birth_date' => 'date'];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function getLastVisitAttribute()
    {
        $last = $this->consultations()->latest('visit_date')->first();
        return $last?->visit_date;
    }
}
