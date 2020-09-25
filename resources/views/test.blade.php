@extends('user')

@section('content')

<?php
$bulan = [];
for($i = 0; $i <= 12; $i++) {
    
}
?>

<div id="container" style="width: 75%;">
    <div class="row">
        <label for="kesSelector">Graf Bar Kes: </label>
        <select id="kesSelector" onchange="updateCanvas()">
            @foreach($kes as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kes }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <canvas id="canvas"></canvas>
    </div>
</div>

@endsection

@section('script')
<script>
    var ctx = document.getElementById('canvas');
    var options = {
                  scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero: true
                              }
                          }]
                      },
                  legend: {
                      display: false
                  }
              };
    function updateCanvas() {
        var selectedKes = document.getElementById("kesSelector").value;
        @foreach($kes as $k)
        if("{{$k->id}}" == selectedKes) {
              
              var data = {
                labels: [
                    @foreach($k->getStatistik() as $s)
                      'Bulan {{ $s["bulan"] }}',
                    @endforeach
                ],
                datasets: [{

                    label: 'Kes',
                    data: [
                      @foreach($k->getStatistik() as $s)
                        '{{ $s["bilangan"] }}',
                      @endforeach
                    ],
                    backgroundColor: [
                          'rgba(255, 99, 132)',
                          'rgba(54, 162, 235)',
                          'rgba(255, 206, 86)',
                          'rgba(75, 192, 192)',
                          'rgba(153, 102, 255)',
                          'rgba(255, 159, 64)',
                          'rgba(200, 99, 132)',
                          'rgba(50, 162, 235)',
                          'rgba(200, 206, 86)',
                          'rgba(70, 192, 192)',
                          'rgba(100, 102, 255)',
                          'rgba(20, 159, 64)'
                      ],
                  }
                ]
              }
              var chart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
             });
            chart.update();
          }
        @endforeach 
    }
    
</script>
@endsection

@section('sidebar_item', 'item-dashboard') <!--- HIGHLIGHT SELECTED SIDEBAR --->