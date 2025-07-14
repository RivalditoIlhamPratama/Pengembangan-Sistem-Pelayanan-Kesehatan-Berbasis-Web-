<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\pasien;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255', 'confirmed'],
            'role' => ['required', 'string'],
            'jenisKelamin' => ['required', 'string'],
            'noHp' => ['required', 'string'],
            'alamatPasien' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'remember_token' => Str::random(10),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        $user = User::find($user->id_user);
        if ($user->role === 'pasien') {
            pasien::create([
                'user_id' => $user->id_user,
                'namaPasien' => $user->username,
                'jenisKelamin' => $request->input('jenisKelamin'),
                'noHp' => $request->input('noHp'),
                'alamatPasien' => $request->input('alamatPasien'),
                'email' => $request->input('email'),
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Registration successful',
                'token' => $token,
                'user' => $user,
            ]);
        }

        return redirect($this->redirectPath());
    }
}
