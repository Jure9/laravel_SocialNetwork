<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function logIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            return redirect()->route('home');
        }

        return redirect()->back();
    }
    public function signUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'firstName' => 'required',
            'lastName' => 'required',
            'password' => 'required|min:5',
        ]);

        $user=new User();

        $firstName=$request['firstName'];
        $lastName=$request['lastName'];
        $email=$request['email'];
        $password=bcrypt($request['password']);

        $user->firstName=$firstName;
        $user->lastName=$lastName;
        $user->email=$email;
        $user->password=$password;

        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }
    public function logOut()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }
    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }
    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required'
        ]);

        $user=Auth::user();
        $old_name = $user->firstName;
        $user->firstName = $request['firstName'];
        $user->lastName= $request['lastName'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['firstName'] . '-' . $user->id . '.jpg';
        $old_filename = $old_name . '-' . $user->id . '.jpg';
        $update = false;
        if (Storage::disk('local')->has($old_filename)) {
            $old_file = Storage::disk('local')->get($old_filename);
            Storage::disk('local')->put($filename, $old_file);
            $update = true;
            $m='11';
        }
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
            $m='22';
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
            $m='33';
        }
        return redirect()->route('account')->with(['msg' => $m]);
    }


    /**
     * @param $filename
     * @return Response
     */
    public function getImage($filename)
    {
        $file=Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}