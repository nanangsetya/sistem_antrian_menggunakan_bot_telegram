<?php

namespace App\Http\Livewire;

use App\Models\Antrian;
use App\Models\Jenis;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowGraphic extends Component
{
    public $data;
    public $years;

    protected $listeners = ['changeYear' => 'changeYear'];

    function getMonths()
    {
        return collect(range(1, 12))->map(function ($month) {
            return ['month' => $month];
        });
    }

    function count($year = null)
    {
        // Get the current year
        $currentYear = now()->year;
        if ($year) {
            $currentYear = $year;
        }
        // Create a collection of months
        $months = $this->getMonths();

        // Get all dynamic types from the jenis table
        $jenisTypes = Jenis::get();

        // Perform the query
        $results = DB::table('antrian')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                'jenis_id',
                DB::raw('COUNT(id) as total')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'), 'jenis_id')
            ->get();

        // Initialize arrays to hold the totals for each jenis
        $totals = [];
        foreach ($jenisTypes as $jenis) {
            $totals[$jenis->id] = array_fill(0, 12, 0);
        }

        // Process the query results
        foreach ($results as $result) {
            $totals[$result->jenis_id][$result->month - 1] = $result->total;
        }

        // Format the results to include the jenis name
        $data = [];
        foreach ($jenisTypes as $jenis) {
            $data[] = [
                'name' => $jenis->deskripsi,
                'data' => $totals[$jenis->id]
            ];
        }

        return json_encode($data);
    }

    function changeYear($value)
    {
        $this->dispatchBrowserEvent('chartChanged', ['item' => $this->count($value)]);
    }

    public function mount()
    {
        $result = Antrian::select(DB::raw('YEAR(created_at) as year'))->orderBy('year', 'desc')->distinct()->get();
        $this->years = $result->pluck('year');
        $this->data = $this->count();
    }
    public function render()
    {
        return view('livewire.show-graphic');
    }
}
