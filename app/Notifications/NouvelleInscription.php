<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NouvelleInscription extends Notification
{
    use Queueable;
    public $mdp;
    public $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $mdp)
    {
        $this->email = $email;
        $this->mdp = $mdp;
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
                    ->subject( 'Inscription KOGNISHARE' )
                    ->greeting( 'Nouvelle Inscription' )
                    ->salutation('Cordialement,')
                    ->line("Bonjour {$notifiable->prenom}")
                    ->line("Voici vos identifiants de connexion : ")
                    ->line("Login {$this->email} / mot de passe {$this->mdp} ")
                    ->action('Se Connecter au site', url('/login'))
                    ->line('Merci d\'utiliser Kognishare');
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
