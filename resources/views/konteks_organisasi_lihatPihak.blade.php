@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Konteks Organisasi</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Konteks Organisasi</li>
      <li class="breadcrumb-item">Dokumen Pihak Berkepentingan</li>
      <li class="breadcrumb-item">{{ $konteks_organisasi->kod_keluaran }}</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
    <!-- CARD -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Pihak Berkepentingan Dalaman Dan Luaran Pejabat Pendaftar <small> (Keluaran: {{ $konteks_organisasi->kod_keluaran }})</small></h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          <button type="button" class="btn btn-tool" style="width: 50px" data-card-widget="maximize"></button>
          <div class="ribbon-wrapper ribbon">
            <div class="ribbon bg-primary">
              <small>{{$konteks_organisasi->tarikh_disahkan}}</small>
            </div>
          </div>
      </div>
    </div>
    <div class="card-body">
        <!-------- ISU LUARAN ----------->
        <div class="row">
            <h5>&nbsp;&nbsp;&nbsp;<u>PIHAK BERKEPENTINGAN LUARAN</u></h5>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: yellow;">
                        <th style="width: 50px;">#</th>
                        <th>Pihak</th>
                        <th style="width: 500px;">Peranan</th>
                        <th style="width: 500px;">Jangkaan/Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 0;
                    $currentrow = 0;
                    $rowspan = 0; 
                ?>
                @foreach ($pihakberkepentinganluaranArray as $pihakluaran) 

                    <tr>
                        @if ($currentrow == $rowspan)
                        <?php $currentrow = 0; $rowspan = 0; 
                            $pihak = $pihakluaran->pihak_berkepentingan;
                            foreach($pihakberkepentinganluaranArray as $a) {
                                if(!(strcmp($a->pihak_berkepentingan, $pihak))) {
                                    $rowspan++;
                                }
                            } 
                        ?>
                        <td rowspan="{{ $rowspan }}">{{ ++$no }}</td>
                        <td rowspan="{{ $rowspan }}">{{ $pihakluaran->pihak_berkepentingan }}</td>
                        @endif
                        <?php $currentrow++; ?>
                        <td>{{ $pihakluaran->peranan }}</td>
                        <td>{{ $pihakluaran->keperluan }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-------- ISU DALAMAN ----------->
        <div class="row">
            <h5>&nbsp;&nbsp;&nbsp;<u>PIHAK BERKEPENTINGAN DALAMAN</u></h5>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: yellow;">
                        <th style="width: 50px;">#</th>
                        <th>Pihak</th>
                        <th style="width: 500px;">Peranan</th>
                        <th style="width: 500px;">Jangkaan/Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 0;
                    $currentrow = 0;
                    $rowspan = 0; 
                ?>
                @foreach ($pihakberkepentingandalamanArray as $pihakdalaman) 

                    <tr>
                        @if ($currentrow == $rowspan)
                        <?php $currentrow = 0; $rowspan = 0; 
                            $pihak = $pihakdalaman->pihak_berkepentingan;
                            foreach($pihakberkepentingandalamanArray as $a) {
                                if(!(strcmp($a->pihak_berkepentingan, $pihak))) {
                                    $rowspan++;
                                }
                            } 
                        ?>
                        <td rowspan="{{ $rowspan }}">{{ ++$no }}</td>
                        <td rowspan="{{ $rowspan }}">{{ $pihakdalaman->pihak_berkepentingan }}</td>
                        @endif
                        <?php $currentrow++; ?>
                        <td>{{ $pihakdalaman->peranan }}</td>
                        <td>{{ $pihakdalaman->keperluan }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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

@section('sidebar_item', '{{ $sidebar_item }}') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', '{{ $sidebar_tree }}') <!--- HIGHLIGHT SELECTED TREE --->