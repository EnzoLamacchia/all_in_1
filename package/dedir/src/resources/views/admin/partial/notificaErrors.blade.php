@if (count($errors))
    <div id="alert" class="alert alert-stranger">
        <h5><svg class="icon"><use xlink:href="/bootstrap-italia/svg/sprite.svg#it-close-circle"></use></svg> Errori nel form:</h5>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
    </div>
@endif
