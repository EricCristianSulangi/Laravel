<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class registerController extends Controller
{
    public function about(Request $request){
        $validatedata = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $validatedata ['password'] = bcrypt ($validatedata['password']);
        user:: create($validatedata);
        return redirect('/')-> with('berhasil', 'Register barhasil');
    }
}
