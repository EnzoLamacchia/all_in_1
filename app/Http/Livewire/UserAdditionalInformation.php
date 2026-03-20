<?php

namespace App\Http\Livewire;

use App\Models\Data\City;
use App\Models\Data\Country;
use App\Models\UserProfile;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserAdditionalInformation extends Component
{
    public $info = [];
    public $sexes = [];
    public $prof_id, $birthday, $phone, $mobile, $address, $sex, $note, $cf;
    public $country_id, $country, $city_id, $city;

    public function mount()
    {
        $this->info = Auth::user()->userprofile()->get()->toArray();
        $this->prof_id = $this->info[0]['id'];
        $this->birthday = Carbon::parse($this->info[0]['birthday'])->format('d/m/Y');
        $this->phone = $this->info[0]['phone'];
        $this->mobile = $this->info[0]['mobile_number'];
        $this->address = $this->info[0]['address'];
        $this->sex = $this->info[0]['sex'];
        $this->note = $this->info[0]['note'];
        $this->cf = $this->info[0]['cf'];
        $this->country_id = $this->info[0]['country_id'] ? $this->info[0]['country_id'] : '110';
        $this->country = Country::find($this->info[0]['country_id'])->name ? Country::find($this->info[0]['country_id'])->name : 'Italy';
        $this->city_id = $this->info[0]['city_id'] ?  $this->info[0]['city_id'] : null;
        $this->city = $this->city_id ? City::find($this->info[0]['city_id'])->name : '';
        $this->sexes = ['M','F'];
    }

    public function render()
    {
//        dd($this->info);
        return view('livewire.user-additional-information');
    }

    public function validationStep(){
        $this->validate([
            'birthday' => 'date_format:d/m/Y',
            'phone' => 'nullable|string|min:8',
            'mobile' => 'nullable|string|min:8',
            'address'=> 'nullable|string|max:255',
            'sex'=> ['required', Rule::in(['M', 'F'])],
            'note'=> 'nullable|string|min:2|max:255',
            'cf'=> 'nullable|string|min:16|max:16',
        ],['birthday.date_format'=>'Data di nascita -> formato non consentito. Utilizzare (gg/mm/aaaa)',
            'phone.required'=>'il nr. di telefono è un elemento obbligatorio',
            'phone.min'=>'nr. di telefono -> minimo 8 caratteri',
            'mobile.min'=>'nr. di cellulare -> minimo 8 caratteri',
            'address.min'=>'indirizzo -> lunghezza minima 3 caratteri alfanumerici',
            'address.man'=>'indirizzo -> lunghezza minima 255 caratteri alfanumerici',
            'note.min'=>'note -> lunghezza minima 3 caratteri alfanumerici',
            'note.man'=>'note -> lunghezza minima 255 caratteri alfanumerici',
            'cf.min'=>'codice fiscale -> lunghezza 16 caratteri alfanumerici',
            'cf.max'=>'codice fiscale -> lunghezza 16 caratteri alfanumerici',
        ]);
    }

    public function updateProfile(){
        $this->validationStep();
//        dd(City::getCiyidAttribute($this->city)[0]->id);
        $dataDiNascita = DateTime::createFromFormat('d/m/Y', $this->birthday)->format('Y-m-d');
        $profileToUpdate = UserProfile::find($this->prof_id);

        $profileToUpdate->update([
        'birthday' => $dataDiNascita,
        'phone' => $this->phone,
        'mobile_number' => $this->mobile,
        'address' => $this->address,
        'city_id' => $this->address ? City::getCityidAttribute($this->city)[0]->id : null,
        'sex' => $this->sex,
        'note' => $this->note,
        'cf' => strtoupper($this->cf),
        ]);

        $this->emit('saved');
        $this->emit('refresh-navigation-menu');
    }
}
