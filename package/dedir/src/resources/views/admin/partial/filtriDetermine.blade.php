<div class="row mb-2">
    <div class="col-md-12 bg-100 rounded">
        <div class="row mt-4 mb-2">
            <div class="col-md-12 rounded-500 bg-100">
                <form action=
                      @if($tipoVista == 'card') "/detdir/determinazioni/filtered/card"
                @else "/detdir/determinazioni/filtered/elenco"
                @endif
                method="GET">
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
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">Filtra</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
