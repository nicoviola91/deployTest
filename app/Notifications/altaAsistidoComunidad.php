<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Asistido;
class altaAsistidoComunidad extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Asistido $nuevoAsistido)
    {
        $this->nuevoAsistido= $nuevoAsistido;
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
        $url =  url('/asistido/show2/'.$nuevoAsistido->id);
        return (new MailMessage)
                    ->subject('Posaderos - Alta Asistido')
                    ->line('Se ha dado de alta un asistido en tu comunidad.')
                    ->action($nuevoAsistido->name.' '.$nuevoAsistido->apellido, $url)
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
