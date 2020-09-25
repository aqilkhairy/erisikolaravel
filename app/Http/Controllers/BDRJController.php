<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BDRJController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

    }

    public function terkini() {
        $id = DB::table('borangdaftarrisiko')->where('terkini', 1)->first();
        return $this->lihatBorang($id->id);
    }

    public function lihatBorang($id) {
        $daftarRisikoTerkiniArray = DB::select("SELECT * FROM borangdaftarrisiko WHERE id = $id ORDER BY tarikh_dikemaskini DESC");
        foreach($daftarRisikoTerkiniArray as $daftarRisikoTerkini) { break; }
        $senaraiRisikoArray = DB::select("SELECT * FROM daftarrisiko a JOIN isu b ON a.isu_id = b.id WHERE borangdaftarrisiko_id = $id");
        return view('bdrj', [
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

    public function senaraisemakanborang($id) {
        $bdrjArray = DB::table('borangdaftarrisiko')
                        ->where('id', $id)
                        ->first();
        $daftarRisikoTerkini = DB::table('borangdaftarrisiko')
                                    ->where('id', $id)
                                    ->orderBy('tarikh_dikemaskini', 'DESC')
                                    ->first();
        $senaraiRisikoArray = DB::table('daftarrisiko')
                                ->join('isu', 'daftarrisiko.isu_id', '=', 'isu.id')
                                ->where('daftarrisiko.borangdaftarrisiko_id', $id)
                                ->get();
        return view('semakan/daftar_risiko/senarai', [
            'bdrjArray'=>$bdrjArray,
            'daftarRisikoTerkini'=>$daftarRisikoTerkini,
            'senaraiRisikoArray'=>$senaraiRisikoArray
        ]);
    }

    public function semak($id, $daftarrisikoid) {
        $bdrj = DB::table('borangdaftarrisiko')
                    ->where('id', $id)
                    ->first();
        $daftarRisiko = DB::table('daftarrisiko')
                            ->where('id', $daftarrisikoid)
                            ->first();
        $logArray = DB::table('log_semakan_daftarrisiko')
                        ->where('daftarrisiko_id', $daftarrisikoid)
                        ->where('borangdaftarrisiko_id', $id)
                        ->get();
        return view('semakan/daftar_risiko/semak', [
            'daftarRisiko'=>$daftarRisiko,
            'bdrj'=>$bdrj,
            'logArray'=>$logArray
        ]);
    }

    public function semakBaru(Request $request, $id, $daftarrisikoid) {
        $sql = DB::table('log_semakan_daftarrisiko')
                    ->where('borangdaftarrisiko_id', $id)
                    ->where('daftarrisiko_id', $daftarrisikoid)
                    ->update(['terakhir' => 0]);
        $sql = DB::table('log_semakan_daftarrisiko')->insert(
            ['borangdaftarrisiko_id' => $id, 'daftarrisiko_id' => $daftarrisikoid, 'log_tarikh' => date('Y-m-d'), 'oleh' => Auth::user()->name,
            'punca' => $request->punca, 'impak_kesan' => $request->kesan, 'kawalan' => $request->kawalan, 'terakhir' => 1]
        );
        return redirect()->route('semakBDRJ', ['id' => $id, 'daftarrisikoid' => $daftarrisikoid]);
    }

    public function senaraitetapan() {
        $sql = DB::table('borangdaftarrisiko')
                    ->where('sejarah', 0)->get();
        return view('tetapan/daftar_risiko/tetapan', [
            'bdrjArray' => $sql,
        ]);

    }

    public function senaraipengesahan() {

        $dokumenArray = DB::table('borangdaftarrisiko')
                            ->where('status_hantar', 1)
                            ->where('tarikh_dikemaskini', NULL)
                            ->where('sejarah', 0)
                            ->get();
        return view('pengesahan/daftar_risiko', [
            'dokumenArray'=>$dokumenArray
        ]);
    }

    public function senaraisejarah() {

        $dokumenArray = DB::table('borangdaftarrisiko')
                        ->where('sejarah', 1)
                        ->get();
        return view('sejarah/daftar_risiko', [
            'dokumenArray'=>$dokumenArray,
        ]);
    }
}
