<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $isuTerkini = DB::select('SELECT * FROM konteks_organisasi WHERE dokumen = "isu" AND tarikh_disahkan IS NOT NULL AND sejarah = 0 ORDER BY tarikh_disahkan DESC LIMIT 1');
        $pihakTerkini = DB::select('SELECT * FROM konteks_organisasi WHERE dokumen = "pihakberkepentingan" AND tarikh_disahkan IS NOT NULL AND sejarah = 0 ORDER BY tarikh_disahkan DESC LIMIT 1');
        $dokumenSemakArray = DB::select('SELECT *,DATEDIFF(tarikh_disemak_berakhir, CURDATE()) AS countDay FROM konteks_organisasi WHERE (tarikh_disemak_bermula < "'.date("Y-m-d").'" AND tarikh_disemak_berakhir >= "'.date("Y-m-d").'")');
        $countSemak = 0;
        foreach($dokumenSemakArray as $dummyVar) { $countSemak++; }
        
        $daftarRisikoTerkiniArray = DB::select("SELECT * FROM borangdaftarrisiko WHERE terkini = 1 ORDER BY tarikh_dikemaskini DESC");
        foreach($daftarRisikoTerkiniArray as $daftarRisikoTerkini) { break; }
        
        $tahapArray = DB::select("SELECT (a.kebarangkalian*a.impak) AS tahap FROM daftarrisiko a JOIN borangdaftarrisiko b ON a.borangdaftarrisiko_id = b.id WHERE terkini = 1");
        
        return view('dashboard', [
            'isu'=>$isuTerkini[0],
            'pihak'=>$pihakTerkini[0],
            'dokumenSemakArray'=>$dokumenSemakArray,
            'countSemak'=>$countSemak,
            'daftarRisikoTerkini'=>$daftarRisikoTerkini,
            'tahapArray'=>$tahapArray
        ]);

    }
}
