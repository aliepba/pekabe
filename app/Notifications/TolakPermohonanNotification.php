<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TolakPermohonanNotification extends Notification
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
                    ->line('Dengan Hormat, ')
                    ->line('Sesuai dengan permohonan pendaftaran akun sebagai penyelenggara kegiatan Pengembangan Keprofesian berkelanjutan (PKB) di LPJK PUPR,  dapat kami sampaikan bahwa permohonannya sudah kami proses dengan status : Ditolak')
                    ->line('Dengan keterangan : '. $this->item['keterangan'])
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
