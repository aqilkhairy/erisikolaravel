@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Sejarah Konteks Organisasi</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Sejarah</li>
      <li class="breadcrumb-item active">Konteks Organisasi</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
  <div class="card card-secondary card-outline card-tabs ">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Sejarah Konteks Organisasi</h3></li>
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width:10px">#</th>
                        <th class="text-center" style="width:250px">Keluaran</th>
                        <th class="text-center">Tarikh Disahkan</th>
                        <th class="text-center" style="width:300px">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($isuArray as $isu)
                    <?php
                        $tarikh = date("$isu->tarikh_disahkan");
                        $hari = date("l", strtotime($tarikh));
                        $tindakanSemakan = "
                            <a href='#' class='btn badge bg-success' style='width:90px'><i class='fas fa-upload'></i>Kembalikan</a>
                            <a href='#' class='btn badge bg-danger' style='width:80px'><i class='fas fa-trash'></i>Hapus</a>
                            <a href='#' class='btn badge bg-primary' style='width:80px'><i class='fas fa-search'></i>Lihat</a>
                        ";
                    ?>
                    <tr>
                        <td class='text-center'>{{ ++$no }}</td>
                        <td class='text-center'><strong>{{ $isu->kod_keluaran }}</strong></td>
                        <td class='text-center'><b>{{ $isu->tarikh_disahkan }}</b> ({{ $hari }})</td>
                        <td class='text-center'>{!! $tindakanSemakan !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="tab-pihak">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width:10px">#</th>
                        <th class="text-center" style="width:250px">Keluaran</th>
                        <th class="text-center">Tarikh Disahkan</th>
                        <th class="text-center" style="width:150px">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($pihakArray as $pihak)
                    <?php
                        $tarikh = date("$pihak->tarikh_disahkan");
                        $hari = date("l", strtotime($tarikh));
                        $tindakanSemakan = "
                            <a href='#' class='btn badge bg-success' style='width:90px'><i class='fas fa-upload'></i>Kembalikan</a>
                            <a href='#' class='btn badge bg-danger' style='width:80px'><i class='fas fa-trash'></i>Hapus</a>
                            <a href='#' class='btn badge bg-primary' style='width:80px'><i class='fas fa-search'></i>Lihat</a>
                        ";
                    ?>
                    <tr>
                        <td class='text-center'>{{ ++$no }}</td>
                        <td class='text-center'><strong>{{ $pihak->kod_keluaran }}</strong></td>
                        <td class='text-center'><b>{{ $pihak->tarikh_disahkan }}</b> ({{ $hari }})</td>
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

@section('sidebar_item', 'item-sejarah-konteks-organisasi') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-sejarah') <!--- HIGHLIGHT SELECTED TREE --->