@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Tetapan Daftar Risiko</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Tetapan</li>
      <li class="breadcrumb-item active">Daftar Risiko</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
  <div class="card card-danger card-outline ">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11">
                <span class="card-title">Senarai Tetapan Daftar Risiko</span>
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
          </div>
    </div>
    <div class="card-body pt-0">
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
                @foreach ($bdrjArray as $bdrj)
                <?php
                $statusHantar = $bdrj->status_hantar;
                $tarikhSah = $bdrj->tarikh_dikemaskini;
                $mula = date("$bdrj->tarikh_disemak_bermula");
                $akhir = date("$bdrj->tarikh_disemak_berakhir");
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
                        <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$bdrj->id' data-keluaran='$bdrj->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                        <a href='/daftar_risiko/lihat/$bdrj->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                    ";
                } else if(date("Y-m-d") > $akhir) { //telah tamat, disabled btn semak
                    if($tarikhSah == NULL) {
                        if($statusHantar == 0) { //belum dihantar ke jk
                                $statusSemakan = "<p class='badge badge bg-success'>TEMPOH SEMAKAN TELAH SELESAI</p>";
                                $tindakanSemakan = "
                                    <a href='#' class='btn badge bg-info' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</a>
                                    <a href='#' class='btn badge bg-danger' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</a>
                                    <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$bdrj->id' data-keluaran='$bdrj->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                                    <a href='/daftar_risiko/lihat/$bdrj->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                                ";
                            } else { // telah dihantar ke jk
                                $statusSemakan = "<p class='badge badge bg-orange'>SEDANG DILULUSKAN JK RISIKO</p>";
                                $tindakanSemakan = "
                                    <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                                    <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</button>
                                    <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                                    <a href='/daftar_risiko/lihat/$bdrj->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                                ";
                            }
                    } else { // telah disahkan jk
                        $statusSemakan = "<p class='badge badge bg-lime'>TELAH DISAHKAN JK RISIKO</p>";
                        $tindakanSemakan = "
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                            <a href='#' class='btn badge bg-danger' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</a>
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                            <a href='/daftar_risiko/lihat/$bdrj->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                        ";
                    }
                } else { //sedang
                    $statusSemakan = "<p class='badge bg-warning'>UNTUK DISEMAK OLEH PENGGUNA</p>";
                    $tindakanSemakan = "
                        <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-upload'></i> Hantar ke JK</button>
                        <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-save'></i> Simpan Ke Sejarah</button>
                        <button data-toggle='modal' data-target='#ubahTarikh' data-mula='$mula' data-akhir='$akhir' data-id='$bdrj->id' data-keluaran='$bdrj->kod_keluaran' class='btn badge bg-warning' style='width:120px'><i class='fas fa-cog'></i> Ubah Tarikh</button>
                        <a href='/daftar_risiko/lihat/$bdrj->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i> Lihat</a>
                    ";
                }
                ?>
                <tr>
                    <td class='text-center'>{{ ++$no }}</td>
                    <td class='text-center'><strong>{{ $bdrj->kod_keluaran }}</strong></td>
                    <td>{!! $tarikhSemakan !!}</td>
                    <td class='text-center'>{!! $statusSemakan !!}</td>
                    <td class='text-center'>{!! $tindakanSemakan !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->

@stop

@section('script')
<!--- JS SCRIPT --->
<script>
</script>
@stop

@section('sidebar_item', 'item-tetapan-daftar-risiko') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-tetapan') <!--- HIGHLIGHT SELECTED TREE --->
