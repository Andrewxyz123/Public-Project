<?php

namespace App\Exports;

use App\Models\Parking;
use Illuminate\Support\Facades\DB;
    
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ParkingExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    
    protected $from_date;
    protected $to_date;

    function __construct($from_date,$to_date) {
            $this->from_date = $from_date;
            $this->to_date = $to_date;
    }

    public function query()
    {

        $data = DB::table('parking')
        ->whereBetween('park_in',[ $this->from_date,$this->to_date])
        ->orderBy('id');
        
        // dd($this->to_date);
        return $data;
    }

}
