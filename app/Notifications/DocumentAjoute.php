<?php

namespace App\Notifications;

use App\Structure;
use App\Documentservice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DocumentAjoute extends Notification
{
    use Queueable;
    public $document;
    public $structure;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Documentservice $document, Structure $structure)
    {
        $this->document = $document;
        $this->structure = $structure;

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
        //$link = url( "telecharger/" . $this->document->id. "/structure" . $this->structure->id);

        return (new MailMessage)
       // ->from('info@sometimes-it-wont-work.com', 'Admin')
        ->subject('Nouveau document ajouté')
        ->markdown('mail.documents.index', [
            'document' => $this->document,
            'structure' =>$this->structure
            ]);
    }

    public function toDatabase($notifiable)
    {
        return [
            //
        ];
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
