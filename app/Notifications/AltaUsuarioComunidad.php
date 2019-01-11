<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;
class AltaUsuarioComunidad extends Notification
{
    use Queueable;
    protected $nuevoUsuario;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $nuevoUsuario)
    {
        $this->nuevoUsuario = $nuevoUsuario;
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
        return (new MailMessage)
                    ->subject('Posaderos - Nuevo participante en la Comunidad')
                    ->line('Se ha unido un nuevo usuario en tu comunidad.')
                    ->line('Dale la bienvenida a '.$this->nuevoUsuario->name.' '.$this->nuevoUsuario->apellido.'!')
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
