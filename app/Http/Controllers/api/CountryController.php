<?php

namespace App\Http\Controllers\api;

use App\Country;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    use ApiResponser;
    public function index()
    {


        //
        if(empty($_GET['page']) || $_GET['page']==''){
            $countries = Country::where('active', 1)->get();

        }else{
            $countries = Country::where('active', 1)->paginate(10);

            return response()->json(['data' => $countries, 'state' => 1], 200);
        }
        return $this->showAll($countries);

    }

    public function countryUsers(Country $country){


        if(empty($_GET['page']) || $_GET['page']==''){
            $users = $country->users()->where('active', 1)->get();
            foreach($users as $user) {
                if(count($user->photos) > 0){
                    foreach ($user->photos->pluck('path') as $photo){
                        $user->photo = $photo;
                    }
                }else{
                    $user->photo = 'nophoto';
                }
                unset($user->photos);


                if($user->created_by != null){
                    $creator = User::find($user->created_by)->name;
                    $user->created_by = $creator;
                }

                $countryName = $user->country()->pluck('name')->first();
                $user->country = $countryName;
                unset($user->pivot);
                unset($user->country_id);
                unset($user->image_profile);
            }
        }else{
            $users = $country->users()->where('active', 1)->paginate(10);
            foreach($users as $user) {
                if(count($user->photos) > 0){
                    foreach ($user->photos->pluck('path') as $photo){
                        $user->photo = $photo;
                    }
                }else{
                    $user->photo = 'nophoto';
                }
                unset($user->photos);

                if($user->created_by != null){
                    $creator = User::find($user->created_by)->name;
                    $user->created_by = $creator;
                }


                $countryName = $user->country()->pluck('name')->first();
                $user->country = $countryName;
                unset($user->pivot);
                unset($user->country_id);
                unset($user->image_profile);
            }
            return response()->json(['data' => $users, 'state' => 1], 200);
        }
        return $this->showAll($users);
    }
}
