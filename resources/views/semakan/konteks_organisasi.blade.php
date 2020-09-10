@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Semakan Konteks Organisasi</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Semakan</li>
      <li class="breadcrumb-item active">Konteks Organisasi</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
  <div class="card card-warning card-outline card-tabs ">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Senarai Semakan Konteks Organisasi</h3></li>
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
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade active show" id="tab-isu">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width:10px">#</th>
                        <th class="text-center" style="width:250px">Keluaran</th>
                        <th class="text-center">Tarikh Untuk Disemak</th>
                        <th class="text-center">Status Semakan</th>
                        <th class="text-center" style="width:150px">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($isuArray as $isu)
                    <?php
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
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-edit'></i>Semak</button>
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-search'></i>Lihat</button>
                        ";
                    } else if(date("Y-m-d") > $akhir) { //telah tamat, disabled btn semak
                        $statusSemakan = "<p class='badge badge bg-success'>TEMPOH SEMAKAN TELAH SELESAI</p>";
                        $tindakanSemakan = "
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-edit'></i>Semak</button>
                            <a href='/konteks_organisasi/lihat/$isu->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i>Lihat</a>
                        ";
                    } else { //sedang
                        $statusSemakan = "<p class='badge bg-warning'>UNTUK DISEMAK OLEH PENGGUNA</p>";
                        $tindakanSemakan = "
                            <a href='#' class='btn badge bg-warning' style='width:120px'><i class='fas fa-edit'></i>Semak</a>
                            <a href='/konteks_organisasi/lihat/$isu->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i>Lihat</a>
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
                        <th class="text-center" style="width:250px">Keluaran</th>
                        <th class="text-center">Tarikh Untuk Disemak</th>
                        <th class="text-center">Status Semakan</th>
                        <th class="text-center" style="width:150px">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($pihakArray as $pihak)
                    <?php
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
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-edit'></i>Semak</button>
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-search'></i>Lihat</button>
                        ";
                    } else if(date("Y-m-d") > $akhir) { //telah tamat, disabled btn semak
                        $statusSemakan = "<p class='badge badge bg-success'>TEMPOH SEMAKAN TELAH SELESAI</p>";
                        $tindakanSemakan = "
                            <button disabled class='btn badge bg-secondary' style='width:120px'><i class='fas fa-edit'></i>Semak</button>
                            <a href='/konteks_organisasi/lihat/$pihak->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i>Lihat</a>
                        ";
                    } else { //sedang
                        $statusSemakan = "<p class='badge bg-warning'>UNTUK DISEMAK OLEH PENGGUNA</p>";
                        $tindakanSemakan = "
                            <a href='#' class='btn badge bg-warning' style='width:120px'><i class='fas fa-edit'></i>Semak</a>
                            <a href='/konteks_organisasi/lihat/$pihak->id' class='btn badge bg-primary' style='width:120px'><i class='fas fa-search'></i>Lihat</a>
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
@stop

@section('sidebar_item', 'item-semakan-konteks-organisasi') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-semakan') <!--- HIGHLIGHT SELECTED TREE --->