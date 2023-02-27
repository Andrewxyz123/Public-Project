<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

use App\Exports\ParkingExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;

class ParkingController extends Controller
{
    public function checkIn(Request $request){
        // dd($request['plate']);

        $pattern = '/[A-Z]{1,2} [0-9]{2,4} [A-Z]{2,3}/';
        $result = preg_match( $pattern, $request['plate']);
        if($result != 1){
            return redirect()->back()->withErrors('Plate Number Format not fit!');
        }


        $id = DB::table('parking')->value('id');

        if(Parking::where('plate_number', $request['plate'])->exists()){
            return redirect()->back()->withErrors('Plate Number Not yet checked out!');
        }

        if(is_null($id)){
            $uqId = $request['plate'].'-'."1";
        }else{
            $uqIdTemp = DB::table('parking')->latest('park_in')->value('id') + 1;
            $uqId = $request['plate'].'-'.$uqIdTemp;
        }

        $park = Parking::create([
            'plate_number' => $request['plate'],
            'code' => $uqId
        ]);
        return redirect()->back()->withSuccess('Vehicle Checked In!')->with('code', $uqId);
    }

    public function checkOut(Request $request){
        // dd($request['code']);
        $code = $request['code'];

        $current_date_time = Carbon::now()->toDateTimeString();
        $park_out = DB::table('parking')->where('code', $code)->value('park_out');
        $code_exist = DB::table('parking')->where('code', $code)->value('code');
        if(is_null($park_out) && !is_null($code_exist)){
            Parking::where('code', $code)->update(['park_out'=> $current_date_time]);

            $park_in = DB::table('parking')->where('code', $code)->value('park_in');
            $park_out = DB::table('parking')->where('code', $code)->value('park_out');
            $start = Carbon::parse($park_in);
            $end = Carbon::parse($park_out);

            $time = $start->diffInHours($end);

            // dd($time);

            $price = 3000 + 3000 * $time;

            return redirect()->back()->withSuccess('Vehicle Checked Out!')->with('time', $price);
        }
        return redirect()->back()->withErrors('Code not Found!');
    }

    public function filterData(Request $request)
    {
        // dd($request);
        $validator = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
           ]);

           
           $start = Carbon::parse($validator['start_date']);
           $end = Carbon::parse($validator['end_date']);
         

           $getAllUser = DB::table('parking')->whereDate('park_in','<=',$end)
           ->whereDate('park_in','>=',$start)->get();
           
           session(['Dater1' => $start]);
           session(['Dater2' => $end]);
        //    dd($getAllUser);
           return view('user-page', compact('getAllUser'));
    }

    public function parkingExport(Request $request){


        $value1 = session('Dater1');
        $value2 = session('Dater2');

        // dd($from_date);

         return Excel::download(new ParkingExport($value1,$value2), 'parking.xlsx');
    }
}
