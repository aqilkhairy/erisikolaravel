<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function semak($id) {
        $qryArray = DB::select('SELECT * FROM konteks_organisasi WHERE id = '.$id.'');
        foreach($qryArray as $qry) {
            if($qry->dokumen == "isu") {
                $dokumen = "Dokumen Isu";
                $konteks_organisasi = $qry;
                $isuluaranArray = DB::select('SELECT * FROM isu WHERE id_konteks_organisasi = '.$id.' AND jenis = 1 ORDER BY perkara');
                $isudalamanArray = DB::select('SELECT * FROM isu WHERE id_konteks_organisasi = '.$id.' AND jenis = 0 ORDER BY perkara');
                $logArray = DB::table('log_semakan_konteks')
                                ->where('konteks_organisasi_id', $id)->get();
                return view('semakan/isu/semak',[
                    'dokumen'=>$dokumen,
                    'konteks_organisasi'=>$konteks_organisasi,
                    'isuluaranArray'=>$isuluaranArray,
                    'isudalamanArray'=>$isudalamanArray,
                    'logArray'=>$logArray
                ]);
            } else {
                $dokumen = "Dokumen Pihak Berkepentingan";
                $konteks_organisasi = $qry;
                $pihakberkepentinganluaranArray = DB::select('SELECT * FROM pihak_berkepentingan WHERE id_konteks_organisasi = '.$id.' AND jenis = 1 ORDER BY pihak_berkepentingan');
                $pihakberkepentingandalamanArray = DB::select('SELECT * FROM pihak_berkepentingan WHERE id_konteks_organisasi = '.$id.' AND jenis = 0 ORDER BY pihak_berkepentingan');
                $logArray = DB::table('log_semakan_konteks')
                                ->where('konteks_organisasi_id', $id)->get();
                return view('semakan/pihak/semak',[
                    'dokumen'=>$dokumen,
                    'konteks_organisasi'=>$konteks_organisasi,
                    'pihakberkepentinganluaranArray'=>$pihakberkepentinganluaranArray,
                    'pihakberkepentingandalamanArray'=>$pihakberkepentingandalamanArray,
                    'logArray'=>$logArray
                ]);
            }
        }
    }

    public function semakBaru(Request $request, $id) {
        $sql = DB::table('log_semakan_konteks')
                    ->where('konteks_organisasi_id', $id)
                    ->where('dokumen_id', $request->dokumenId)
                    ->update(['terakhir' => 0]);
        $sql = DB::table('log_semakan_konteks')->insert(
            ['konteks_organisasi_id' => $id, 'dokumen_id' => $request->dokumenId, 'log_tarikh' => date('Y-m-d'), 'oleh' => Auth::user()->name,
            'log_col1' => $request->col1, 'log_col2' => $request->col2, 'terakhir' => 1]
        );
        return redirect()->route('semakKonteksOrganisasi', ['id' => $id]);
    }

    public function tambah(Request $request) {
        $terkini = DB::select("SELECT * FROM konteks_organisasi WHERE dokumen = 'isu' AND tarikh_disahkan IS NOT NULL AND sejarah = 0 ORDER BY tarikh_disahkan DESC LIMIT 1");
        foreach($terkini as $dokumenTerkini) { break; }
        $isuArray = DB::select("SELECT * FROM isu WHERE id_konteks_organisasi = $dokumenTerkini->id");
        $pihakArray = DB::select("SELECT * FROM pihak_berkepentingan WHERE id_konteks_organisasi = $dokumenTerkini->id");

        DB::table('konteks_organisasi')->insert([
            ['dokumen' => 'isu', 'kod_keluaran' => ''.$request->bilangan.'', 'tarikh_disahkan' => NULL, 'tarikh_disemak_bermula' => ''.$request->bermula.'', 'tarikh_disemak_berakhir' => ''.$request->berakhir.''],
            ['dokumen' => 'pihakberkepentingan', 'kod_keluaran' => ''.$request->bilangan.'', 'tarikh_disahkan' => NULL, 'tarikh_disemak_bermula' => ''.$request->bermula.'', 'tarikh_disemak_berakhir' => ''.$request->berakhir.'']
        ]);


    }

    public function ubahtarikh(Request $request) {
        $sql = DB::table('konteks_organisasi')
                    ->where('id', $request->id)
                    ->update(['tarikh_disemak_bermula' => $request->bermula, 'tarikh_disemak_berakhir' => $request->berakhir]);
        return redirect()->back();
    }



}
