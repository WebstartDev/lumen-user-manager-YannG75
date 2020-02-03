<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {

        $users = DB::table('users')->get();
        $success = $request->session()->get('status');
        return view('index', ['users' => $users, 'success' => $success]);
    }

    public function getUser(Request $request, $userId)
    {
        $user = DB::table('users')->where('id', $userId)->first();
        $success = $request->session()->get('status');
        $errors = $request->session()->get('errors');
        if ($request->segment(3) == 'edit') {
            $user->password = Crypt::decrypt($user->password);
            $edit = 1;
            return view('create', ['user' => $user, 'edit' => $edit]);
        }


        else
            return view('user', ['user' => $user, 'success' => $success, 'errors' => $errors]);

    }

    public function create(Request $request)
    {
        $errors = $request->session()->get('errors');
        return view('create',['errors'=>$errors]);
    }

    public function creating(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                 $request->session()->flash('errors', $validator->errors()->all());
                return redirect('/users/create');
            }

            else {
                $input = $request->all();
                $userCreated= DB::insert('insert into users (first_name, last_name, created_at, updated_at, email, password) values (?, ?, ?, ?, ?, ?)',
                    [$input['first_name'], $input['last_name'], Carbon::now(), Carbon::now(), $input['email'], Crypt::encrypt($input['password'])]);
                if($userCreated)
                $request->session()->flash('status', 'Création de l\'utilisateur réussi !');

            }

        return redirect('/users');
    }

    public function update(Request $request, $userId){


            $input = $request->all();
            $userUpdate = DB::table('users')
                ->where('id', $userId)
                ->update(['first_name' => $input['first_name'], 'last_name' => $input['last_name'], 'updated_at' => Carbon::now(), 'email' => $input['email']]);
                if (!empty($input['password'])){
                    DB::table('users')
                        ->where('id', $userId)
                        ->update(['password' => Crypt::encrypt($input['password'])]);
                }
            if ($userUpdate)
                $request->session()->flash('status', 'Update de l\'utilisateur réussi !');
            else
                $request->session()->flash('errors', 'L\'Update à échouée !');

        return redirect('/users/'.$userId);
    }

    public function destroy(Request $request, $args) {
        DB::table('users')->where('id', $args)->delete();
        $request->session()->flash('status', 'Suppression réussie !');

        return redirect('/users');

    }

    //
}


