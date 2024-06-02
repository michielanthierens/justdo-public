<?php

namespace App\Modules\Justdo\Services;

use App\Models\Exercise;
use App\Modules\Core\Services\Service;
use App\Modules\Core\Services\ServiceLanguages;

class ExerciseService extends ServiceLanguages
{
    protected $_rules = [
        'difficulty' => 'required|integer|between:1,5',
        'translations' => 'required|array|min:1'
    ];

    protected $_rulesTranslations = [
        'language_code' => 'required|string|min:2|max:2',
        'exercise' => 'required|string',
        'description' => 'required|string|max:255'
    ];

    public function __construct(Exercise $model)
    {
        parent::__construct($model);
    }

    public function getAllExercises()
    {
        $data = $this->_model->with('translations')->get();
        return $this->presentAllWithTranslations($data->toArray());
        // gives only 1 Exercise (with all translations)
    }

    public function getAllExercisesList($language)
    {
        $data = $this->_model->with(
            ["translations" => function ($query) use ($language) {
                if ($language)
                return $query->where('language_code', $language);
            }]
        )
        ->get();

        $data = $this->presentListWithTranslations($data->toArray());
        return $data;
    }

    public function getExerciseById($exercises_id)
    {
        $data = $this->_model->with('translations')->find($exercises_id);

        $data = $this->presentFindWithTranslations($data->toArray());

        return [ 'data' => $data ];
    }

    public function createExercise($data)
    {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }

        $this->validateAllWithTranslations($data['translations']);
        if ($this->hasErrors()) {
            return;
        }

        $exercise = $this->_model->create([
            'difficulty' => $data['difficulty'],
        ]);
        $exercise->translations()->createMany($data['translations']);
        
        return $exercise->with('translations')->find($exercise->exercise_id);
    }

    public function updateExercise($data, $exercises_id)
    {
        // check if exercise exists
        $exercise = $this->_model->find($exercises_id);
        if (!$exercise) {
            return;
        }

        // check if there is anything to update
        if (!isset($data['difficulty']) && !isset($data['translations'])) {
            return;
        }
        // if the difficulty is set, validate it and update it
        if (isset($data['difficulty'])) {

            $this->validateData($data, ['difficulty' => 'required|integer|between:1,5']);
            if ($this->hasErrors()) {
                return;
            }

            $exercise->difficulty = $data['difficulty'];
            $exercise->save();
        }
        // if the translations arrays are set, validate them and update them
        if (isset($data['translations'])) {
            $this->validateAllWithTranslations($data['translations']);
            if ($this->hasErrors()) {
                return;
            }
            
            $exercise->translations()->delete();
            $exercise->translations()->createMany($data['translations']);
        }
        
    
        return $exercise->with('translations')->find($exercise->exercise_id);
    }

    public function deleteExercise($exercises_id)
    {
        $exercise = $this->_model->find($exercises_id);
        if (!$exercise) {
            return;
        }

        $exercise->delete();
    }
}