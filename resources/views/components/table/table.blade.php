<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg">
                <table {{$attributes->merge(['class'=>'table-fixed min-w-full'])}} id="{{$idTable ?? ''}}">
{{--                    class="table-fixed min-w-full"--}}
                    <thead class="border-b bg-gray-100 uppercase text-sm text-gray-600 font-medium text-left">
                    <tr>
                        @foreach($intestazioni as $intestazione)
{{--                            <th scope="col" class="px-6 py-3 {{$intestazione[1]}}">{{$intestazione[0]}} </th> --}}
                            <x-table.th class="{{$intestazione['LarghCol']}}">{{$intestazione['NomCol']}}</x-table.th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
