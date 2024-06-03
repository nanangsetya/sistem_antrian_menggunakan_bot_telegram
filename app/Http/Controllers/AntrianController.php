<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Jenis;
use App\Traits\SendMsg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Keyboard\Keyboard;

class AntrianController extends Controller
{
    use SendMsg;

    function webhook(Request $r)
    {
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([Keyboard::button('Check Antrian')])
            ->row([Keyboard::button('Ambil Antrian')]);

        if ($r->message['text'] == 'Check Antrian') {
            $text = "";
            $check = Antrian::where('chat_id', $r->message['from']['id'])->where('called', 0)->whereDate('created_at', Carbon::today())->orderBy('jenis_id')->get();
            if ($check->count() > 0) {
                $text .= "Antrian anda :\r\n";
                foreach ($check as $c) {
                    $text .= $c->jenis->deskripsi . " : " . $c->nomor . "\r\n";
                }
            }
            $text .= "\r\nAntrian terakhir :\r\n";
            $data = Jenis::with(['lastAntrian'])->get();
            foreach ($data as $d) {
                $nomor = 0;
                if ($d->lastAntrian) {
                    $nomor = $d->lastAntrian->nomor;
                }
                $text .= "$d->deskripsi : " . $nomor . "\r\n";
            }
            $text .= "\r\nAntrian yang sedang berjalan :\r\n";
            $data = Jenis::select('id', 'deskripsi')
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
            foreach ($data as $d) {
                $text .= "$d->deskripsi : " . $d->nomor . "\r\n";
            }
            $this->sendMessage($r->message['from']['id'], $text, $reply_markup);
        } else if ($r->message['text'] == 'Ambil Antrian') {
            $reply_markup = Keyboard::make()
                ->setResizeKeyboard(true)
                ->setOneTimeKeyboard(true);
            foreach (Jenis::all() as $jenis) {
                $reply_markup->row([Keyboard::button('Antrian ' . $jenis->deskripsi)]);
            }
            $this->sendMessage($r->message['from']['id'], "Silahkan pilih jenis antrian", $reply_markup);
        } else {
            $sentence = explode(' ', trim($r->message['text']));
            if ($sentence[0] == 'Antrian') {
                $jenis = $sentence[1];
                $check = Antrian::whereHas('jenis', function ($q) use ($jenis) {
                    $q->where('deskripsi', $jenis);
                })->where('chat_id', $r->message['from']['id'])->where('called', 0)->whereDate('created_at', Carbon::today())->get();
                if ($check->count() > 0) {
                    $text = 'Tidak bisa mengambil antrian. Anda masih memiliki Antrian ' . $check->first()->jenis->deskripsi . ' = ' . $check->first()->nomor;
                    $this->sendMessage($r->message['from']['id'], $text, $reply_markup);
                } else {
                    $lastAntrian = Antrian::whereHas('jenis', function ($q) use ($jenis) {
                        $q->where('deskripsi', $jenis);
                    })->whereDate('created_at', Carbon::today())->get()->max('nomor');
                    $antrian = Antrian::create([
                        'jenis_id' => Jenis::where('deskripsi', $jenis)->get()->first()->id,
                        'chat_id' => $r->message['from']['id'],
                        'nomor' => $lastAntrian == null ? 1 : (int)$lastAntrian + 1,
                    ]);
                    $this->sendMessage($r->message['from']['id'], "Antrian anda " . $antrian->nomor . "\r\nSilahkan tunjukkan pesan ini saat giliran anda tiba.", $reply_markup);
                }
            } else {
                $this->sendMessage($r->message['from']['id'], "Selamat Datang di\r\nAutocarwash", $reply_markup);
            }
        }
    }
}
