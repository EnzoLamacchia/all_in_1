@if(str_contains($msg, ' singolo '))
    {{--@if(str_contains($messaggio, 'non aggiornata!!!') OR str_contains(session()->get('messaggio'), 'non aggiornato!!!')) --}}
    <div class="alert alert-danger" role="alert" id="alert_msg">
        {{$slot}}
        <H4>ATTENZIONE!</H4>
        {{$msg}}
    </div>
@else
    <div class="alert alert-success" role="alert" id="alert_msg">
        {{$slot}}
        {{$msg}}
    </div>
@endif
