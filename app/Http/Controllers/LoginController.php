<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $model;

    public function __construct(UserRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return view('pages.login.index');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if(Auth::attempt(['username' => $validated['username'], 'password' => $validated['password'], 'status' => '1'])) {
            // Update Login At
            $data = array('login_at' => date('Y-m-d H:i:s'));
            $this->model->update($validated['username'], $data);
            return response()->json([
                'httpStatus' => 200,
                'status' => 'success',
                'message' => 'success',
                'data' => Auth::user()
            ], 200);
        } else {
            return response()->json([
                'httpStatus' => 200,
                'status' => 'failed',
                'message' => 'Username or Password is Wrong!',
                'data' => null
            ], 200);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
