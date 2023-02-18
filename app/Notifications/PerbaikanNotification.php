<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PerbaikanNotification extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($perbaikan, $data)
    {
        $this->perbaikan = $perbaikan;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
                    ->line('Perbaikan Dokumen Pada Kegiatan '. $this->data['nama_kegiatan'])
                    ->line('Mohon Lengkapi Dokumen Berikut :')
                    ->line($this->perbaikan->keterangan)
                    ->action('Update Perbaikan',url(route($this->perbaikan->link, $this->data['uuid'])))
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
            'items' => $this->perbaikan,
            'kegiatan' => $this->data['nama_kegiatan'],
            'message' => "Silakan Perbaiki Persyaratan Berikut : ",
            'keterangan' => $this->perbaikan->keterangan,
            'link' => $this->perbaikan->link
        ];
    }
}
