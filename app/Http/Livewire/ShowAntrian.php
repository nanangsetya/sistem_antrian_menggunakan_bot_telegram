<?php

namespace App\Http\Livewire;

use App\Models\Jenis;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowAntrian extends Component
{
    public $queue;
    public $total;

    protected $listeners = ['updateAntrian' => 'render'];

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

        $data = Jenis::with(['lastAntrian'])->get();
        $lists = [];
        foreach ($data as $d) {
            $nomor = 0;
            if ($d->lastAntrian) {
                $nomor = $d->lastAntrian->nomor;
            }
            $lists[] = [
                'icon' => $d->icon,
                'nomor' => $nomor
            ];
        }
        $this->total = json_decode(json_encode($lists));

        return view('livewire.show-antrian');
    }
}
