<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fituser;
use App\Models\Exercise;
use App\Modules\Justdo\Services\Fituser_ExerciseService;

class Fitusers_ExerciseController extends Controller
{
    private $_service;
    public function __construct(Fituser_ExerciseService $service)
    {
        $this->_service = $service;
    }

    public function getExercisesByFituserId($fituser, Request $request)
    {
        $language = $request->get('language', app()->getLocale());
        $fituser = $this->_service->getExercisesByFituserId($fituser, $language);
        return response()->json($fituser);
    }

    public function addExerciseToUser($fitusers_id, $exercise_id, $number_of_reps, Request $request)
    {
        $language = $request->get('language', app()->getLocale());
        $fituser = $this->_service->addExerciseToUser($fitusers_id, $exercise_id, $number_of_reps, $language);
        return response()->json($fituser);
    }

    public function updateExerciseReps($fitusers_id, $exercise_id, $number_of_reps, Request $request)
    {
        $language = $request->get('language', app()->getLocale());
        $fituser = $this->_service->updateExerciseReps($fitusers_id, $exercise_id, $number_of_reps, $language);
        return response()->json($fituser);
    }

    public function removeAllExercisesFromUser(Fituser $model, $fitusers_id)
    {
        $fituser = $this->_service->removeAllExercisesFromUser($fitusers_id);
        return response()->json($fituser);
    }

    public function removeExerciseFromUser(Exercise $model, Fituser $userModel, $fitusers_id, $exercise_id)
    {
        $fituser = $this->_service->removeExerciseFromUser($fitusers_id, $exercise_id);
        return response()->json($fituser);
    }
}
