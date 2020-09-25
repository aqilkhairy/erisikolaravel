@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Sejarah Daftar Risiko</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Sejarah</li>
      <li class="breadcrumb-item active">Daftar Risiko</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
  <div class="card card-secondary card-outline ">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11">
                <h3 class="card-title">Sejarah Daftar Risiko</h3>
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
          </div>
    </div>
    <div class="card-body pt-0">
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
                    @foreach ($dokumenArray as $dokumen)
                    <?php
                        $tarikh = date("$dokumen->tarikh_disahkan");
                        $hari = date("l", strtotime($tarikh));
                        $tindakanSemakan = "
                            <a href='#' class='btn badge bg-success' style='width:90px'><i class='fas fa-upload'></i>Kembalikan</a>
                            <a href='#' class='btn badge bg-danger' style='width:80px'><i class='fas fa-trash'></i>Hapus</a>
                            <a href='#' class='btn badge bg-primary' style='width:80px'><i class='fas fa-search'></i>Lihat</a>
                        ";
                    ?>
                    <tr>
                        <td class='text-center'>{{ ++$no }}</td>
                        <td class='text-center'><strong>{{ $dokumen->kod_keluaran }}</strong></td>
                        <td class='text-center'><b>{{ $dokumen->tarikh_disahkan }}</b> ({{ $hari }})</td>
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

@section('sidebar_item', 'item-sejarah-daftar-risiko') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-sejarah') <!--- HIGHLIGHT SELECTED TREE --->
