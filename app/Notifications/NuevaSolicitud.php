<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Solicitud;

class NuevaSolicitud extends Notification
{
    use Queueable;
    protected $solicitud;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
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
        $url = url('/solicitudes/list');
        if ($this->solicitud->tipoSolicitud_id = 1){
            //queda disponible para la tabla de referencia de tipos de solicitudes en caso que aparezcan nuevas. No va
            //a hacer falta el if y se va a poder traer directamente solicitud->tipoSolicitud()->descripcion
            $tipo = 'de Adherirse a una comunidad';
        }

        return (new MailMessage)
                    ->subject('Posaderos - Nueva Solicitud')
                    ->line('Se ha generado una solicitud '.$tipo)
                    ->action('Ir a Mis Solicitudes', $url)
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
