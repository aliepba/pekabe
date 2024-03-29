<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PerbaikanPermohonanNotification extends Notification
{
    use Queueable;

    protected $log;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($log)
    {
        $this->item = $log;
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
                    ->line('Mohon Lengkapi Dokumen Berikut : ')
                    ->line($this->item['keterangan'])
                    ->action('Update Perbaikan', url('/permohonan-akun/perbaikan/'. $this->item['id_detail_instansi']))
                    ->line('Terima Kasih telah menggunakan Aplikasi ini.');
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
