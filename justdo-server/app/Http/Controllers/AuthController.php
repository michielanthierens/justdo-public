<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Fituser;
use Illuminate\Support\Facades\Validator;
use App\Modules\Justdo\Services\FituserService;

class AuthController extends Controller
{
    private $_fituserService;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
        $this->_fituserService = new FituserService(new Fituser());
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $response = $this->_fituserService->login($data);

        if ($this->_fituserService->hasErrors()) {
            return response()->json(['error' => $this->_fituserService->getErrors()], 400);
        }

        return $response;
    }

    public function register(Request $request){
        $data = $request->all();
        $response = $this->_fituserService->register($data);

        if ($this->_fituserService->hasErrors()) {
            return response()->json(['error' => $this->_fituserService->getErrors()], 400);
        }

        return $response;
        
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'token' => Auth::refresh(),
        ], 200);
    }
}