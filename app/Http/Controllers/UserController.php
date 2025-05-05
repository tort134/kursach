<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\RegisterRequest;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function register(RegisterRequest $request){

        $adres=Address::create([
            'city' => $request->city,
            'street' => $request->street
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'patronymic' => $request->patronymic,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $request->image->store('resources/userImg', 'public'),
            'address_id' => $adres->id,
        ]);

        return [
            'data'=>[
                'name'=> $request->last_name . ' ' .$request->first_name . ' ' . $request->patronymic,
                'address' => $request->city . ' ' . $request->street,
                'email' => $request->email
            ]
        ];
    }
    public function login(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user) throw new ApiException(422, 'Validation Error', ['Wrong email']);

        if(!Hash::check($request->password, $user->password)) throw new ApiException(422, 'Validation error', ['Wrong password']);

        $token = $user->createToken('barter')->plainTextToken;

        $user->remember_token = $token;
        $user->save();

        return [
            'data'=>[
                'name'=> $user->last_name . ' ' .$user->first_name . ' ' . $user->patronymic,
                'email' => $user->email,
                'token' => $token
            ]
        ];
    }

    public function logout(Request $request) {
        $user = $request->user;

        $user->remember_token = null;

        $user->save();

        return [
            'data'=>[
                'token' => $user->remember_token
            ]
        ];
    }

    public function getProfile(Request $request){
        $user = User::where('id', $request->id)->first();
        $ann = Announcement::where('user_id', $request->id)->first();

        foreach ($ann as $i){
            $list[] = array(
                "title" => $i->title,
                "description" => $i->description,
                "image" => $i->image,
                "rating" => $i->rating,
                "type_id" => $i->type_id,
                "user_id" => $i->user_id
            );
        }

        return [
            'data'=>[
                'user' => [ 'name'=> $request->last_name . ' ' .$request->first_name . ' ' . $request->patronymic,
                'address' => $request->city . ' ' . $request->street,
                'email' => $request->email],

                'announcements' => $list
            ]
        ];
    }
}
