<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function changeBackground(Request $request)
    {
        try {

            $user  = User::find($request->user_id);
            $user->background =  $request->background;
            $user->save();
        }     catch (\Exception $e) {
            \Log::error('Falha fatal na alteração  do  background . '.$e->getMessage());
        }

    }

}
