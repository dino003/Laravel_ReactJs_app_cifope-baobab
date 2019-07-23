<?php

namespace App\Notifications;

use App\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NouvelArticleParMail extends Notification
{
    use Queueable;
    public $article;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
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
        $link = url( "voir_les_affiches/" . $this->article->id );

        return (new MailMessage)
        ->subject( 'Nouvelle notification' )
        ->salutation('Cordialement,')
        ->greeting("Bonjour {$notifiable->prenom}")
         ->line( "Vous avez reçu une notification sur KOGNISHARE" )
         ->line("Objet : {$this->article->titre}")
         ->action('Consulter l\'article', $link)
         ->line( 'Kognishare; Partageons la connaissance' );
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
