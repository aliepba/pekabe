<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KegiatanNotification extends Notification
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
                    ->line('Dengan Hormat, ')
                    ->line('Sesuai dengan permohonan persetujuan kegiatan
                    Pengembangan Keprofesian berkelanjutan (PKB) di LPJK PUPR,
                    dapat kami sampaikan bahwa permohonannya sudah kami
                    proses dengan status : ')
                    ->line($this->data['status_permohonan_kegiatan'])
                    ->line('Silahkan untuk segera memberikan pelaporan kegiatan paling lambat 14 hari setelah kegiatan PKB dilaksanakan oleh pihak Penyelenggara kegiatan.')
                    ->line('Terima Kasih,')
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
    // public function toArray($notifiable)
    // {
    //     return [
    //         'message' => 'Permohonan Kegiatan sudah disetujui'
    //     ];
    // }
}
