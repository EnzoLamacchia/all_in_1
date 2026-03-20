@extends('dedir::template.dashboardWJS')
@section('content')
    <div class="row p-2">
        <div class="d-flex col-md-8">
            <div class="d-flex justify-content-center">
                <h4>{{$tit}}</h4>
            </div>
        </div>
        <div class="d-flex col-md-4 align-self-center justify-content-end">
            <a href="{{route('creaDetermina')}}" title="crea">
                <button class="btn btn-secondary btn-just-icon" title="nuova determinazione">
                    <i class="material-icons">library_add</i>
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('dedir::admin.partial.notificaErrors')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{route('saveDetermina')}}" method="POST" enctype="multipart/form-data">
                @csrf

    <div class="row">
        <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Nuova determinazione</h4>
                <p class="card-category">Compilare i campi del form e uploadare il testo</p>
            </div>
            <div class="card-body">
                    <!--<input type="hidden" name="_method" value="PATCH">-->
                    <div class="row pb-3 pt-3">

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="inputCompetenza" class="bmd-label-floating active">Competenza</label>
                                <select class="form-control selectpicker" data-style="btn btn-link" id="inputCompetenza" name="ddCompetenza"  type="text">
                                    <option  value="">Selezionare la Sezione di competenza</option>
                                    @foreach($competenze as $item)
                                        <option  value="{{$item['id']}}" {{$item['competenzaComp']==$dd->Competenza ? 'selected' : ''}}>{{$item['competenzaComp']}}</option>
                                    @endforeach
                                </select>
                                <style>
                                    option:checked { font-weight: bold }
                                </style>

                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nr. Progressivo</label>
                                    <input type="text" name="ddNrProgr" class="form-control"
                                           value="{{$newProgressivo ? $newProgressivo : old('ddNrProgr')}}">
                                </div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Numero</label>
                                <input type="text" name="ddNrDet" class="form-control" value="{{old('ddNrDet')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating active">Data Determinazione</label>
                                <input type="date" name="ddDataDet" class="form-control" value="{{old('ddDataDet')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Oggetto</label>
                                    <textarea name="ddOggetto" class="form-control" rows="5">{{old('ddOggetto')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-md-12">
                            <div class="callout p-3" style="max-width:100ch;">
                                <div class="callout-title">Impegno di spesa</div>
                                <div class="row pt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nr. Impegno</label>
                                            <input type="text" name="ddImpegno" class="form-control" value="{{old('ddImpegno')}}" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating active">Data Impegno</label>
                                            <input type="date" name="ddDataImpegno" class="form-control" value="{{old('ddDataImpegno')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-md-12">
                            <div class="callout p-3" style="max-width:100ch;">
                                <div class="callout-title">Pubblicazione</div>
                                <div class="row pt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating active">Pubblicato dal</label>
                                            <input type="date" id="ddPubbDA" name="ddPubbDA" class="form-control" value="{{old('ddPubbDA')}}"
                                                   onfocusout="setDataA()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating active">Pubblicato al</label>
                                            <input type="date" id="ddPubbA" name="ddPubbA" class="form-control" value="{{old('ddPubbA')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Note</label>
                                    <textarea name="ddNote" class="form-control" rows="5">{{old('ddNote')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <button type="submit" class="btn btn-primary pull-right">Salva determinazione</button>--}}
{{--                    <div class="clearfix"></div>--}}
                <!-- </form> -->
            </div>
        </div>
    </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    @if (!$dd->NomeFileT_1)
                        <a href="#">
                            <img class="img" src="/vendor/dedir/assets/img/empty-null.png" />
                        </a>
                    @else
                        <a href="{{$dd->storage}}" target="_blank">
                            <img class="img" src="/vendor/dedir/assets/img/documentOrange500.png" />
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="card-title">Testo determina non presente</h4>
                    <h6 class="card-category text-gray">Upload testo determina</h6>

                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="file" name="ddAllegato" class="form-control-file"
                                       id="ddAllegato" placeholder="" value="{{$dd->NomeFIlePDF_1}}">
                                <br>
                            </div>

                        <!--
                            <div class="col-md-12 d-flex align-content-center">
                                <button type="submit" class="btn btn-primary" formaction="/admin/avatar/{{$dd->ID}}">Carica Allegato</button>
                            </div>
                            -->
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Salva determinazione</button>
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
            //$('div.alert').fadeOut(8000) //esegue il fadeOut sul messaggio di alert di creazione di un album
            setTimeout( () => $('div.alert').slideUp(2000), 3000)
        })
    </script>
    <script>
        function setDataA() {
            var xA = document.getElementById("ddPubbA");
            var xDA = document.getElementById("ddPubbDA");
            var dataA = new Date(xDA.value);
            dataA.setDate(dataA.getDate() + 15);
            xA.value = dataA.toISOString().substring(0,10);
        }
    </script>
@endsection
