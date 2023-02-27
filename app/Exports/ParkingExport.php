<?php

namespace App\Exports;

use App\Models\Parking;
use Illuminate\Support\Facades\DB;
    
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ParkingExport implements FromQuery, WithHeadings
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
        // $start_date = $this->from_date.' 00:00:00';
        // $end_date = $this->to_date.' 23:59:59';

        // $data = DB::table('parking')
        // ->whereBetween('park_in',[ $start_date, $end_date])
        // ->orderBy('id');

        $data =  DB::table('parking')->whereDate('park_in','<=',$this->to_date)
        ->whereDate('park_in','>=',$this->from_date)->orderBy('id');
        
        // dd($this->to_date);
        return $data;
    }

    public function headings(): array
        {
            return [
                'ID',
                'Park In',
                'Park Out',
                'Unique Code',
                'Plate Number',
                'Price',
            ];
        }

}
