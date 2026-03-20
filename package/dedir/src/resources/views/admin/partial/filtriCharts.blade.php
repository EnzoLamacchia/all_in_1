<div class="row mb-2">
    <div class="col-md-12 bg-100 rounded">
        <div class="row mt-4 mb-2">
            <div class="col-md-12 rounded-500 bg-100">
                <form action="/dashboard/determinazioni/charts" method="GET">
                <div class="row">
                    <div class="col-md-12 mt-0 pt-0 pb-2">
                        <h4>Seleziona la competenza e/o l'anno</h4>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="inputCompetenza" class="bmd-label-floating active">Competenza</label>
                            <select class="form-control selectpicker" data-style="btn btn-link" id="inputCompetenza"
                                    name="ddCompetenza" type="text">
                                <option value="">Selezionare la Sezione di competenza</option>
                                @foreach($competenze as $item)
                                    <option value="{{$item['id']}}"
                                    @isset($sezComp)
                                        @if ($item['competenzaComp']==$sezComp)
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
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-just-icon pull-right" title="filtra">
                                <i class="material-icons">filter_alt</i>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
