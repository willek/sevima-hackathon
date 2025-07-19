<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $data['users'] = User::orderBy('email')->role('security')->get();

        return view('pages.users.index', $data);
    }

    public function create() {
        return view('pages.users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($request->all());
        $user->assignRole('security');

        return redirect()->route('users.index');
    }


    public function edit($id) {
        $data['data'] = User::findOrFail($id);

        return view('pages.users.edit', $data);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required',
        ];

        if (trim($request->password) != null) {
            $rules['password'] = 'required|confirmed';
        } else {
            unset($request['password']);
        }

        $request->validate($rules);
        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy($id) {
        User::where('id', $id)->delete();

        return redirect()->route('users.index');
    }

    public function report($id)
    {
        $data['user'] = User::findOrFail($id);

        return view('pages.users.report', $data);
    }
}
