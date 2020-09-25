@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Tetapan Konteks Organisasi</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Tetapan</li>
      <li class="breadcrumb-item active">Konteks Organisasi</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
  <div class="card card-danger card-outline card-tabs ">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Tetapan Konteks Organisasi</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#tab-isu" aria-selected="true">Dokumen Isu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#tab-pihak" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Dokumen Pihak Berkepentingan</a>
                  </li>
                </ul>
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
          </div>
    </div>
    <div class="card-body pt-0">
        <button id="tambahIsu" class="btn btn-block btn-flat bg-olive mb-2 mt-2" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus"></i> Tambah Keluaran Konteks Organisasi Baharu</button>
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade active show" id="tab-isu">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width:10px">#</th>
                        <th class="text-center" style="width:100px">Keluaran</th>
                        <th class="text-center">Tarikh Untuk Disemak</th>
                        <th class="text-center">Status Semakan</th>
                        <th class="text-center" style="width:300px">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($isuArray as $isu)
                    <?php
                    $statusHantar = $isu->status_hantar;
                    $tarikhSah = $isu->tarikh_disahkan;
                    $mula = date("$isu->tarikh_disemak_bermula");
                    $akhir = date("$isu->tarikh_disemak_berakhir");
                    $hariMula = date("l", strtotime($mula));
                    $hariAkhir = date("l", strtotime($akhir));
                    $tarikhSemakan = "
                        <strong>Tarikh Bermula  :</strong> $mula ($hariMula)<br>
                        <strong>Tarikh Berakhir :</strong> $akhir ($hariAkhir)";
                    $statusSemakan = "";
                    $tindakanSemakan = "";
                    if(date("Y-m-d") < $mula) { //belum bermula, disabled btn semak & lihat
                        $statusSemakan = "<p class='badge bg-secondary'>TEMPOH SEMAKAN BELUM BERMULA</p>";
                        $tindakanSemakan = "
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                            <a href='#' class='btn badge bg-danger' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</a>
                            <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$isu->id' data-keluaran='$isu->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                            <a href='/konteks_organisasi/lihat/$isu->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                        ";
                    } else if(date("Y-m-d") > $akhir) { //telah tamat, disabled btn semak
                        if($tarikhSah == NULL) {
                            if($statusHantar == 0) { //belum dihantar ke jk
                                    $statusSemakan = "<p class='badge badge bg-success'>TEMPOH SEMAKAN TELAH SELESAI</p>";
                                    $tindakanSemakan = "
                                        <a href='#' class='btn badge bg-info' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</a>
                                        <a href='#' class='btn badge bg-danger' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</a>
                                        <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$isu->id' data-keluaran='$isu->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                                        <a href='/konteks_organisasi/lihat/$isu->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                                    ";
                                } else { // telah dihantar ke jk
                                    $statusSemakan = "<p class='badge badge bg-orange'>SEDANG DILULUSKAN JK RISIKO</p>";
                                    $tindakanSemakan = "
                                        <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                                        <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</button>
                                        <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                                        <a href='/konteks_organisasi/lihat/$isu->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                                    ";
                                }
                        } else { // telah disahkan jk
                            $statusSemakan = "<p class='badge badge bg-lime'>TELAH DISAHKAN JK RISIKO</p>";
                            $tindakanSemakan = "
                                <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                                <a href='#' class='btn badge bg-danger' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</a>
                                <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                                <a href='/konteks_organisasi/lihat/$isu->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                            ";
                        }
                    } else { //sedang
                        $statusSemakan = "<p class='badge bg-warning'>UNTUK DISEMAK OLEH PENGGUNA</p>";
                        $tindakanSemakan = "
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</button>
                            <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$isu->id' data-keluaran='$isu->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                            <a href='/konteks_organisasi/lihat/$isu->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                        ";
                    }
                    ?>
                    <tr>
                        <td class='text-center'>{{ ++$no }}</td>
                        <td class='text-center'><strong>{{ $isu->kod_keluaran }}</strong></td>
                        <td>{!! $tarikhSemakan !!}</td>
                        <td class='text-center'>{!! $statusSemakan !!}</td>
                        <td class='text-center'>{!! $tindakanSemakan !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="tab-pihak">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width:10px">#</th>
                        <th class="text-center" style="width:100px">Keluaran</th>
                        <th class="text-center">Tarikh Untuk Disemak</th>
                        <th class="text-center">Status Semakan</th>
                        <th class="text-center" style="width:300px">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($pihakArray as $pihak)
                    <?php
                    $statusHantar = $pihak->status_hantar;
                    $tarikhSah = $pihak->tarikh_disahkan;
                    $mula = date("$pihak->tarikh_disemak_bermula");
                    $akhir = date("$pihak->tarikh_disemak_berakhir");
                    $hariMula = date("l", strtotime($mula));
                    $hariAkhir = date("l", strtotime($akhir));
                    $tarikhSemakan = "
                        <strong>Tarikh Bermula  :</strong> $mula ($hariMula)<br>
                        <strong>Tarikh Berakhir :</strong> $akhir ($hariAkhir)";
                    $statusSemakan = "";
                    $tindakanSemakan = "";
                    if(date("Y-m-d") < $mula) { //belum bermula, disabled btn semak & lihat
                        $statusSemakan = "<p class='badge bg-secondary'>TEMPOH SEMAKAN BELUM BERMULA</p>";
                        $tindakanSemakan = "
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                            <a href='#' class='btn badge bg-danger' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</a>
                            <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$pihak->id' data-keluaran='$pihak->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                            <a href='/konteks_organisasi/lihat/$pihak->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                        ";
                    } else if(date("Y-m-d") > $akhir) { //telah tamat, disabled btn semak
                        if($tarikhSah == NULL) {
                            if($statusHantar == 0) { //belum dihantar ke jk
                                    $statusSemakan = "<p class='badge badge bg-success'>TEMPOH SEMAKAN TELAH SELESAI</p>";
                                    $tindakanSemakan = "
                                        <a href='#' class='btn badge bg-info' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</a>
                                        <a href='#' class='btn badge bg-danger' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</a>
                                        <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$pihak->id' data-keluaran='$pihak->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                                        <a href='/konteks_organisasi/lihat/$pihak->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                                    ";
                                } else { // telah dihantar ke jk
                                    $statusSemakan = "<p class='badge badge bg-orange'>SEDANG DILULUSKAN JK RISIKO</p>";
                                    $tindakanSemakan = "
                                        <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                                        <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</button>
                                        <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                                        <a href='/konteks_organisasi/lihat/$pihak->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                                    ";
                                }
                        } else { // telah disahkan jk
                            $statusSemakan = "<p class='badge badge bg-lime'>TELAH DISAHKAN JK RISIKO</p>";
                            $tindakanSemakan = "
                                <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                                <a href='#' class='btn badge bg-danger' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</a>
                                <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                                <a href='/konteks_organisasi/lihat/$pihak->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                            ";
                        }
                    } else { //sedang
                        $statusSemakan = "<p class='badge bg-warning'>UNTUK DISEMAK OLEH PENGGUNA</p>";
                        $tindakanSemakan = "
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</button>
                            <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$pihak->id' data-keluaran='$pihak->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                            <a href='/konteks_organisasi/lihat/$pihak->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                        ";
                    }
                    ?>
                    <tr>
                        <td class='text-center'>{{ ++$no }}</td>
                        <td class='text-center'><strong>{{ $pihak->kod_keluaran }}</strong></td>
                        <td>{!! $tarikhSemakan !!}</td>
                        <td class='text-center'>{!! $statusSemakan !!}</td>
                        <td class='text-center'>{!! $tindakanSemakan !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->

<!-- TAMBAH MODAL --->
<div class="modal fade" id="tambahModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Keluaran Konteks Organisasi Baharu</h4>
      </div>
      <form id="formTambah" method="get" action="/konteks_organisasi/tambah">
      <div class="modal-body">
          <div class="form-group">
            <label for="bilangan">Bilangan: </label>
            <input required class="form-control" type="text" id="bilangan" name="bilangan">
            <label for="tarikhAwal">Tarikh Semakan Bermula: </label>
            <input required class="form-control" type="date" id="bermula" name="bermula">
            <label for="tarikhAkhir">Tarikh Semakan Berakhir: </label>
            <input required class="form-control" type="date" id="berakhir" name="berakhir">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary btnTambah">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ubahTarikh">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Tarikh Semakan Konteks Organisasi</h4>
        </div>
        <form id="formUbahTarikh" method="get" action="/konteks_organisasi/ubahtarikh">
        <div class="modal-body">
            <div class="form-group">
              <label for="bilangan">Bilangan: </label>
              <input hidden type="text" id="id" name="id">
              <input disabled class="form-control" type="text" id="bilangan" name="bilangan">
              <label for="tarikhAwal">Tarikh Semakan Bermula: </label>
              <input required class="form-control" type="date" id="bermula" name="bermula">
              <label for="tarikhAkhir">Tarikh Semakan Berakhir: </label>
              <input required class="form-control" type="date" id="berakhir" name="berakhir">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary btnUbahTarikh" value='Simpan'>Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@stop

@section('script')
<!--- JS SCRIPT --->
<script>
    $(document).ready(function() {
        $('.btnUbahTarikh').click(function() {
            Swal.fire({
                title: 'Berjaya!',
                text: "Tarikh semakan sudah diperbaharui.",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai'
            }).then((result) => {
                $("#formUbahTarikh").submit();
            })
        })
        $('.btnTambah').click(function() {
            Swal.fire({
              title: 'Anda pasti ingin menambah keluaran baharu?',
              text: "Keluaran ini disalin daripada keluaran terkini.",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, saya pasti!',
              cancelButtonText: 'Kembali'
            }).then((result) => {
              if (result.value) {
                if($("#formTambah")[0].checkValidity()) {
                    Swal.fire(
                      'Selesai!',
                      'Keluaran baharu berjaya.',
                      'success'
                    ).then(function () {
                        $("#formTambah").submit();
                    })
                } else {
                    Swal.fire(
                      'Gagal!',
                      'Sila pastikan semua ruangan telah diisi dengan tepat.',
                      'error'
                    )
                }
              }
            })
        })

        $('#ubahTarikh').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            $('#ubahTarikh #id').val(button.data('id'));
            $('#ubahTarikh #bilangan').val(button.data('keluaran'));
            $('#ubahTarikh #bermula').val(button.data('mula'));
            $('#ubahTarikh #berakhir').val(button.data('akhir'));
        })
    })
</script>
@stop

@section('sidebar_item', 'item-tetapan-konteks-organisasi') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-tetapan') <!--- HIGHLIGHT SELECTED TREE --->
