<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Solicitud;
use App\User;
use App\Comunidad;

class NuevaSolicitud extends Notification
{
    use Queueable;
    protected $solicitud;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Solicitud $solicitud, Comunidad $comunidad)
    {
        $this->solicitud = $solicitud;
        $this->comunidad = $comunidad;
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
        $url = url('/comunidad/ficha/');//.$id_comunidad
        if ($this->solicitud->tipoSolicitud_id = 1){
            //queda disponible para la tabla de referencia de tipos de solicitudes en caso que aparezcan nuevas. No va
            //a hacer falta el if y se va a poder traer directamente solicitud->tipoSolicitud()->descripcion
            $tipo = 'para adherirse a la comunidad';
        }
        $usuario_sol=User::where('id',$this->solicitud->user_id)->first();
        return (new MailMessage)
                    ->subject('Posaderos - Nueva Solicitud')
                    ->line($usuario_sol->nombre.' '.$usuario_sol->apellido.' ha generado una solicitud '.$tipo.' '.$comunidad->nombre)
                    ->line('Accede a "Mis Solicitudes" para gestionar tus solicitudes pendientes')
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
