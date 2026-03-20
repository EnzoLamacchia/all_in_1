@extends('template.dashboard')
@section('content')
{{--    @if(session()->has('messaggio'))--}}
{{--        @component('admin.partial.notificaFadeOut',['msg' => session()->get('messaggio')])--}}
{{--            <H4>NOTIFICA</H4> <!-- viene passato nel segnaposto $slot nel componente richiamato--}}
{{--        @endcomponent--}}
{{--    @endif--}}
    @include('admin.partial.filtriChartsMulti')
{{--    <p><?php echo json_encode($determineSezione); ?></p>--}}
{{--    <p>{{$sez}}</p>--}}
    <div class="row">
        @if ($sez)
            <div class="col-md-12">
                <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                    <canvas id="highChart"></canvas>
                </div>
            </div>
        @endif
    </div>

@stop
@section('footer')
    @parent
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(function(){
             // **************** lineChart
            var highCanvas= $("#highChart");
            {{--var sezComp = <?php echo json_encode($sezComp); ?>;--}}
            var mesi = <?php echo json_encode($months); ?>;
            var detSezione = <?php echo json_encode($determineSezione); ?>;
            var nrsezioni = <?php echo json_encode($nrSez); ?>;
            var titoloLineChart = ""
            if (nrsezioni>1) {
                titoloLineChart = "Determinazioni anno: " + <?php echo json_encode($annoReq); ?>;
            }else{
                titoloLineChart = "Determinazioni "+ <?php echo $sezComp ?>;
            }
            var highChart = new Chart(highCanvas,{
                data: {
                    datasets: detSezione,
                    labels: mesi,
                },
                options:{
                    layout: {
                                        padding: {
                                            top: 50,
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
                        title: {
                                        font: {
                                            size: 20
                                        },
                                        display: true,
                                        text: titoloLineChart,
                                        padding: {
                                            top: 5,
                                            bottom: 20
                                        }
                                    }
                                }
                }
            });
        });
    </script>
    <script src="/js/sweet-alert.js"></script>
    <link rel="stylesheet" href="/css/sweet-alert.css">
    <script src="/js/verifySelection.js"></script>
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $('div.alert').fadeOut(5000); //esegue il fadeOut sul messaggio di alert di modifica di un album--}}
{{--        })--}}
{{--    </script>--}}
@endsection
