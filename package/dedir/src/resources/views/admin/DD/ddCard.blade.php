@extends('dedir::template.dashboardWJS')
@section('content')
    <!-- <H2>{{--$tit--}}</H2> -->
    @include('dedir::admin.partial.filtriDetermine')
    <div class="row p-2">
        <div class="d-flex col-md-10">
            <div class="d-flex justify-content-center">
            <h4>{{$tit}}
                @isset($selCompetenza)
                    {{$selCompetenza}}
                @endisset
                @if(Request::get('ddAnno'))
                    - anno: {{Request::get('ddAnno')}}
                @endif
            </h4>
            </div>
        </div>
        <div class="d-flex col-md-2 align-self-center justify-content-end">
            <a href="/detdir/determinazioni" title="view">
                <button class="btn btn-secondary btn-just-icon" title="vista formato elenco">
                    <i class="material-icons">table_view</i>
                </button>
            </a>
            <a href="{{route('creaDetermina')}}" title="crea">
                <button class="btn btn-secondary btn-just-icon" title="nuova determinazione">
                    <i class="material-icons">library_add</i>
                </button>
            </a>

        </div>
    </div>

    <div class="row">
        @foreach($dds as $dd)
            <div class="col-12 col-lg-4">
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-warning">
                     <h4 class="m-0"> Det. {{$dd->NrDet}} del {{\Carbon\Carbon::parse($dd->DataDetD)->format('d/m/Y')}} </h4>
                    </div>
                    <div class="card-body">
                        <h4 class="font-weight-normal">{{$dd->Competenza}}</h4>
                        <p class="font-weight-normal">{{$dd->Oggetto}}</p>
                        <div class="row">
                            <div class="d-flex col-6">
                                <a href="/detdir/determinazioni/{{$dd->id}}/edit" class="btn btn-primary">Apri</a>
                            </div>
                            <div class="d-flex col-6 justify-content-end">
                                @if ($dd->NomeFileT_1)
                                    <a href="{{$dd->storage}}" target="_blank" title="vai al testo"><button class="btn btn-outline-secondary btn-just-icon">
                                            <i class="material-icons">description</i>
                                        </button></a>
                                @else

                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12">
        <div class="d-flex justify-content-center">
            {{$dds->links('vendor.pagination.bootstrap-4')}}
        </div>
        </div>

    </div>


@endsection
