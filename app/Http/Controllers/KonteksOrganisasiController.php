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
        $isuTerkiniArray = DB::table('konteks_organisasi')
                                ->where('dokumen', 'isu')
                                ->whereNotNull('tarikh_disahkan')
                                ->where('sejarah', 0)
                                ->orderByDesc('tarikh_disahkan')
                                ->limit(1)->get();
        $pihakberkepentinganTerkiniArray  = DB::table('konteks_organisasi')
                                                ->where('dokumen', 'pihakberkepentingan')
                                                ->whereNotNull('tarikh_disahkan')
                                                ->where('sejarah', 0)
                                                ->orderByDesc('tarikh_disahkan')
                                                ->limit(1)->get();
        $idIsu = null;
        $idPihak = null;
        $isuTerkini = null;
        $pihakberkepentinganTerkini = null;
        foreach($isuTerkiniArray as $isuTerkini) { $idIsu = $isuTerkini->id; break; }
        foreach($pihakberkepentinganTerkiniArray as $pihakberkepentinganTerkini) { $idPihak = $pihakberkepentinganTerkini->id; break; }

        $isuluaranArray = DB::table('isu')
                            ->where('id_konteks_organisasi', $idIsu)
                            ->where('jenis', 1)
                            ->orderBy('perkara')
                            ->get();
        $isudalamanArray = DB::table('isu')
                            ->where('id_konteks_organisasi', $idIsu)
                            ->where('jenis', 0)
                            ->orderBy('perkara')
                            ->get();
        $pihakberkepentinganluaranArray = DB::table('pihak_berkepentingan')
                                            ->where('id_konteks_organisasi', $idPihak)
                                            ->where('jenis', 1)
                                            ->orderBy('pihak_berkepentingan')
                                            ->get();
        $pihakberkepentingandalamanArray = DB::table('pihak_berkepentingan')
                                            ->where('id_konteks_organisasi', $idPihak)
                                            ->where('jenis', 0)
                                            ->orderBy('pihak_berkepentingan')
                                            ->get();
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

        $isuArray = DB::table('konteks_organisasi')
                    ->whereNull('tarikh_disahkan')
                    ->where('dokumen', 'isu')
                    ->where('sejarah', 0)
                    ->get();
        $pihakArray = DB::table('konteks_organisasi')
                    ->whereNull('tarikh_disahkan')
                    ->where('dokumen', 'pihakberkepentingan')
                    ->where('sejarah', 0)
                    ->get();
        return view('semakan/konteks_organisasi', [
            'isuArray'=>$isuArray,
            'pihakArray'=>$pihakArray
        ]);
    }

    public function senaraitetapan() {

        $isuArray = DB::table('konteks_organisasi')
                    ->where('dokumen', 'isu')
                    ->where('sejarah', 0)
                    ->get();
        $pihakArray = DB::table('konteks_organisasi')
                    ->where('dokumen', 'pihakberkepentingan')
                    ->where('sejarah', 0)
                    ->get();
        return view('tetapan/konteks_organisasi', [
            'isuArray'=>$isuArray,
            'pihakArray'=>$pihakArray
        ]);
    }

    public function senaraipengesahan() {
        $dokumenArray = DB::table('konteks_organisasi')
                            ->whereNull('tarikh_disahkan')
                            ->where('status_hantar', 1)
                            ->where('sejarah', 0)
                            ->get();
        return view('pengesahan/konteks_organisasi', [
            'dokumenArray'=>$dokumenArray
        ]);
    }

    public function senaraisejarah() {

        $isuArray = DB::table('konteks_organisasi')
                        ->where('dokumen', 'isu')
                        ->where('sejarah', 1)
                        ->get();
        $pihakArray = DB::table('konteks_organisasi')
                        ->where('dokumen', 'pihakberkepentingan')
                        ->where('sejarah', 1)
                        ->get();
        return view('sejarah/konteks_organisasi', [
            'isuArray'=>$isuArray,
            'pihakArray'=>$pihakArray
        ]);
    }

    public function lihat($id) {
        $qryArray = DB::table('konteks_organisasi')
                        ->where('id', $id)
                        ->get();
        foreach($qryArray as $qry) {
            if($qry->dokumen == "isu") {
                $dokumen = "Dokumen Isu";
                $konteks_organisasi = $qry;
                $isuluaranArray = DB::table('isu')
                                        ->where('id_konteks_organisasi', $id)
                                        ->where('jenis', 1)
                                        ->orderBy('perkara')
                                        ->get();
                $isudalamanArray = DB::table('isu')
                                        ->where('id_konteks_organisasi', $id)
                                        ->where('jenis', 0)
                                        ->orderBy('perkara')
                                        ->get();
                return view('konteks_organisasi_lihatIsu',[
                    'dokumen'=>$dokumen,
                    'konteks_organisasi'=>$konteks_organisasi,
                    'isuluaranArray'=>$isuluaranArray,
                    'isudalamanArray'=>$isudalamanArray
                ]);
            } else {
                $dokumen = "Dokumen Pihak Berkepentingan";
                $konteks_organisasi = $qry;
                $pihakberkepentinganluaranArray = DB::table('pihak_berkepentingan')
                                                        ->where('id_konteks_organisasi', $id)
                                                        ->where('jenis', 1)
                                                        ->orderBy('pihak_berkepentingan')
                                                        ->get();
                $pihakberkepentingandalamanArray = DB::table('pihak_berkepentingan')
                                                        ->where('id_konteks_organisasi', $id)
                                                        ->where('jenis', 0)
                                                        ->orderBy('pihak_berkepentingan')
                                                        ->get();
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
        $qryArray = DB::table('konteks_organisasi')
                        ->where('id', $id)
                        ->get();
        foreach($qryArray as $qry) {
            if($qry->dokumen == "isu") {
                $dokumen = "Dokumen Isu";
                $konteks_organisasi = $qry;
                $isuluaranArray = DB::table('isu')
                                    ->where('id_konteks_organisasi', $id)
                                    ->where('jenis', 1)
                                    ->orderBy('perkara')
                                    ->get();
                $isudalamanArray = DB::table('isu')
                                        ->where('id_konteks_organisasi', $id)
                                        ->where('jenis', 0)
                                        ->orderBy('perkara')
                                        ->get();
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
                $pihakberkepentinganluaranArray = DB::table('pihak_berkepentingan')
                                                        ->where('id_konteks_organisasi', $id)
                                                        ->where('jenis', 1)
                                                        ->orderBy('pihak_berkepentingan')
                                                        ->get();
                $pihakberkepentingandalamanArray = DB::table('pihak_berkepentingan')
                                                        ->where('id_konteks_organisasi', $id)
                                                        ->where('jenis', 0)
                                                        ->orderBy('pihak_berkepentingan')
                                                        ->get();
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

    public function tambahIsu(Request $request) {
        $terkini = DB::table('konteks_organisasi')
                        ->where('dokumen', 'isu')
                        ->whereNotNull('tarikh_disahkan')
                        ->where('sejarah', 0)
                        ->orderByDesc('tarikh_disahkan')
                        ->limit(1)
                        ->get();
        foreach($terkini as $dokumenTerkini) { break; }
            $isuArray = DB::table('isu')
                        ->where('id_konteks_organisasi', $dokumenTerkini->id)
                        ->get();
            DB::table('konteks_organisasi')->insert([
                ['dokumen' => 'isu', 'kod_keluaran' => ''.$request->bilangan.'', 'tarikh_disahkan' => NULL, 'tarikh_disemak_bermula' => ''.$request->bermula.'', 'tarikh_disemak_berakhir' => ''.$request->berakhir.''],
            ]);
            $newDokumen = DB::getPdo()->lastInsertId();
            foreach($isuArray as $isu) {
                DB::table('isu')->insert([
                    ['id_konteks_organisasi' => $newDokumen, 'perkara' => $isu->perkara, 'isu' => $isu->isu, 'kesan' => $isu->kesan, 'jenis' => $isu->jenis],
                ]);
            }
        return redirect()->route('tetapanKonteks');
    }

    public function tambahPihak(Request $request) {
        $terkini = DB::table('konteks_organisasi')
                        ->where('dokumen', 'pihakberkepentingan')
                        ->whereNotNull('tarikh_disahkan')
                        ->where('sejarah', 0)
                        ->orderByDesc('tarikh_disahkan')
                        ->limit(1)
                        ->get();
        foreach($terkini as $dokumenTerkini) { break; }
            $pihakArray = DB::table('pihak_berkepentingan')
                            ->where('id_konteks_organisasi', $dokumenTerkini->id)
                            ->get();
            DB::table('konteks_organisasi')->insert([
                ['dokumen' => 'pihakberkepentingan', 'kod_keluaran' => ''.$request->bilangan.'', 'tarikh_disahkan' => NULL, 'tarikh_disemak_bermula' => ''.$request->bermula.'', 'tarikh_disemak_berakhir' => ''.$request->berakhir.'']
            ]);
            $newDokumen = DB::getPdo()->lastInsertId();
            foreach($pihakArray as $pihak) {
                DB::table('pihak_berkepentingan')->insert([
                    ['id_konteks_organisasi' => $newDokumen, 'pihak_berkepentingan' => $pihak->pihak_berkepentingan, 'peranan' => $pihak->peranan, 'keperluan' => $pihak->keperluan, 'jenis' => $pihak->jenis],
                ]);
            }
            return redirect()->route('tetapanKonteks');
    }

    public function ubahtarikh(Request $request) {
        $sql = DB::table('konteks_organisasi')
                    ->where('id', $request->id)
                    ->update(['tarikh_disemak_bermula' => $request->bermula, 'tarikh_disemak_berakhir' => $request->berakhir]);
        return redirect()->back();
    }

    public function hantar($id) {
        DB::table('konteks_organisasi')
            ->where('id', $id)
            ->update(['status_hantar' => 1]);
        return redirect()->route('tetapanKonteks');
    }

    public function sejarah($id) {
        DB::table('konteks_organisasi')
            ->where('id', $id)
            ->update(['sejarah' => 1]);
        return redirect()->route('tetapanKonteks');
    }

}
