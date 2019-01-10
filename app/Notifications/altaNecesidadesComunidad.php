<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Necesidad;
class altaNecesidadesComunidad extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Necesidad $nuevaNecesidad)
    {
        $this->nuevaNecesidad= $nuevaNecesidad;
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
        return (new MailMessage)
                    ->subject('Posaderos - Nueva Necesidad')
                    ->line('Ha aparecido una nueva necesidad en tu comunidad')
                    ->line('Necesidad Tipo: '.$this->nuevaNecesidad->tipo->descripcion)
                    ->line('Necesidad Detalle'.$this->nuevaNecesidad->especificacion)
                    ->action('Ver Todas las necesidades', url('/necesidades/list'))
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
