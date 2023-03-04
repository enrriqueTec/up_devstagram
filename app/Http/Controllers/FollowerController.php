<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //


    public function store(User $user)
    {
        /*Aquí se utiliza attach por que los campos que se van a almacenar perteneces 
        al mismo modelo y no son modelos independientes*/
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
