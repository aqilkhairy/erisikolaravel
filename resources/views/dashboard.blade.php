@extends('user')

@section('content')
<div class="row mb-2">
  <div class="col-sm-7">
    <h1>Dashboard</h1>
  </div>
  <div class="col-sm-5">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">#</li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </div>
</div>
<!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-sm-5">
    <!-- Profile  -->
    <div class="card card-primary card-outline card-widget widget-user-2" style="height: 285px;">
      <div class="widget-user-header text-white" style="background: url('{{asset('canseleri_441x110.jpg')}}'); background-size: cover;">
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="{{Auth::user()->avatar}}" alt="User Avatar">
        </div>
        <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
        <h5 class="widget-user-desc">{{Auth::user()->user_type}}</h5>
      </div>
      
      <div class="card-footer">
        <ul class="nav flex-column">
          <li class="nav-item pt-2" style="display: table-cell;vertical-align: middle;">
            <p style="text-align:center;">PAPAR NAMA JAWATAN DISINI</p>
          </li>
          <li class="nav-item pt-3" style="display: table-cell;vertical-align: middle;">
            <p style="text-align:center;">BAHAGIAN GOVERNAN DAN SEKRETARIAT UNIVERSITI</p>
          </li>
        </ul>
      </div>
    </div>
    </div>
    <div class="col-sm-7">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="card-title">Maklumat Dokumen Terkini</div>
            </div>
            <div class="card-body">
                <div class="text-muted"><?php setlocale(LC_TIME, "ms-MY"); ?>
                    <b><u>Dokumen Isu </u></b><br>
                    <p>Keluaran: {{ $isu->kod_keluaran }} ({{ date("d F Y", strtotime($isu->tarikh_disahkan)) }})</p>
                    <b><u>Dokumen Pihak Berkepentingan </u></b><br>
                    <p>Keluaran: {{ $pihak->kod_keluaran }} ({{ date("d F Y", strtotime($pihak->tarikh_disahkan)) }})</p>
                    <b><u>Borang Daftar Risiko Jabatan</u></b><br>
                    <p>Keluaran: {{ $daftarRisikoTerkini->kod_keluaran }} ({{ date("d F Y", strtotime($daftarRisikoTerkini->tarikh_dikemaskini)) }}) </p>
                </div>
            </div>
        </div>
    </div>
</div>
@can('isPengguna')
<div class="row">
    <div class="col">
    <!-- Info Box -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Senarai Dokumen Untuk Disemak</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-5 col-sm-3">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link " data-toggle="pill" href="#vert-tabs-keberkesanan-tindakan" aria-selected="true">Keberkesanan Tindakan</a>
              <a class="nav-link active" data-toggle="pill" href="#vert-tabs-konteks-organisasi" aria-selected="false">Konteks Organisai
                @if($countSemak > 0)
                  <span class="badge badge-warning right">{{ $countSemak }}</span>
                @endif
                </a>
              <a class="nav-link" data-toggle="pill" href="#vert-tabs-daftar-risiko" aria-selected="false">Daftar Risiko</a>
            </div>
          </div>
          <div class="col-7 col-sm-9">
            <div class="tab-content" id="vert-tabs-tabContent">
              <div class="tab-pane fade" id="vert-tabs-keberkesanan-tindakan">
                  
              </div>
              <div class="tab-pane fade  active show" id="vert-tabs-konteks-organisasi">
                  <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px; text-align: center;">#</th>
                      <th style="text-align: center;">Dokumen</th>
                      <th style="width: 200px; text-align: center;">Keluaran</th>
                      <th style="width: 200px; text-align: center;">Tarikh Berakhir Semakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0;$dokumen = "";?>
                    @foreach($dokumenSemakArray as $dokumenSemak)
                        @if($dokumenSemak->dokumen == "isu")
                            <?php $dokumen = "Isu "; ?>
                        @else
                            <?php $dokumen = "Pihak Berkepentingan "; ?>
                        @endif
                        <tr>
                            <td style="text-align: center;"><b>{{ ++$no }}</b></td>
                            <td>{{ $dokumen }}</td>
                            <td style="text-align: center;" >{{ $dokumenSemak->kod_keluaran }}</td>
                            <td style="text-align: center;">{{ $dokumenSemak->tarikh_disemak_berakhir }} (<span class="badge bg-warning">{{ $dokumenSemak->countDay }} HARI LAGI</span>) </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="vert-tabs-daftar-risiko">
                  
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Senarai Tahap Risiko (Keluaran {{ $daftarRisikoTerkini->kod_keluaran }})</h3>
          </div>
          <div class="card-body">
              <canvas id="grafTahapRisiko" style="width: 300px; height: 300px;"></canvas>
          </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Peratus Tindakan Terhadap Risiko (Keluaran {{ $daftarRisikoTerkini->kod_keluaran }})</h3>
          </div>
          <div class="card-body">
              <canvas id="" style="width: 300px; height: 300px;"></canvas>
          </div>
        </div>
    </div>
</div>
@endcan
</section>
@stop

@section('script')
<script>
$(document).ready(function() { 
    var rendah = 0, sederhana = 0, tinggi = 0, sangattinggi = 0;
    @foreach($tahapArray as $tahap)
        @if($tahap->tahap <= 4)
            rendah++;
        @elseif($tahap->tahap <= 9)
            sederhana++;
        @elseif($tahap->tahap <= 14)
            tinggi++;
        @else
            sangattinggi++;
        @endif
    @endforeach
    
    var ctx = document.getElementById('grafTahapRisiko');
    var donutData        = {
      labels: [
          'Rendah (1-4)', 
          'Sederhana (5-9)',
          'Tinggi (10-14)', 
          'Sangat Tinggi (15-25)', 
      ],
      datasets: [
        {
          data: [rendah,sederhana,tinggi,sangattinggi],
          backgroundColor : ['#28a745', '#ffc107', '#ff851b', '#dc3545'],
        }
      ]
    }
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    var pieChart = new Chart(ctx, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
});
</script>
@stop

@section('sidebar_item', 'item-dashboard') <!--- HIGHLIGHT SELECTED SIDEBAR --->