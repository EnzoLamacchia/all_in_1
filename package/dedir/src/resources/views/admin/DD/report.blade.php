@extends('dedir::template.dashboardWJS')
@section('content')
    @isset($selCompetenza)
        <!--<H2>{{$selCompetenza}}</H2>
        <H6>{{$competenze}}</H6> -->
    @endisset
    @include('dedir::admin.partial.filtriReportDetermine')

@stop
@section('footer')
    @parent
@endsection
