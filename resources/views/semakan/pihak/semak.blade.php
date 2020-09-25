@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Semakan - Pihak Berkepentingan {{ $konteks_organisasi->kod_keluaran }}</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Semakan</li>
      <li class="breadcrumb-item">Konteks Organisasi</li>
      <li class="breadcrumb-item">Pihak Berkepentingan</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
    <!-- CARD -->
  <div class="card card-warning card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-isuDalaman-tab" data-toggle="pill" href="#custom-tabs-one-isuDalaman" role="tab" aria-controls="custom-tabs-one-isuDalaman" aria-selected="true">Pihak Berkepentingan Dalaman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-isuLuaran-tab" data-toggle="pill" href="#custom-tabs-one-isuLuaran" role="tab" aria-controls="custom-tabs-one-isuLuaran" aria-selected="false">Pihak Berkepentingan Luaran</a>
          </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-one-isuDalaman" role="tabpanel" aria-labelledby="custom-tabs-one-isuDalaman-tab">
              @php $pihak_berkepentingan=null; @endphp
                @foreach($pihakberkepentingandalamanArray as $pihakberkepentingandalaman)
                    @if($pihakberkepentingandalaman->pihak_berkepentingan != $pihak_berkepentingan)
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $pihakberkepentingandalaman->pihak_berkepentingan }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th style="width: 50%" class="text-center">Peranan</th>
                                <th style="width: 45%" class="text-center">Keperluan</th>
                                <th style="width: 5%" class="text-center">Tindakan</th>
                            </thead>
                            <tbody>
                    @endif
                                <tr>
                                    <td name="peranan">{!! $pihakberkepentingandalaman->peranan !!}</td>
                                    <td name="keperluan">{!! $pihakberkepentingandalaman->keperluan !!}</td>
                                    <td class="text-center" name="tindakan">
                                        <button class="btn badge bg-warning btnsemak" id="btnPihak" data-toggle="modal" data-target="#modalSemak" data-peranan="{!! $pihakberkepentingandalaman->peranan !!}" data-keperluan="{!! $pihakberkepentingandalaman->keperluan !!}" data-pihakid="{!! $pihakberkepentingandalaman->id !!}"><i class="fas fa-edit"></i>Semak</button>
                                        <button data-toggle="modal" data-target="#modalLogSemak" data-logtable="" data-pihakid="{!! $pihakberkepentingandalaman->id !!}" class="btn badge bg-info btnlogsemakan"><i class="fas fa-list"></i>Log Semakan</button>
                                    </td>
                                </tr>
                                @if($pihakberkepentingandalaman->pihak_berkepentingan == $pihak_berkepentingan)
                                    @continue
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-isuLuaran" role="tabpanel" aria-labelledby="custom-tabs-one-isuLuaran-tab">
              @php $pihak_berkepentingan=null; @endphp
                @foreach($pihakberkepentinganluaranArray as $pihakberkepentinganluaran)
                    @if($pihakberkepentinganluaran->pihak_berkepentingan != $pihak_berkepentingan)
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $pihakberkepentinganluaran->pihak_berkepentingan }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th style="width: 50%;" class="text-center">Peranan</th>
                                <th style="width: 45%;" class="text-center">Keperluan</th>
                                <th style="width: 5%" class="text-center">Tindakan</th>
                            </thead>
                            <tbody>
                    @endif
                                <tr>
                                    <td name="peranan">{!! $pihakberkepentinganluaran->peranan !!}</td>
                                    <td name="keperluan">{!! $pihakberkepentinganluaran->keperluan !!}</td>
                                    <td class="text-center" name="tindakan">
                                        <button class="btn badge bg-warning btnsemak" id="btnPihak" data-toggle="modal" data-target="#modalSemak" data-peranan="{!! $pihakberkepentinganluaran->peranan !!}" data-keperluan="{!! $pihakberkepentinganluaran->keperluan !!}" data-pihakid="{!! $pihakberkepentinganluaran->id !!}"><i class="fas fa-edit"></i>Semak</button>
                                        <button data-toggle="modal" data-target="#modalLogSemak" data-logtable="" data-pihakid="{!! $pihakberkepentinganluaran->id !!}" class="btn badge bg-info btnlogsemakan"><i class="fas fa-list"></i>Log Semakan</button>
                                    </td>
                                </tr>
                                @if($pihakberkepentinganluaran->pihak_berkepentingan == $pihak_berkepentingan)
                                    @continue
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</section>
<!-- /.content -->

@stop

@section('before_js')
<!--- CUSTOM MODAL --->
<div class="modal fade" id="modalSemak" tabindex="-1" role="dialog" aria-labelledby="modalSemakLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modalSemakLabel">Semak Pihak Berkepentingan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
      <form id="formSemak" action="{{ $konteks_organisasi->id }}/selesai" method="get">
        <div class="modal-body">
            <div class="form-group">
                <input hidden id="pihakid" name="dokumenId">
              <label for="peranan" class="control-label">Peranan:</label>
                <div class="form-control" id="modalsummernoteIsu" name="modalsummernoteIsu"></div>
                <input hidden id="summernoteisu" name="col1">
            </div>
            <div class="form-group">
              <label for="keperluan" class="control-label">Keperluan:</label>
              <div class="form-control" id="modalsummernoteKesan" name="modalsummernoteKesan"></div>
                <input hidden id="summernotekesan" name="col2">
            </div>
        </div>
        <div class="modal-footer">
          <button id="batal" type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button id="simpan" type="button" class="btn btn-primary" onclick="semakFunc()" value="Simpan">Simpan</button>
        </div>
      </form>
      </div>
    </div>
  </div>

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
                  <th style="width: 300px">Peranan</th>
                  <th style="width: 300px">Keperluan</th>
                  <th>Disemak Oleh</th>
                  <th style="width: 50px">Tarikh</th>
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
    $(document).ready(function() {
          $("#modalSemak").on('show.bs.modal', function (event) {
              $("#modalsummernoteIsu").summernote('reset');
              $("#modalsummernoteKesan").summernote('reset');
          var button = $(event.relatedTarget);
          var peranan = button.data('peranan');
          var keperluan = button.data('keperluan');
            var pihakid = button.data('pihakid');
            $("#modalsummernoteIsu").summernote('code', peranan);
            $("#modalsummernoteKesan").summernote('code', keperluan);
              document.getElementById("pihakid").value = pihakid;
            });
          $('#modalLogSemak').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget);
              var pihakid = button.data('pihakid');
              var logTable = "";
              @foreach($logArray as $log)
                var dokumenId = '{{ $log->dokumen_id }}';
                var terkini = "";
                if(dokumenId == pihakid) {
                  if('{{ $log->terakhir }}' == '1') {
                    terkini = "<span class='badge bg-success'>TERKINI</span>"
                  }
                  logTable += "<tr><td>{!! $log->log_col1 !!}</td><td>{!! $log->log_col2 !!}</td><td>{{ $log->oleh }}</td><td style='text-align: center;'>{{ $log->log_tarikh }}"+ terkini +"</td></tr>";
                }
              @endforeach
              document.getElementById("logsemakan").innerHTML = logTable;
            });

        });


        function semakFunc() {
            var isu = $('#modalsummernoteIsu').summernote('code');
            var kesan = $('#modalsummernoteKesan').summernote('code');
            document.getElementById("summernoteisu").value = isu;
            document.getElementById("summernotekesan").value = kesan;
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

@section('sidebar_item', 'item-semakan-konteks-organisasi') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-semakan') <!--- HIGHLIGHT SELECTED TREE --->
