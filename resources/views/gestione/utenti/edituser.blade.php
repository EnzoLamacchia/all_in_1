<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Utenti" urlCerca="" nomeBtnNuovo="Lista Utenti" urlNuovo="{{route('gestioneutenti')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Modifica utente" urlCerca="" nomeBtnNuovo="Nuovo Utente" urlNuovo="{{route('creautente')}}">
        </x-header.subheader>
{{--{{dd($stati)}}--}}
        <x-forms.modify-user :user="$user" :stati="$stati"></x-forms.modify-user>
        </div>
    </div>
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $("#salvato").fadeOut(3000); //esegue il fadeOut sul messaggio di alert di modifica di un album--}}
{{--        })--}}
{{--        // var s = document.getElementById('salvato').style;--}}
{{--        //  s.opacity = 1;--}}
{{--        //  (function fade(){(s.opacity-=.05)<0?s.display="none":setTimeout(fade,200)})();--}}
{{--    </script>--}}
</x-gestione-layout>
