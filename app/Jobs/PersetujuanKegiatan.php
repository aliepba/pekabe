<?php

namespace App\Jobs;

use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use Illuminate\Bus\Queueable;
use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PersetujuanKegiatan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $kegiatan = Kegiatan::where('status_permohonan_kegiatan', 'SUBMIT')->get();

        foreach($kegiatan as $item){
            $DeferenceInDays = \Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($item->tgl_pengajuan);

            if($DeferenceInDays > 3){
                $item->update([
                    'status_permohonan_kegiatan' => PermohonanStatus::APPROVE
                ]);

                LogKegiatan::query()->create([
                    'id_kegiatan' => $item->uuid,
                    'status_permohonan' => PermohonanStatus::APPROVESISTEM,
                    'keterangan' => 'approved by sistem',
                    'user' => 1
                ]);
            }

        }
    }
}
