<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fituser;
use App\Models\Exercise;
use App\Modules\Justdo\Services\FituserService;

class FitusersController extends Controller
{

    // service
    private $_fituserService;
    public function __construct(FituserService $fituserService)
    {
        $this->_fituserService = $fituserService;
    }

    // fituser
    public function getAllFitusers()
    {
        if ($this->_fituserService->hasErrors()) {
            return response()->json(['error' => $this->_fituserService->getErrors()], 400);
        }
        return $this->_fituserService->getAllFitusers();
    }

    public function getFituserById($fitusers_id)
    {
        if ($this->_fituserService->hasErrors()) {
            return response()->json(['error' => $this->_fituserService->getErrors()], 400);
        }
        return $this->_fituserService->getFituserById($fitusers_id);
    }
    
    public function createFituser(Request $request)
    {
        $data = $request->all();
        $fituser = $this->_fituserService->createFituser($data);

        if ($this->_fituserService->hasErrors()) {
            return response()->json(['error' => $this->_fituserService->getErrors()], 400);
        }
        return response()->noContent();
    }

    public function updateFituser(Request $request, $fitusers_id)
    {
        $data = $request->all();
        $fituser = $this->_fituserService->updateFituser($data, $fitusers_id);

        if ($this->_fituserService->hasErrors()) {
            return response()->json(['error' => $this->_fituserService->getErrors()], 400);
        }
        return $fituser;
    }
    
    public function deleteFituser($fitusers_id)
    {
        $this->_fituserService->deleteFituser($fitusers_id);
        return response()->json(['success' => 'Fituser deleted'], 200);
    }
}
