<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PendaftaranNotification extends Notification
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
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
                    ->line('Yth. ' . $this->data['nama_instansi'])
                    ->line('Terima kasih sudah melakukan permohonan pendaftaran sebagai penyelenggara kegiatan Pengembangan Keprofesian berkelanjutan (PKB) di LPJK PUPR, dapat kami sampaikan saat ini permohonan akun penyelenggraa kegiatan
                    dalam proses verifikasi oleh Pengelola PKB, Mohon ditunggu dalam waktu 4x24 Jam untuk diproses.')
                    ->line('Terima Kaih,')
                    ->line('Pengelola PKB')
                    ->line('LPJK PUPR')
                    ->line('Jln. Wijaya I Nomor 68 Petogogan Kebayoran Baru
                    Jakarta Selatan, DKI Jakarta')
                    ->line('www.lpjk.pu.go.id')
                    ->line('bantuanlpjk@pu.go.id');
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
