@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-7">
    <h1>Pengesahan Konteks Organisasi</h1>
  </div>
  <div class="col-sm-5">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Pengesahan</li>
      <li class="breadcrumb-item active">Konteks Organisasi</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
  <div class="card card-info card-outline ">
    <div class="card-header">
        <p class="card-title">Pengesahan Dokumen Konteks Organisasi</p>
    </div>
    <div class="card-body ">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width:30px">#</th>
                    <th class="text-center">Dokumen</th>
                    <th class="text-center" style="width:300px">Tindakan</th>
                </tr>
            </thead>
            <?php $no = 0; ?>
            <tbody>
                @foreach ($dokumenArray as $dokumen)
                <?php
                    $perkara = "";
                    $tindakan = "";
                    $strDokumen = "".$dokumen->dokumen;
                    if((trim($strDokumen) == "isu")) { $perkara .= "ISU DALAMAN DAN LUARAN<br>"; 
                    } else { $perkara .= "PIHAK BERKEPENTINGAN DALAMAN DAN LUARAN<br>"; }
                    $perkara .= "<small>Keluaran:<b> $dokumen->kod_keluaran</b></small>";
                    $tindakan = "
                    <a href='#' class='btn badge bg-info' style='width:250px'><i class='fas fa-edit'></i> Sahkan</a>
                    <a href='#' class='btn badge bg-danger' style='width:250px'><i class='fas fa-upload'></i> Kembalikan Untuk Semakan Semula</a>
                    ";
                ?>
                <tr>
                    <td class="text-center">{{ ++$no }}</td>
                    <td>{!! $perkara !!}</td>
                    <td class="text-center">{!! $tindakan !!}</td>
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

@section('sidebar_item', 'item-pengesahan-konteks-organisasi') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-pengesahan') <!--- HIGHLIGHT SELECTED TREE --->