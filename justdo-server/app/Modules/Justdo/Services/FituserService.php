<?php

namespace App\Modules\Justdo\Services;

use App\Modules\Core\Services\Service;
use App\Models\Fituser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class FituserService extends Service
{

    protected $_rules = [
        'name' => 'required|unique:fitusers|string',
        'password' => 'required|string'
    ];

    protected $_credentialsRules = [
        'name' => 'required|string',
        'password' => 'required|string'
    ];

    public function __construct(Fituser $model)
    {
        parent::__construct($model);
    }

    public function getAllFitusers()
    {
        return $this->_model->get();
    }

    public function getFituserById($fitusers_id)
    {
        $fituser = $this->_model->find($fitusers_id);
    
        if (!$fituser) {
            return;
        }
        return $fituser;
    }
    
    public function createFituser($data)
    {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }

        $fituser = new Fituser();
        $fituser->name = $data['name'];
        $fituser->password = Hash::make($data['password']);
        $fituser->save();

        return $fituser;
    }

    public function updateFituser($data, $fitusers_id)
    {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }

        $fituser = $this->_model->find($fitusers_id);
        $fituser->name = $data['name'];
        $fituser->password = $data['password'];
        $fituser->save();

        return $fituser;
    }

    public function deleteFituser($fitusers_id)
    {
        $fituser = $this->_model->find($fitusers_id);

        if (!$fituser) {
            $this->_errors->add('error', 'Fituser not found');
            return;
        }

        $fituser->delete();
    }

    public function login($data)
    {
        $this->validateWithRules($data, $this->_credentialsRules);
        if ($this->hasErrors()) {
            return;
        }

        $token = Auth::attempt($data);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();

        return response([
            "status" => "success",
            "user_id" => $user->fituser_id,
            "name" => $user->name,
            "authorisation" => [
                'token' => $token,
                'type' => "bearer"
            ]
        ], 200);
    }

    public function register($data)
    {
        
        $this->validate($data);
        if ($this->hasErrors()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $fituser = new Fituser();
        $fituser->name = $data['name'];
        $fituser->password = Hash::make($data['password']);
        $fituser->save();

        $token = Auth::login($fituser);
        return response([
            "status" => "success",
            "user_id" => $fituser->fituser_id,
            "name" => $fituser->name,
            "authorisation" => [
                'token' => $token,
                'type' => "bearer"
            ]
        ], 200);
    }
}