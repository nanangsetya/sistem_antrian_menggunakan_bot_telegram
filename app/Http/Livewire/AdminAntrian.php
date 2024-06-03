<?php

namespace App\Http\Livewire;

use App\Models\Antrian;
use App\Models\Jenis;
use App\Traits\SendMsg;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminAntrian extends Component
{
    use SendMsg;

    public $queue;

    public function render()
    {
        $this->queue = Jenis::select('id', 'deskripsi', 'icon')
            ->selectSub(function ($query) {
                $query->from('antrian')
                    ->select('nomor')
                    ->whereDate('created_at', DB::raw('CURDATE()'))
                    ->where('called', 1)
                    ->whereColumn('jenis_id', 'jenis.id')
                    ->orderBy('created_at', 'desc')
                    ->limit(1);
            }, 'nomor')
            ->get()
            ->map(function ($item) {
                $item->nomor = $item->nomor ?? 0;
                return $item;
            });

        return view('livewire.admin-antrian');
    }

    public function callAntrian($jenis_id)
    {
        $data = Antrian::where('jenis_id', $jenis_id)->where('called', 0)->whereDate('created_at', Carbon::today())->get();
        if (!$data->max('nomor')) {
            return;
        }

        $antrian = $data->first();
        $antrian->called = 1;
        $antrian->save();
        $this->sendMessage($antrian->chat_id, "Nomor antrian " . $antrian->jenis->deskripsi . " anda telah dipanggil.\r\nTerima kasih telah menggunakan jasa kami.");
        $this->render();
    }
}
