<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Asistido;
use App\User;
use App\Institucion;

class AltaAlerta extends Notification
{
    use Queueable;
    protected $asistido;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Asistido $asistido)
    {
        $this->asistido = $asistido;
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
        //$url = url('/asistido/show2/'.$this->asistido->id);
        //$derivadoPor= User::where('id',$this->asistido->owner)->first();
        $institucion = Institucion::where('id',$this->asistido->institucion_id)->first();
        return (new MailMessage)
                    ->subject('Posaderos - Alta de Asistido')
                    ->line('Se ha dado de alta el asistido derivado a la institución '.$institucion->nombre)
                    ->line('Nombre: '.$this->asistido->nombre.' '.$this->asistido->apellido)
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
