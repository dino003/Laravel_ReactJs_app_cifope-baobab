<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;


class ResetPassword extends ResetPasswordNotification
{
    use Queueable;
    public $token;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
         
        $link = url( "/password/reset/" . $this->token );
       

                   return (new MailMessage)
                   ->subject( 'Réinitialisez votre mot de passe' )
                   ->salutation('Cordialement,')
                   ->greeting("Bonjour {$notifiable->prenom}")
                    ->line( "Vous avez reçu cet email suite à votre demande de reinitialisation de mot de passe; Veuillez cliquer sur le lien pou réinitialiser votre mot de passe ! " )
                    ->action('Reinitialiser', $link)
                    ->line( 'Merci d\'utiliser KOGNISHARE.com' );
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
