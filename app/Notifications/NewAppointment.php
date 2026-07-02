<?php
namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewAppointment extends Notification
{
    use Queueable;

    public Appointment $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'icon'       => 'calendar-plus',
            'title'      => 'Nueva solicitud de cita',
            'message'    => "{$this->appointment->nombre} solicitó una cita.",
            'url'        => route('appointments.index'),
        ];
    }
}
