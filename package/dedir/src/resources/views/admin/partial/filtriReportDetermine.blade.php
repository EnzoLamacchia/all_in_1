<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="row">
                    <div class="d-flex flex-column col-md-10 justify-content-start">
                        <div><h4 class="card-title ">{{$tit}} @isset($selCompetenza)
                                    {{$selCompetenza}}
                                @endisset
                                @if(Request::get('ddAnno'))
                                    - anno: {{Request::get('ddAnno')}}
                                @endif</h4></div>
                        <div><p class="card-category">Compilare i campi e generare il report nel formato desiderato</p></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="/detdir/determinazioni/report/export2excel" method="GET">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="bmd-label-floating active">Chiave</label>
                                <input type="text" name="ddOggetto" class="form-control">{{old('ddOggetto')}}</input>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating active">Nr. Det.</label>
                            <input type="text" name="ddNrDet" class="form-control" value="{{old('ddNrDet')}}">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="inputCompetenza" class="bmd-label-floating active">Competenza</label>
                            <select class="form-control selectpicker" data-style="btn btn-link" id="inputCompetenza"
                                    name="ddCompetenza" type="text">
                                <option value="">Selezionare la Sezione di competenza</option>
                                @foreach($competenze as $item)
                                    <option value="{{$item['id']}}"
                                    @isset($selCompetenza)
                                        @if ($item['competenzaComp']==$selCompetenza)
                                            selected
                                        @endif
                                    @endisset
                                    >{{$item['competenzaComp']}}</option>
                                @endforeach
                            </select>
                            <style>
                                option:checked {
                                    font-weight: bold;
                                }
                            </style>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating active">Anno</label>
                            <!--<input type="text" name="ddAnno" class="form-control" value="{{old('ddAnno')}}"> -->
                                <select class="form-control selectpicker" data-style="btn btn-link" id="inputAnno"
                                        name="ddAnno" type="text">
                                    <option value="">(aaaa)</option>
                                    @foreach($anniRicerca as $annoRicerca)
                                        <option value="{{$annoRicerca}}"
                                        @if ($annoRicerca==Request::get('ddAnno'))
                                            selected
                                        @endif
                                        >{{$annoRicerca}}</option>
                                    @endforeach
                                </select>
                                <style>
                                    option:checked {
                                        font-weight: bold;
                                    }
                                </style>
                        </div>
                    </div>
                    <div class="d-flex col-md-12 align-self-center justify-content-end">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">Genera Excel</button>
                            <button type="submit" class="btn btn-primary" formaction="/detdir/determinazioni/report/export2pdf">Genera PDF</button>
                            <button type="submit" class="btn btn-primary" formaction="/detdir/determinazioni/report/export2csv">Genera CSV</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
