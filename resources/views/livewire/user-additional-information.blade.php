<x-jet-form-section submit="">

    <x-slot name="title">
        {{ __(' Info Addizionali') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Aggiorna le info addizionali del tuo account') }}
    </x-slot>
    <x-slot name="form">

{{--        {{dd($info[0], $birthday, $phone)}}--}}
        <!-- Birthday -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="birthday" value="{{ __('Data di nascita') }}" />
            <x-jet-input id="birthday" type="text" class="mt-1 block w-full" wire:model.defer="birthday" autocomplete="birthday" />
            <x-jet-input-error for="birthday" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone" value="{{ __('Telefono') }}" />
            <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="phone" autocomplete="phone" />
            <x-jet-input-error for="phone" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="mobile" value="{{ __('Cellulare') }}" />
            <x-jet-input id="mobile" type="text" class="mt-1 block w-full" wire:model.defer="mobile" autocomplete="mobile" />
            <x-jet-input-error for="mobile" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="{{ __('Address') }}" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="address" autocomplete="address" />
            <x-jet-input-error for="address" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4" wire:model.defer="sex">
            <x-jet-label for="sex" value="{{ __('Sesso') }}" />
            <select name="sex" class="px-3 py-2 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                @foreach ($sexes as $item)
                    <option value={{$item}}
                            @if ($item == $sex)
                            selected="selected"
                        @endif
                    >{{ $item }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="sex" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="country" value="{{ __('Nazione') }}" />
            <x-jet-input id="country" type="text" class="mt-1 block w-full" wire:model.defer="country" autocomplete="country" />
            <x-jet-input-error for="country" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4" wire:model.defer="city">
            <x-jet-label for="city" value="{{ __('City') }}" />
{{--            <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="city" autocomplete="city" />--}}
            <select name="city" class="px-3 py-2 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value=""></option>
                @foreach (\App\Models\Data\City::orderBy('name','ASC')->get() as $citta)
                    <option value="{{ $citta->name }}"
                            @if ($citta->id == $city_id)
                            selected="selected"
                            @endif
                    >{{ $citta->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="city" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="note" value="{{ __('Note') }}" />
            <x-jet-input id="note" type="text" class="mt-1 block w-full" wire:model.defer="note" autocomplete="note" />
            <x-jet-input-error for="note" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="cf" value="{{ __('Codice Fiscale') }}" />
            <x-jet-input id="cf" type="text" class="mt-1 block w-full" wire:model.defer="cf" autocomplete="cf" />
            <x-jet-input-error for="cf" class="mt-2" />
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
        <x-jet-button wire:click.prevent="updateProfile()" >
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
