@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Daftar Risiko Jabatan</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item">Daftar Risiko</li>
      <li class="breadcrumb-item">{{ $data->no_rujukan }}</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <p class="card-title">Maklumat Risiko</p>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-2">
                    No. Rujukan <span class="float-right">:</span>
                </div>
                <div class="col-12 col-sm-10">
                     <span class="text-muted"><b>{{ $data->no_rujukan }}</b></span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-2">
                    Kategori Risiko <span class="float-right">:</span>
                </div>
                <div class="col-12 col-sm-10">
                     <span class="text-muted">Risiko {{ $data->perkara }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-2">
                    Bahagian Isu <span class="float-right">:</span>
                </div>
                <div class="col-12 col-sm-10">
                    <?php $textIsu = ($data->jenis == 1) ? "Luaran" : "Dalaman"; ?>
                     <span class="text-muted">{{ $textIsu }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-2">
                    Risiko <span class="float-right">:</span>
                </div>
                <div class="col-12 col-sm-10">
                     <b><span class="text-muted">{!! $data->keterangan !!}</span></b>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <p class="card-title">Kenalpasti Risiko</p>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <strong><u>Punca Risiko</u></strong>
                    <p class="text-muted">{!! $data->punca !!}</p>
                </div>
                <div class="col-12 col-sm-6">
                    <strong><u>Impak/Kesan Risiko</u></strong>
                    <p class="text-muted">{!! $data->impak_kesan !!}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <p class="card-title">Analisa dan Penilaian Risiko</p>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-default">
                    <div class="info-box-content">
                      <span class="info-box-text text-center ">Kebarangkalian</span>
                      <span class="info-box-number text-center mb-0">{{ $data->kebarangkalian }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-default">
                    <div class="info-box-content">
                      <span class="info-box-text text-center ">Impak</span>
                      <span class="info-box-number text-center mb-0">{{ $data->impak }}</span>
                    </div>
                  </div>
                </div>
                <?php
                    $tahap = ($data->kebarangkalian)*($data->impak);
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
            <div class="row">
                <div class="col">
                    <strong><u>Kawalan Sedia Ada</u></strong>
                    <p class="text-muted">{!! $data->kawalan !!}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <p class="card-title">Kawalan Risiko</p>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <strong><u>Tindakan Yang Dicadangkan</u></strong>
                </div>
            </div>
            <?php $no = 0; ?>
            @foreach($tindakanArray as $tindakan)
            <div class="row">
                <div class="col">
                    <span class="text-muted">{!! $tindakan->tindakan !!}
                    @if(isset($tindakan->pelan))
                        <br>
                    {!! $tindakan->pelan !!}
                    @endif
                    </span>
                </div>
            </div>    
            <div class="row">
                <div class="col-12 col-sm-2">
                    <strong>Tarikh Siap </strong> <span class="float-right">:</span>
                </div>
                <div class="col-12 col-sm-10">
                    <span class="text-muted"> {!! $tindakan->tarikh_siap !!}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-2">
                    <strong>Tanggungjawab </strong> <span class="float-right">:</span>
                </div>
                <div class="col-12 col-sm-10">
                    <span class="text-muted"> {!! $tindakan->pyb !!}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-2">
                    <strong>Peratus Siap </strong> <span class="float-right">:</span>
                </div>
                <div class="col-12 col-sm-10">
                    <span class="text-muted"> {!! $tindakan->peratus_siap !!}%</span>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="{{$tindakan->peratus_siap}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tindakan->peratus_siap}}%">
                      </div>
                    </div>
                </div>
            </div>
            <br>
            @endforeach
        </div>
    </div>
</section>
<!-- /.content -->
@stop

@section('script')
<script>
</script>
@stop

@section('sidebar_item', 'item-dokumen-daftar-risiko') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', '') <!--- HIGHLIGHT SELECTED TREE --->