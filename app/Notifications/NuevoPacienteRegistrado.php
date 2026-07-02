<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoPacienteRegistrado extends Notification
{
    use Queueable;

    public $paciente;

    public function __construct($paciente)
    {
        $this->paciente = $paciente;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nuevo paciente registrado')
            ->line('Se ha registrado un nuevo paciente en el sistema.')
            ->line('Nombre: ' . $this->paciente->full_name)
            ->line('Edad: ' . $this->paciente->age . ' años')
            ->line('Estado: ' . ($this->paciente->status ?? 'Activo'))
            ->action('Ver paciente', url('/patients/' . $this->paciente->id))
            ->line('Gracias por usar el sistema.');
    }

    public function toArray($notifiable)
    {
        return [
            'paciente_id' => $this->paciente->id,
            'nombre' => $this->paciente->full_name,
            'mensaje' => 'Nuevo paciente registrado: ' . $this->paciente->full_name,
            'url' => '/patients/' . $this->paciente->id,
        ];
    }
}
