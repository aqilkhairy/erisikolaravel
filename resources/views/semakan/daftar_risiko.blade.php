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
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-warning card-outline ">
        <div class="card-header">
            <div class="card-title">Senarai Semakan Daftar Risiko</div>
        </div>
        <div class="card-body">
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
                    @foreach ($dataArray as $data)
                    <?php
                    $mula = date("$data->tarikh_disemak_bermula");
                    $akhir = date("$data->tarikh_disemak_berakhir");
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
                            <button disabled class='btn  bg-secondary' style='width:120px'><i class='fas fa-edit'></i>Semak</button>
                        ";
                    } else if(date("Y-m-d") > $akhir) { //telah tamat, disabled btn semak
                        $statusSemakan = "<p class='badge badge bg-success'>TEMPOH SEMAKAN TELAH SELESAI</p>";
                        $tindakanSemakan = "
                            <button disabled class='btn  bg-secondary' style='width:120px'><i class='fas fa-edit'></i>Semak</button>
                        ";
                    } else { //sedang
                        $statusSemakan = "<p class='badge bg-warning'>UNTUK DISEMAK OLEH PENGGUNA</p>";
                        $tindakanSemakan = "
                            <a href='semakan/$data->id' class='btn  bg-warning' style='width:120px'><i class='fas fa-edit'></i>Semak</a>
                        ";
                    }
                    ?>
                    <tr>
                        <td class='text-center'>{{ ++$no }}</td>
                        <td class='text-center'><strong>{{ $data->kod_keluaran }}</strong></td>
                        <td>{!! $tarikhSemakan !!}</td>
                        <td class='text-center'>{!! $statusSemakan !!}</td>
                        <td class='text-center'>{!! $tindakanSemakan !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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