<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
	public function create()
	{
		return view('sessions.create');
	}

	public function store(Request $request)
	{
		$credentials=$this->validate($request,
			['email'=>'required|email|max:255',
			'password'=>'required'
		]
	);
		if (Auth::attempt($credentials))
		{
			session()->flash('success','welcome!');
			return redirect()->route('users.show',[Auth::user()]);
		}else{
			session()->flash('danger','Wrong ID or password !');
			return redirect()->back()->withInput();
		}
		return;
	}

	public function destroy(){
		Auth::logout();
		session()->flash('success','已登出');
		return redirect('login');
	}
}
