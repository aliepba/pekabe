<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class ValidasiNotification extends Notification
{
    use Queueable;

    protected $data; 
    private $date;
    private $month;
    private $year;   
    private $unsur;
    private $tingkat;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $carbon = Carbon::parse($this->data['updated_at']);
        $this->date = $carbon->isoFormat('DD');
        $this->month = $carbon->isoFormat('MMMM');
        $this->year = $carbon->isoFormat('YYYY');
        
        $tingkat = ($this->data['tingkat_kegiatan'] == 1) ? 'Nasional' : (($this->data['tingkat_kegiatan'] == 2) ? 'Internasional Dalam Negeri' : 'Internasional Luar Negeri');

        $this->tingkat= $tingkat;

        $arr = [];
        foreach($this->data->unsurKegiatan as $item){
            array_push($arr, $item->unsur->nama_sub_unsur);
        }
        $this->unsur = implode(' , ' , $arr);
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
                    ->line('VERIFIKASI DAN VALIDASI KEGIATAN PKB TERVERIFIKASI')
                    ->line('Berdasarkan hasil verifikasi dan validasi, serta penilaian yang dilakukan oleh Lembaga Pengembangan Jasa Konstruksi terhadap kegiatan'
                    . $this->data['nama_kegiatan'] .' yang diselenggarakan oleh '
                    . $this->data->user['name'] .' pada tanggal '. $this->date .' bulan ' .  $this->month . ' tahun '. $this->year .' , 
                    diputuskan bahwa kegiatan tersebut memenuhi klasifikasi kegiatan sebagai berikut :')
                    ->line('')
                    ->line('Unsr Kegiatan : '. $this->unsur)
                    ->line('Jenis Kegiatan : Kegiatan PKB Terverifikasi')
                    ->line('Sifat Kegiatan : Sesuai dengan subklasifikasi pada kepemilikan Sertifikat Kompetensi Kerja tenaga ahli')
                    ->line('Metode Kegiatan : ' .  $this->data['metode_kegiatan'])
                    ->line('Tingkat Kegiatan: '. $this->tingkat)
                    ->line('')
                    ->line('Kegiatan '. $this->data['nama_kegiatan'] . ' dinilai berdasarkan klasifikasi tersebut diatas 
                    dengan mengacu kepada ketentuan perundang-undangan yang berlaku')
                    ->line('Demikian Berita Acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya dan apabila di kemudian hari terdapat kekeliruan akan dilakukan perbaikan sebagaimana mestinya.')
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
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
