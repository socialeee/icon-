<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pelanggan = Pelanggan::select('id', 'created_at')
                                        ->whereYear('created_at', date('Y'))
                                        ->get()
                                        ->groupBy(function($date){
                                            return Carbon::parse($date->created_at)->format('m');
                                        });

        $pelangganmcount = [];
        $pelangganArr = [];
        foreach($pelanggan as $key => $value) {
            $pelangganmcount[(int)$key] = count($value);
        }
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for($i = 1; $i <= 12; $i++) {
            if(!empty($pelangganmcount[$i])){
                $pelangganArr[$i]['count'] = $pelangganmcount[$i];
            } else {
                $pelangganArr[$i]['count'] = 0;
            }
            $pelangganArr[$i]['month'] = $month[$i-1];
        }

        $data = [];
        foreach($pelangganArr as $key => $value) {
            $data[$key] = $value['count'];
        }

        $tahun = Carbon::now()->year;
        // dd($tahun);
        return view('home', compact('data', 'tahun'));
    }
}
