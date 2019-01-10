<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Donacicon;
use App\Necesidad;
class AltaNuevaDonacion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Donacion $nuevaDonacion, Necesidad $necesidad)
    {
        $this->nuevaDonacion=$nuevaDonacion;
        $this->necesidad = $necesidad;
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
                    ->subject('Posaderos - Nueva Donación')
                    ->line('Hay una nueva donacion para la necesidad ( '.$this->necesidad->especificacion.' ) que has publicado')
                    ->line('Contacto: '.$this->nuevaDonacion->nombre.' '.$this->nuevaDonacion->apellido)
                    ->line('Telefono:'.$this->nuevaDonacion->tel_contacto)
                    ->line('Mail:'.$this->nuevaDonacion->mail_contacto)
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
