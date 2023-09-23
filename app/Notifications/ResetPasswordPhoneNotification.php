<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordPhoneNotification extends Notification
{
    use Queueable;

    public $mailer;
    public $fromEmail;
    public $subject;
    public $message;
    private $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->mailer = "smtp";
        $this->fromEmail = "noran_mostafa20@hotmail.com";
        $this->subject = "Password Resetting";
        $this->message = "Use the below code for resetting your password";
        $this->otp = new Otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $otp = $this->otp->generate($notifiable->phone,6,60);

        return (new MailMessage)
        ->mailer('smtp')
        ->subject($this->subject)
        ->greeting('Hello '. $notifiable->name)
        ->line($this->message)
        ->line('code: '. $otp->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
