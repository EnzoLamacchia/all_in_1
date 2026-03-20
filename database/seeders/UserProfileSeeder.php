<?php
namespace Database\Seeders;

use App\Models\Data\City;
use App\Models\Data\Country;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker as Faker;


class UserProfileSeeder extends Seeder
{

    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        UserProfile::truncate();
//        $users = User::All();
        $users = User::all();
        $country = Country::where('name', '=', 'Italy')->pluck('id');
        $faker = Faker\Factory::create('it_IT');
        foreach ($users as $user) {
//            factory(UserProfile::class)->create([
//                'user_id' => $user->id,
//            ]);


            $city = City::where('id', '=', rand(1,7998))->pluck('id');
            UserProfile::create([
                'user_id' => $user->id,
                'birthday' => $faker->dateTimeBetween('-60 years', '-18 years'),
                'phone' => '+39 0'.$faker->randomNumber(3, false).$faker->randomNumber(7, true),
                'mobile_number' => '+39 3'.$faker->randomNumber(2, true).$faker->randomNumber(7, true),
                'address'=> $faker->Address(),
                'sex' => implode($faker->randomElements(['M', 'F'])),
                'country_id' => $country[0],
                'city_id' => $city[0],
                'note' => $faker->sentence(15, true),
                'last_access' => $faker->dateTimeBetween('-1 months', '-1 days'),
                'cf' => $faker->taxId(),
            ]);

        }
    }
}
