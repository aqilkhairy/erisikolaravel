<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 

class KonteksOrganisasiController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    
    public function index() {
        $isuTerkiniArray = DB::select('SELECT * FROM konteks_organisasi WHERE dokumen = "isu" AND tarikh_disahkan IS NOT NULL AND sejarah = 0 ORDER BY tarikh_disahkan DESC LIMIT 1');
        $pihakberkepentinganTerkiniArray  = DB::select('SELECT * FROM konteks_organisasi WHERE dokumen = "pihakberkepentingan" AND tarikh_disahkan IS NOT NULL AND sejarah = 0 ORDER BY tarikh_disahkan DESC LIMIT 1');
        $idIsu = null;
        $idPihak = null;
        $isuTerkini = null;
        $pihakberkepentinganTerkini = null;
        foreach($isuTerkiniArray as $isuTerkini) { $idIsu = $isuTerkini->id; break; }
        foreach($pihakberkepentinganTerkiniArray as $pihakberkepentinganTerkini) { $idPihak = $pihakberkepentinganTerkini->id; break; }
        
        $isuluaranArray = DB::select('SELECT * FROM isu WHERE id_konteks_organisasi = '.$idIsu.' AND jenis = 1 ORDER BY perkara');
        $isudalamanArray = DB::select('SELECT * FROM isu WHERE id_konteks_organisasi = '.$idIsu.' AND jenis = 0 ORDER BY perkara');
        $pihakberkepentinganluaranArray = DB::select('SELECT * FROM pihak_berkepentingan WHERE id_konteks_organisasi = '.$idPihak.' AND jenis = 1 ORDER BY pihak_berkepentingan');
        $pihakberkepentingandalamanArray = DB::select('SELECT * FROM pihak_berkepentingan WHERE id_konteks_organisasi = '.$idPihak.' AND jenis = 0 ORDER BY pihak_berkepentingan');
        
        return view('konteks_organisasi',[
            'isuTerkini'=>$isuTerkini,
            'pihakberkepentinganTerkini'=>$pihakberkepentinganTerkini,
            'isuluaranArray'=>$isuluaranArray, 
            'isudalamanArray'=>$isudalamanArray, 
            'pihakberkepentinganluaranArray'=>$pihakberkepentinganluaranArray, 
            'pihakberkepentingandalamanArray'=>$pihakberkepentingandalamanArray
        ]);
    }
    
    public function senaraisemakan() {
        
        $isuArray = DB::select('SELECT * FROM konteks_organisasi WHERE tarikh_disahkan IS NULL AND dokumen = "isu"  AND sejarah = 0');
        $pihakArray = DB::select('SELECT * FROM konteks_organisasi WHERE tarikh_disahkan IS NULL AND dokumen = "pihakberkepentingan"  AND sejarah = 0');
        return view('semakan/konteks_organisasi', [
            'isuArray'=>$isuArray,
            'pihakArray'=>$pihakArray
        ]);
    }
    
    public function senaraitetapan() {
        
        $isuArray = DB::select('SELECT * FROM konteks_organisasi WHERE dokumen = "isu" AND sejarah = 0');
        $pihakArray = DB::select('SELECT * FROM konteks_organisasi WHERE dokumen = "pihakberkepentingan" AND sejarah = 0');
        return view('tetapan/konteks_organisasi', [
            'isuArray'=>$isuArray,
            'pihakArray'=>$pihakArray
        ]);
    }
    
    public function senaraipengesahan() {
        
        $dokumenArray = DB::select('SELECT * FROM konteks_organisasi WHERE tarikh_disahkan IS NULL AND status_hantar = 1  AND sejarah = 0');
        return view('pengesahan/konteks_organisasi', [
            'dokumenArray'=>$dokumenArray
        ]);
    }
    
    public function senaraisejarah() {
        
        $isuArray = DB::select('SELECT * FROM konteks_organisasi WHERE dokumen = "isu" AND sejarah = 1');
        $pihakArray = DB::select('SELECT * FROM konteks_organisasi WHERE dokumen = "pihakberkepentingan" AND sejarah = 1');
        return view('sejarah/konteks_organisasi', [
            'isuArray'=>$isuArray,
            'pihakArray'=>$pihakArray
        ]);
    }
    
    public function lihat($id) {
        $qryArray = DB::select('SELECT * FROM konteks_organisasi WHERE id = '.$id.'');
        foreach($qryArray as $qry) { 
            if($qry->dokumen == "isu") { 
                $dokumen = "Dokumen Isu";
                $konteks_organisasi = $qry;
                $isuluaranArray = DB::select('SELECT * FROM isu WHERE id_konteks_organisasi = '.$id.' AND jenis = 1 ORDER BY perkara');
                $isudalamanArray = DB::select('SELECT * FROM isu WHERE id_konteks_organisasi = '.$id.' AND jenis = 0 ORDER BY perkara');
                return view('konteks_organisasi_lihatIsu',[
                    'dokumen'=>$dokumen,
                    'konteks_organisasi'=>$konteks_organisasi,
                    'isuluaranArray'=>$isuluaranArray, 
                    'isudalamanArray'=>$isudalamanArray
                ]);
            } else {
                $dokumen = "Dokumen Pihak Berkepentingan";
                $konteks_organisasi = $qry;
                $pihakberkepentinganluaranArray = DB::select('SELECT * FROM pihak_berkepentingan WHERE id_konteks_organisasi = '.$id.' AND jenis = 1 ORDER BY pihak_berkepentingan');
                $pihakberkepentingandalamanArray = DB::select('SELECT * FROM pihak_berkepentingan WHERE id_konteks_organisasi = '.$id.' AND jenis = 0 ORDER BY pihak_berkepentingan');
                return view('konteks_organisasi_lihatPihak',[
                    'dokumen'=>$dokumen,
                    'konteks_organisasi'=>$konteks_organisasi,
                    'pihakberkepentinganluaranArray'=>$pihakberkepentinganluaranArray, 
                    'pihakberkepentingandalamanArray'=>$pihakberkepentingandalamanArray
                ]);
            }
        }
    } 
    
    public function tambahDokumen() {
        $terkini = DB::select("SELECT * FROM konteks_organisasi WHERE dokumen = 'isu' AND tarikh_disahkan IS NOT NULL AND sejarah = 0 ORDER BY tarikh_disahkan DESC LIMIT 1");
        foreach($terkini as $dokumenTerkini) { break; }
        
    }
    
}
