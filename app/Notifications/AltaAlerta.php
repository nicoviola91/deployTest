<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Asistido;
use App\User;

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
        //$url = url('/asistido/list');
        $derivadoPor= $this->asistido->owner();
        $comunidad = $this->asistido->comunidad()
        return (new MailMessage)
                    ->subject('Posaderos - Alta de Asistido')
                    ->line('Se ha dado de alta un asistido en la comunidad ')//.$comunidad->nombre)
                    ->line($this->asistido->nombre.' '.$this->asistido->apellido)
                    //->line('Derivado por '.$derivadoPor->name.' '.$derivadoPor->apellido)
                    //->action('Ver asistidos', $url)
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
