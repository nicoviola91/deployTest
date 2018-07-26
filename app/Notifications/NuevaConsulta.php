<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Asistido;
use App\Consulta;

class NuevaConsulta extends Notification
{
    use Queueable;
    private $consulta;
    private $asistido;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Consulta $consulta, Asistido $asistido)
    {
        $this->consulta=$consulta;
        $this->asistido=$asistido;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $asistido_id = $this->asistido->id;
        $persona = User::where('id',$this->consulta->user_id)->get()->first();
        $nombre_ficha = $this->consulta->consultable_type;
        return (new MailMessage)
                    ->line($persona->name.' ha hecho una nueva consulta en la ficha '.$nombre_ficha.' de tu asistido')
                    ->line('Consulta: '.strip_tags($this->consulta->mensaje))
                    ->action('Ir al asistido', url('/asistido/show2/'.$asistido_id))
                    ->line('Gracias por usar nuestra aplicación!')
                    ->salutation('LumenCor - Red de Posaderos');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
