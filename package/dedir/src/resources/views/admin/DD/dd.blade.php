@extends('dedir::template.dashboardWJS')
@section('content')
    @isset($selCompetenza)
        <!--<H2>{{$selCompetenza}}</H2>
        <H6>{{$competenze}}</H6> -->
    @endisset
@include('dedir::admin.partial.filtriDetermine')
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
                            <div><p class="card-category">Elenco</p></div>
                        </div>
                        <div class="d-flex col-md-2 align-self-center justify-content-end">
                            <a href="/detdir/determinazioni/card" title="view">
                                <button class="btn btn-secondary btn-just-icon" title="vista formato cards">
                                    <i class="material-icons">grid_view</i>
                                </button>
                            </a>
                            <a href="{{route('creaDetermina')}}" title="crea">
                                <button class="btn btn-secondary btn-just-icon" title="nuova determinazione">
                                    <i class="material-icons">library_add</i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dd-table">
                            <thead class=" text-primary">
                            <th>ID</th>
                            <th>Nr.</th>
                            <th>Data</th>
                            <th>Competenza</th>
                            <th>Oggetto</th>
                            <th>Testo</th>
                            <th class="d-flex justify-content-end">Azioni</th>
                            </thead>
                            <tbody>
                            @foreach ($dds as $dd)
                                <tr>
                                    <td>{{$dd->id}}</td>
                                    <td>{{$dd->NrDet}}</td>
                                    <td>{{\Carbon\Carbon::parse($dd->DataDetD)->format('d/m/Y')}}</td>
                                    <td>{{$dd->sezione}}</td>
                                    <td>{{$dd->Oggetto}}</td>
                                    <td>
                                        @if ($dd->NomeFileT_1)
                                        <a href="{{$dd->storage}}" target="_blank" title="vai al testo"><button class="btn btn-outline-secondary btn-just-icon">
                                                <i class="material-icons">description</i>
                                            </button></a>
                                        @else

                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex align-self-center justify-content-end border-0">
                                        <a href="/detdir/determinazioni/{{$dd->id}}/edit" title="edit"><button class="btn btn-social btn-just-icon btn-twitter">
                                                <i class="material-icons">edit</i>
                                            </button></a>
                                        <a href="/detdir/determinazioni/{{$dd->id}}/delete" title="delete"><button class="btn btn-danger btn-just-icon">
                                                <i class="material-icons">delete_forever</i>
                                            </button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr id="paginazione"><td colspan="7">
                                    <div class="d-flex justify-content-center">
                                        {{$dds->links('vendor.pagination.bootstrap-4')}}
                                    </div>
                                </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    @parent
    <script src="/vendor/dedir/assets/js/sweet-alert.js"></script>
    <link rel="stylesheet" href="/vendor/dedir/assets/css/sweet-alert.css">
    <script src="/vendor/dedir/assets/js/delDetermine.js"></script>
@endsection
