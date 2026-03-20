@extends('dedir::template.dashboardWJS')
@section('content')
    <!-- <H2>{{--$tit--}}</H2> -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <div class="row">
                        <div class="d-flex flex-column col-md-6 justify-content-start">
                            <div><h4 class="card-title ">{{$tit}}</h4></div>
                            <div><p class="card-category">Elenco</p></div>
                        </div>
                        <div class="d-flex col-md-6 align-self-center justify-content-end">
                            <a href="{{route('creaCompetenza')}}" title="crea">
                                <button class="btn btn-secondary btn-just-icon" title="nuova competenza">
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
                            <th>Sezione/Servizio/Ufficio</th>
                            <th>Abbreviazione</th>
                            <th>
                                <div class="d-flex align-self-center justify-content-center border-0">
                                    Attivo/Disattivo
                                </div>
                            </th>
                            <th class="d-flex justify-content-end">Azioni</th>
                            </thead>
                            <tbody>
                            @foreach ($competenze as $competenza)
                                <tr>
                                    <td>{{$competenza->id}}</td>
                                    <td>{{$competenza->competenzaComp}}</td>
                                    <td>{{$competenza->competenzaAbbr}}</td>
                                    <td>
                                        <div class="d-flex align-self-center justify-content-center border-0">
                                            @if ($competenza->attivo) <i class="material-icons">done</i>
                                            @else <i class="material-icons">close</i>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-self-center justify-content-end border-0">
                                        <a href="/detdir/competenze/{{$competenza->id}}/edit" title="edit"><button class="btn btn-social btn-just-icon btn-twitter">
                                                <i class="material-icons">edit</i>
                                            </button></a>
                                        <a href="/detdir/competenze/{{$competenza->id}}/delete" title="delete"><button class="btn btn-danger btn-just-icon">
                                                <i class="material-icons">delete_forever</i>
                                            </button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr id="paginazione"><td colspan="6">
                                    <div class="d-flex justify-content-center">
                                        {{$competenze->links('vendor.pagination.bootstrap-4')}}
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
    <script src="/vendor/dedir/assets/js/delCompetenze.js"></script>
@endsection
