@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Semakan Daftar Risiko Jabatan</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">#</li>
        <li class="breadcrumb-item">Semakan</li>
        <li class="breadcrumb-item">Daftar Risiko</li>
        <li class="breadcrumb-item">{{ $bdrjArray->kod_keluaran }}</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-warning card-outline ">
        <div class="card-header">
            <div class="card-title">Senarai Semakan Daftar Risiko (Keluaran {{ $bdrjArray->kod_keluaran }})</div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-2">
                            Bahagian <span class="float-right">:</span>
                        </div>
                        <div class="col-12 col-sm-10">
                             <span class="text-muted"><b>{{ $daftarRisikoTerkini->bahagian }}</b></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-2">
                            Proses <span class="float-right">:</span>
                        </div>
                        <div class="col-12 col-sm-10">
                             <span class="text-muted">{{ $daftarRisikoTerkini->proses }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-2">
                            Disediakan Oleh <span class="float-right">:</span>
                        </div>
                        <div class="col-12 col-sm-10">
                             <span class="text-muted">{{ $daftarRisikoTerkini->disediakan_oleh }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-2">
                            Disahkan Oleh <span class="float-right">:</span>
                        </div>
                        <div class="col-12 col-sm-10">
                             <span class="text-muted">{{ $daftarRisikoTerkini->disahkan_oleh }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                         <div class="col">
                            <table id="example1" class="table dataTable dtr-inline">
                               <thead>
                                  <tr>
                                       <th aria-controls="example1" style='width:20px;'>#</th>
                                       <th aria-controls="example1" style='width:100px;'>No. Rujukan</th>
                                       <th aria-controls="example1" >Risiko</th>
                                       <th aria-controls="example1" style='width:60px;'>Jenis</th>
                                       <th aria-controls="example1" style='width:40px;'>Tahap</th>
                                       <th aria-controls="example1" style='width:50px;'>Tindakan</th>
                                  </tr>
                               </thead>
                               <tbody id="tableArea">
                                  <?php $no = 0; ?>
                                    @foreach($senaraiRisikoArray as $senaraiRisiko)
                                        <?php
                                            $textIsu = ($senaraiRisiko->jenis == 1) ? "Luaran" : "Dalaman";
                                            $tahap = ($senaraiRisiko->kebarangkalian)*($senaraiRisiko->impak);
                                            $bg = "";
                                            if($tahap <= 4) $bg = "#28a745";
                                            else if($tahap <= 9) $bg = "#ffc107";
                                            else if($tahap <= 14) $bg = "#ff851b";
                                            else if($tahap <= 25) $bg = "#dc3545";
                                        ?>
                                        <tr>
                                           <td>{{ ++$no }}</td>
                                           <td style='text-align: center; '> <b>{{ $senaraiRisiko->no_rujukan }}</b> </td>
                                           <td> {{ $senaraiRisiko->keterangan }} </td>
                                           <td style='text-align: center;'> {{ $textIsu }} </td>
                                           <td style='text-align: center; vertical-align:middle; background-color: {{ $bg }}; color: #FFFFFF;'> {{ $tahap }} </td>
                                           <td style='text-align: center;'><a href='{{ $bdrjArray->id }}/{{ $senaraiRisiko->id }}' class='badge bg-warning' ><i class='fas fa-edit'></i> Semak</a></td>
                                        </tr>
                                    @endforeach
                               </tbody>
                            </table>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@stop

@section('script')
<script>
</script>
@stop

@section('sidebar_item', 'item-semakan-daftar-risiko') <!--- HIGHLIGHT SELECTED SIDEBAR --->
@section('sidebar_tree_item', 'tree-semakan') <!--- HIGHLIGHT SELECTED TREE --->
