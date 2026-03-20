@extends('dedir::template.dashboardWJS')

@section('content')
    <div class="row p-2">
        <div class="d-flex col-md-8">
            <div class="d-flex justify-content-center">
                <h4>{{$tit}}</h4>
            </div>
        </div>
        <div class="d-flex col-md-4 align-self-center justify-content-end">
            <a href="{{route('creaCompetenza')}}" title="crea">
                <button class="btn btn-secondary btn-just-icon" title="nuova competenza">
                    <i class="material-icons">library_add</i>
                </button>
            </a>

        </div>
    </div>
    @if(session()->has('messaggio'))
        @component('dedir::admin.partial.notificaFadeOut',['msg' => session()->get('messaggio')])
            <!-- <H4>NOTIFICA</H4> -->  <!-- viene passato nel segnaposto {{--$slot--}} nel componente richiamato-->
        @endcomponent
    @endif
    <div class="row">
        <div class="col-md-12">
            <form action="/detdir/competenze/{{$dd->id}}/update" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">Competenza</h4>
                            <p class="card-category">{{$dd->competenzaComp}}</p>
                        </div>
                        <div class="card-body">
                            <div class="row pb-3 pt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputCompetenza"
                                               class="bmd-label-floating active">Denominazione</label>
                                        <input class="fs-5" type="text" id="inputCompetenza" name="ddCompetenza"
                                               value="{{$dd->competenzaComp}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3 pt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputCompetenza" class="bmd-label-floating active">Denominazione
                                            (abbreviazione)</label>
                                        <input type="text" id="inputCompetenza" name="ddCompetenzaAbbr"
                                               value="{{$dd->competenzaAbbr}}" placeholder="Inserire abbreviazione">
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3 pt-3">
                                <div class="col-md-8">
                                    <div class="form-check" id="id_checkbox">
                                        <input class="form-check-input" type="checkbox" name="ddAttivo"
                                               id="AttivoDisattivo" @if ($dd->attivo==1) value="1" checked @else value="0" @endif>
                                        <label class="form-check-label" for="AttivoDisattivo">@if ($dd->attivo==1)
                                                ATTIVO @else DISATTIVO @endif</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary pull-right">Aggiorna Competenza
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="clearfix"></div>

                    </div>
                </div>


            </form>
        </div>
    </div>
@stop
@section('footer')
    @parent
    <script>
        $(document).ready(function(){
            //$('div.alert').fadeOut(3000); //esegue il fadeOut sul messaggio di alert di modifica di un album
            setTimeout( () => $('div.alert').slideUp(2000), 3000)
        })

        document.addEventListener('DOMContentLoaded', function () {
            var check = document.getElementById('id_checkbox');
            var spunta = document.getElementById('AttivoDisattivo');
            spunta.addEventListener('click', function (ev) {
                var ck = check.childNodes[3];
                var ck2 = check.children[1];
                //console.dir(check)
                //console.dir(ck.innerHTML);
                //console.dir(spunta.attributes['value'].nodeValue)
                //ck.innerHTML = 'DISATTIVO'
                if (ck.innerHTML.indexOf(' ATTIVO ') != -1) {

                    //ck.innerHTML = "<label class=\"form-check-label\" for=\"AttivoDisattivo\"> DISATTIVO </label>";
                    ck.innerHTML = 'DISATTIVO'
                    spunta.attributes['value'].nodeValue = 0;
                    //console.dir('new value:'+spunta.attributes['value'].nodeValue)
                } else {
                    // ck.innerHTML = "<input class=\"form-check-input\" type=\"checkbox\" " +
                    //     "name=\"ddAttivo\" id=\"AttivoDisattivo\" value=\"1\" checked>" +
                    //     "<label class=\"form-check-label\" for=\"AttivoDisattivo\"> ATTIVO </label>";
                    ck.innerHTML = ' ATTIVO ';
                    spunta.attributes['value'].nodeValue = 1;
                    //console.dir('new value:'+spunta.attributes['value'].nodeValue)
                }
            })
        })
    </script>
@endsection
