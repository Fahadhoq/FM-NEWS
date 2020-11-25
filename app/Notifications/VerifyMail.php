<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

use App\User;

class VerifyMail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $user;

    public function __construct(User $user)
    {
       $this->user = $user;
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
                    ->line('DEAR ' . $this->user->full_name)
                    ->line('Your account has been created. Please click the following link to activate your account: ')
                    ->action('click ', route('RegistrationVerify', $this->user->email_verification_token))
                    ->line('Thank you for using our application!');
    }
    
    //sms notification
    // public function toNexmo($notifiable)
    // {
    //     return (new NexmoMessage())
    //                 ->content('DEAR '. $this->user->full_name.'. you are cool');
    // }

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
