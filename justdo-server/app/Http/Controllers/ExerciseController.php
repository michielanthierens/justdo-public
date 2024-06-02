<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fituser;
use App\Models\Exercise;
use App\Modules\Justdo\Services\ExerciseService;

class ExerciseController extends Controller
{
    // service
    private $_exerciseService;
    public function __construct(ExerciseService $exerciseService)
    {
        $this->_exerciseService = $exerciseService;
    }

    // exercise
    public function getAllExercises()
    {
        if ($this->_exerciseService->hasErrors()) {
            return response()->json(['error' => $this->_exerciseService->getErrors()], 400);
        }
        return $this->_exerciseService->getAllExercises();
    }

    public function getAllExercisesList(Request $request){
        $language = $request->get('language', app()->getLocale());

        return $this->_exerciseService->getAllExercisesList($language);
    }
    

    public function getExerciseById($exercise_id)
    {
        if ($this->_exerciseService->hasErrors()) {
            return response()->json(['error' => $this->_exerciseService->getErrors()], 400);
        }
        return $this->_exerciseService->getExerciseById($exercise_id);
    }

    public function createExercise(Request $request)
    {
        $data = $request->all();
        $exercise = $this->_exerciseService->createExercise($data);

        if ($this->_exerciseService->hasErrors()) {
            return response()->json(['error' => $this->_exerciseService->getErrors()], 400);
        }
        return $exercise;
    }

    public function updateExercise(Request $request, $exercise_id)
    {
        $data = $request->all();
        $exercise = $this->_exerciseService->updateExercise($data, $exercise_id);

        if ($this->_exerciseService->hasErrors()) {
            return response()->json(['error' => $this->_exerciseService->getErrors()], 400);
        }
        return $exercise;
    }

    public function deleteExercise($exercise_id)
    {
        $exercise = $this->_exerciseService->deleteExercise($exercise_id);

        if ($this->_exerciseService->hasErrors()) {
            return response()->json(['error' => $this->_exerciseService->getErrors()], 400);
        }
        return $exercise;
    }
}
