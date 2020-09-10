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
      <li class="breadcrumb-item">Dokumen Isu</li>
      <li class="breadcrumb-item">{{ $konteks_organisasi->kod_keluaran }}</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
    <!-- CARD -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Isu Dalaman Dan Luaran Pejabat Pendaftar <small> (Keluaran: {{ $konteks_organisasi->kod_keluaran }})</small></h3>
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
            <h5>&nbsp;&nbsp;&nbsp;<u>ISU LUARAN</u></h5>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: yellow;">
                        <th style="width: 50px;">#</th>
                        <th>Perkara</th>
                        <th style="width: 500px;">Isu-Isu Berkaitan</th>
                        <th style="width: 500px;">Kesan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 0;
                    $currentrow = 0;
                    $rowspan = 0; 
                ?>
                @foreach ($isuluaranArray as $isuluaran) 

                    <tr>
                        @if ($currentrow == $rowspan)
                        <?php $currentrow = 0; $rowspan = 0; 
                            $perkara = $isuluaran->perkara;
                            foreach($isuluaranArray as $a) {
                                if(!(strcmp($a->perkara, $perkara))) {
                                    $rowspan++;
                                }
                            } 
                        ?>
                        <td rowspan="{{ $rowspan }}">{{ ++$no }}</td>
                        <td rowspan="{{ $rowspan }}">{{ $isuluaran->perkara }}</td>
                        @endif
                        <?php $currentrow++; ?>
                        <td>{{ $isuluaran->isu }}</td>
                        <td>{{ $isuluaran->kesan }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-------- ISU DALAMAN ----------->
        <div class="row">
            <h5>&nbsp;&nbsp;&nbsp;<u>ISU DALAMAN</u></h5>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: yellow;">
                        <th style="width: 50px;">#</th>
                        <th>Perkara</th>
                        <th style="width: 500px;">Isu-Isu Berkaitan</th>
                        <th style="width: 500px;">Kesan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 0;
                    $currentrow = 0;
                    $rowspan = 0; 
                ?>
                @foreach ($isudalamanArray as $isudalaman) 

                    <tr>
                        @if ($currentrow == $rowspan)
                        <?php $currentrow = 0; $rowspan = 0; 
                            $perkara = $isudalaman->perkara;
                            foreach($isudalamanArray as $a) {
                                if(!(strcmp($a->perkara, $perkara))) {
                                    $rowspan++;
                                }
                            } 
                        ?>
                        <td rowspan="{{ $rowspan }}">{{ ++$no }}</td>
                        <td rowspan="{{ $rowspan }}">{{ $isudalaman->perkara }}</td>
                        @endif
                        <?php $currentrow++; ?>
                        <td>{{ $isudalaman->isu }}</td>
                        <td>{{ $isudalaman->kesan }}</td>
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