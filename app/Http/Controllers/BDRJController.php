<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 

class BDRJController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $kategori_dalamanArray = DB::select("SELECT perkara FROM isu WHERE jenis = 0 GROUP BY perkara");
        $kategori_luaranArray = DB::select("SELECT perkara FROM isu WHERE jenis = 1 GROUP BY perkara");
        $kategori_dalaman = "";
        $kategori_luaran = "";
        foreach($kategori_dalamanArray as $row) {
            $kategori_dalaman .= "<option value=".$row->perkara.">".$row->perkara."</option>";
        }
        foreach($kategori_luaranArray as $row) {
            $kategori_luaran .= "<option value=".$row->perkara.">".$row->perkara."</option>";
        }
        $daftarRisikoTerkiniArray = DB::select("SELECT * FROM borangdaftarrisiko WHERE terkini = 1 ORDER BY tarikh_dikemaskini DESC");
        foreach($daftarRisikoTerkiniArray as $daftarRisikoTerkini) { break; }
        $senaraiRisikoArray = DB::select("SELECT * FROM daftarrisiko a JOIN isu b ON a.isu_id = b.id");
        return view('bdrj', [
            'kategori_dalaman'=>$kategori_dalaman,
            'kategori_luaran'=>$kategori_luaran,
            'daftarRisikoTerkini'=>$daftarRisikoTerkini,
            'senaraiRisikoArray'=>$senaraiRisikoArray
        ]);
    }
    
    public function lihat($id) {
        $dataArray = DB::select("SELECT * FROM daftarrisiko a JOIN isu b ON a.isu_id = b.id JOIN borangdaftarrisiko c ON a.borangdaftarrisiko_id = c.id WHERE a.no_rujukan = '$id'");
        $data = null;
        $tindakanArray = null;
        foreach($dataArray as $data) {
            $tindakanArray = DB::select("SELECT * FROM tindakan_risiko b JOIN daftarrisiko a ON a.id = b.daftarrisiko_id");
        }
        return view('bdrj_lihat', [
            'data'=>$data,
            'tindakanArray'=>$tindakanArray
        ]);
    }
    
    public function senaraisemakan() {
        $dataArray = DB::select('SELECT * FROM borangdaftarrisiko WHERE tarikh_dikemaskini IS NULL AND sejarah = 0');
        return view('semakan/daftar_risiko', [
            'dataArray'=>$dataArray
        ]);
    }
    
}
