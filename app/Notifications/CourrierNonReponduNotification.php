<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourrierNonReponduNotification extends Notification
{
    use Queueable;

    protected $courrier;

    public function __construct($courrier)
    {
        $this->courrier = $courrier;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'letter_id' => $this->courrier->id,
            'titre' => 'Courrier non répondu #'.$this->courrier->expeditor,
            'message' => 'Le courrier avec l\'objet << ' . $this->courrier->object . ' >> n\'a pas reçu de réponse dans les 48 heures. Direction concerné ('.$this->courrier->sigle.')',
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
