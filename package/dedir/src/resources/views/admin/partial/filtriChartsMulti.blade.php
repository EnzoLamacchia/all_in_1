<div class="row mb-2">
    <div class="col-md-12 bg-100 rounded">
        <div class="row mt-4 mb-2">
            <div class="col-md-12 rounded-500 bg-100">
                <form action="/dashboard/determinazioni/chartsMulti" method="GET" id="filtri">
                <div class="row">
                    <div class="col-md-8 mt-0 pt-0 pb-0">
                        <h4>Seleziona le competenze d'interesse:</h4>
                    </div>
                    <div class="col-md-4 pr-3 mt-0 pt-0 pb-0 ">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-just-icon pull-right" title="filtra" id="attivaFiltro">
                                <i class="material-icons">filter_alt</i>
                            </button>
                        </div>
                    </div>
                    <div class="row pl-5">
                        @foreach($competenze as $item)
                            <div class="col-3 pl-10">
                                <div class="form-check">
                                    <label class="form-check-label text-dark" >
                                        <input class="form-check-input" id="compId.{{$item['id']}}"
                                               type="checkbox" value="{{$item['id']}}" name="ddCompetenza[]"
                                                @if ($sez) @if (in_array ($item['id'], $sez)) checked @endif @endif>
                                        {{$item['competenzaAbbr']}}
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-12 mt-0 pt-3 pb-2">
                        <h4>Seleziona gli anni d'interesse:</h4>
                    </div>
                    <div class="row pl-5">
                        @foreach($anniRicerca as $annoRicerca)
                            <div class="col-2 pl-10">
                                <div class="form-check">
                                    <label class="form-check-label text-dark" >
                                        <input class="form-check-input" id="anno.{{$annoRicerca}}"
                                               type="checkbox" value="{{$annoRicerca}}"
                                               name="ddAnno[]" @if ($sez) @if (in_array ($annoRicerca, $annoReq)) checked @endif @endif>
                                        {{$annoRicerca}}
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
                </form>
            </div>
        </div>
    </div>
</div>
