<?php
namespace App\Notifications;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPatientRegistered extends Notification
{
    use Queueable;

    public Patient $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'icon'       => 'user-plus',
            'title'      => 'Nuevo paciente registrado',
            'message'    => "{$this->patient->full_name} ha sido registrado.",
            'patient_id' => $this->patient->id,
            'url'        => route('patients.show', $this->patient->id),
        ];
    }
}
