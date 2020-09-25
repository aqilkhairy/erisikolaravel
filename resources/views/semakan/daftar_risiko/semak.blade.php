@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Semakan - Daftar Risiko {{ $daftarRisiko->no_rujukan }}</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Semakan</li>
      <li class="breadcrumb-item">Daftar Risiko</li>
        <li class="breadcrumb-item">{{ $bdrj->kod_keluaran }}</li>
        <li class="breadcrumb-item">{{ $daftarRisiko->no_rujukan }}</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Penilaian Tahap Risiko</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-default">
                    <div class="info-box-content">
                      <span class="info-box-text text-center ">Kebarangkalian</span>
                      <span class="info-box-number text-center mb-0">{{ $daftarRisiko->kebarangkalian }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-default">
                    <div class="info-box-content">
                      <span class="info-box-text text-center ">Impak</span>
                      <span class="info-box-number text-center mb-0">{{ $daftarRisiko->impak }}</span>
                    </div>
                  </div>
                </div>
                <?php
                    $tahap = ($daftarRisiko->kebarangkalian)*($daftarRisiko->impak);
                    $bg = "";
                    if($tahap <= 4) $bg = "bg-success";
                    else if($tahap <= 9) $bg = "bg-warning";
                    else if($tahap <= 14) $bg = "bg-orange";
                    else if($tahap <= 25) $bg = "bg-danger";
                ?>
                <div class="col-12 col-sm-4">
                  <div class="info-box {{ $bg }}">
                    <div class="info-box-content">
                      <span class="info-box-text text-center">Tahap Risiko</span>
                      <span class="info-box-number text-center  mb-0">{{ $tahap }}<span>
                    </span></span></div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <p class="card-title">Maklumat Untuk Disemak</p>
        </div>
        <div class="card-body">
            <form id="formSemak" method="get" action="{{ route('hantarSemakBDRJ', ["id"=>$bdrj->id, "daftarrisikoid"=>$daftarRisiko->id]) }}">
            <div class="row">
                <div class="col">
                    <strong><u>Punca Risiko</u></strong>
                    <div class="form-control" id="summernotePunca" name="summernotePunca"></div><br>
                    <input type="text" hidden id="punca" name="punca">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <strong><u>Impak/Kesan Risiko</u></strong>
                    <div class="form-control" id="summernoteKesan" name="summernoteKesan"></div><br>
                    <input type="text" hidden id="kesan" name="kesan">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <strong><u>Kawalan Risiko</u></strong>
                    <div class="form-control" id="summernoteKawalan" name="summernoteKawalan"></div><br>
                    <input type="text" hidden id="kawalan" name="kawalan">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @php $logTerkini = $logArray->where('terakhir', '=', 1)->first(); @endphp
                    <button type="button" class="btn float-right btn-warning" onclick="semak()"><i class="fas fa-save"></i> Simpan Semakan</button>
                    <span id="logBtn" class="btn btn-info" data-toggle="modal" data-target="#modalLogSemak" data-punca="{!! $logTerkini->punca !!}" data-kesan="{!! $logTerkini->impak_kesan !!}" data-kawalan="{!! $logTerkini->kawalan !!}" ><i class="fas fa-list"></i> Papar Log Semakan</span>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->

@stop

@section('before_js')
<!--- CUSTOM MODAL --->
<div class="modal fade" id="modalLogSemak" tabindex="-1" role="dialog" aria-labelledby="modalLogSemakLabel">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modalLogSemakLabel">Log Semakan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

            <table class="table table-bordered">
              <thead>
                  <th>Punca Risiko</th>
                  <th>Impak/Kesan Risiko</th>
                  <th>Kawalan Risiko</th>
                  <th>Maklumat Semakan</th>
              </thead>
              <tbody id="logsemakan">

              </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button id="kembali" type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>
<!--- CUSTOM MODAL ENDS --->
@endsection


@section('script')

<script>
    $(document).ready(function($) {
        $("#summernotePunca").summernote('code', $("#logBtn").data('punca'));
        $("#summernoteKesan").summernote('code', $("#logBtn").data('kesan'));
        $("#summernoteKawalan").summernote('code', $("#logBtn").data('kawalan'));
        var logTable = "";
        @foreach($logArray as $log)
        var id = '{{ $log->daftarrisiko_id }}';
        var terkini = "";
        if(id == '{{ $daftarRisiko->id }}') {
            if('{{ $log->terakhir }}' == '1') {
            terkini = "<span class='badge bg-success'>TERKINI</span>"
            }
            logTable += "<tr><td>{{ $log->punca }}</td><td>{{ $log->impak_kesan }}</td><td>{{ $log->kawalan }}</td><td><span class='text-muted'>Disemak oleh:</span> {{ $log->oleh }}<br><span class='text-muted'>Pada:</span> {{ $log->log_tarikh }} "+ terkini +"</td></tr>";
        }
        @endforeach
        document.getElementById("logsemakan").innerHTML = logTable;
    });

    function semak() {
        var punca = $("#summernotePunca").summernote('code');
        var kesan = $("#summernoteKesan").summernote('code');
        var kawalan = $("#summernoteKawalan").summernote('code');
        document.getElementById("punca").value = punca;
        document.getElementById("kesan").value = kesan;
        document.getElementById("kawalan").value = kawalan;
        Swal.fire({
            title: 'Berjaya!',
            text: "Semakan anda telah direkod di dalam sistem.",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Selesai'
            }).then((result) => {
                $('#formSemak').submit();
            })
    }
</script>

@stop

@section('sidebar_item', 'item-semakan-daftar-risiko') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-semakan') <!--- HIGHLIGHT SELECTED TREE --->
