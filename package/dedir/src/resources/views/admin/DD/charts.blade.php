@extends('template.dashboard')
@section('content')
    @isset($selCompetenza)
        <!--<H2>{{$selCompetenza}}</H2>
        <H6>{{$competenze}}</H6> -->
    @endisset
    @include('admin.partial.filtriCharts')
    <div class="row">
         <div class="col-md-12">
            <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    @if ($sez)
        <div class="col-md-12">
            <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                <canvas id="highChart"></canvas>
            </div>
        </div>
    </div>
    @endif

@stop
@section('footer')
    @parent
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    --><script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script>
        $(function(){
            var datas = <?php echo json_encode($datas); ?>;
            var etichette = <?php echo json_encode($sections); ?>;
            var barColors = <?php echo json_encode($colori); ?>;
            var barCanvas = $("#barChart");
            var highCanvas= $("#highChart");
            var sezComp = <?php echo json_encode($sezComp); ?>;
            var mesi = <?php echo json_encode($months); ?>;
            var detemineSezione = <?php echo json_encode($determineSezione); ?>;
            var titoloBarChart = "Determine anno: "+ <?php echo $annoReq ? $annoReq : 2021 ?>;
            var titoloLineChart = "Determinazioni {{$sezComp}}  (anno: {{$annoReq}})";
            var barChart = new Chart(barCanvas,{
                type:'bar',
                data:{
                    labels:etichette,
                    datasets:[
                        {
                            label:'Nr. Determinazioni',
                            data:datas,
                            backgroundColor:barColors,
                        }
                    ]
                },
                options:{
                    layout: {
                        padding: 50
                    },
                    scales:{
                        yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                        }]
                    },
                    plugins: {
                        legend: {
                            display: false,
                            labels: {
                                // This more specific font property overrides the global property
                                font: {
                                    size: 12
                                }
                            }
                        },
                        title: {
                            font: {
                                size: 20
                            },
                            display: true,
                            text: titoloBarChart,
                            padding: {
                                top: 10,
                                bottom: 30,
                                left: 50,
                                right: 50
                            }
                        }
                    }
                }
                }
            )
            var highChart = new Chart(highCanvas,{
                    type:'line',
                    data:{
                        labels:mesi,
                        datasets:[
                            {
                                label:false,
                                data:detemineSezione,
                                backgroundColor:'green',
                                fill: false,
                                <!-- borderWidth: 5, -->
                            }
                        ]
                    },
                    options:{
                        elements:{
                            line: {
                                borderWidth: 3,
                                borderColor: 'rgb(0,255,0)',
                            },
                            point: {
                                radius : 7,
                                borderWidth: 2,
                                pointStyle: 'crossRot',
                                borderColor : 'rgb(0,128,0)',
                                backgroundColor: 'rgb(0,128,0)',
                                hoverRadius: 3,
                            }
                        },
                        layout: {
                            padding: {
                                top: 350,
                                bottom: 10,
                                left: 50,
                                right: 50
                            }
                        },
                        scales:{
                            yAxes:[{
                                ticks:{
                                    beginAtZero:true
                                }
                            }]
                        },
                        plugins: {
                            legend: {
                                display: false,
                                labels: {
                                    // This more specific font property overrides the global property
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            title: {
                                font: {
                                    size: 20
                                },
                                display: true,
                                text: titoloLineChart,
                                padding: {
                                    top: 10,
                                    bottom: 30
                                }
                            }
                        }
                    }
                }
            )
        });
    </script>
@endsection
