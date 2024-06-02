<?php 

namespace App\Modules\Justdo\Services;

use App\Models\Fituser;
use App\Models\Exercise;
use App\Modules\Core\Services\Service;


class Fituser_ExerciseService extends Service
{
    protected $_rules = [
        'reps' => 'required'
    ];
    
    public function __construct(Fituser $model)
    {
        parent::__construct($model);
    }

    public function getExercisesByFituserId($fitusers_id, $language)
    {
        $fituser = $this->_model->find($fitusers_id);
    
        if (!$fituser) {
            return response()->json(['error' => 'Fituser not found'], 404);
        }

        // get all exercises for this fituser
        // returns array of exercise objects
        $fitUserExercises = [];
        foreach ($fituser->exercises as $exercise) {
            $exerciseTranslations = $exercise->translations()->where('language_code', $language)->first();
            $fitUserExercises[] = ["exercise" => $exerciseTranslations, "reps" => $exercise->pivot->reps];
        }

        

        return [ 'name' => $fituser->name, 'exercises' => $fitUserExercises];
    }

    public function addExerciseToUser($fitusers_id, $exercise_id, $number_of_reps, $language)
    {
        //prevent dubliplication
        if($this->_model->find($fitusers_id)->exercises->find($exercise_id)) {
            return response()->json(['error' => 'Exercise already exists for this user'], 404);
        }

        $this->_model->find($fitusers_id)
                ->exercises()
                ->attach($exercise_id, ['reps' => $number_of_reps]);
        return [
            'exercise' => $this->_model->find($fitusers_id)->exercises->find($exercise_id)
            ->translations()->where('language_code', $language)->first(),
            'fituser' => $this->_model->find($fitusers_id)->name,
            'reps' => $number_of_reps
        ];
    }

    public function updateExerciseReps($fituser, $exercise_id, $number_of_reps, $language)
    {
        $this->_model->find($fituser)
            ->exercises()
            ->updateExistingPivot($exercise_id, ['reps' => $number_of_reps]);

        return [
            'exercise' => $this->_model->find($fituser)->exercises->find($exercise_id)
            ->translations()->where('language_code', $language)->first(),
            'fituser' => $this->_model->find($fituser)->name,
            'reps' => $number_of_reps
        ];
    }

    public function removeAllExercisesFromUser($fitusers_id)
    {
        $this->_model->find($fitusers_id)
            ->exercises()
            ->detach();

        return ['deleted all exercises' => true,
                'fituser' => $this->_model->find($fitusers_id)->name
        ];
    }

    public function removeExerciseFromUser($fitusers_id, $exercise_id)
    {
        if (!$this->_model->find($fitusers_id)->exercises->find($exercise_id)) {
            return response()->json(['error' => 'Exercise not found for this user'], 404);
        }
        
        $this->_model->find($fitusers_id)
            ->exercises()
            ->detach($exercise_id);

        return ['deleted exercise from user' => true,
                'fituser' => $this->_model->find($fitusers_id)->name,
            ];
    }
}

