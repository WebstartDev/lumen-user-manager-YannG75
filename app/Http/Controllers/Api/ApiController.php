<?php


namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;

class ApiController
{
    public function index(Request $request)
    {

        $users = DB::table('users')->get();

        return json_encode($users,true);
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
            $errors = $validator->errors()->all();
            return json_encode($errors, true);
        }

        else {
            $input = $request->all();
            $userCreated= DB::insert('insert into users (first_name, last_name, created_at, updated_at, email, password) values (?, ?, ?, ?, ?, ?)',
                [$input['first_name'], $input['last_name'], Carbon::now(), Carbon::now(), $input['email'], Crypt::encrypt($input['password'])]);
            if($userCreated)
                $success = 'Création de l\'utilisateur réussi !';

        }

        return json_encode($success, true);
    }

    public function getUser(Request $request, $userId)
    {
        $user = DB::table('users')->where('id', $userId)->first();
        $success = 'update réussie !';
        $errors = 'Une erreur est survenue au moment de l\'update !';
        if ($request->segment(3) == 'edit') {
            $user->password = Crypt::decrypt($user->password);
            $edit = 1;
            return view('create', ['user' => $user, 'edit' => $edit]);
        }


        else
            return json_encode($user, true);

    }

    public function update(Request $request, $userId){
        $success = '';
        $error = '';

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
            $success = 'Update de l\'utilisateur réussi !';
        else
            $error = 'L\'Update à échouée !';

        return json_encode([$success,$error], true);
    }

    public function destroy(Request $request, $userId) {

        $success = 'Suppression réussie !';

        DB::table('users')->where('id', $userId)->delete();
        return json_encode($success, true);

    }
}
