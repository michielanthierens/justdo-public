<?php

namespace App\Modules\Core\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Modules\Core\Services\Service;

abstract class ServiceLanguages extends Service
{

    protected $_rulesTranslations = [];

    // -- VALIDATOR --> REFACTOR --
    protected function validateAllWithTranslations($data)
    {
        $this->validateDataTranslations($data);
        return !$this->hasErrors();
    }

    protected function validateData($data, $rules = null)
    {
        if ($rules == null)
            $rules = $this->_rules;

            
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            $this->_errors = $validator->errors();
            return;
        }
    }

    private function validateDataTranslations($data)
    {
        
        foreach ($data as $translation) {
            $this->validateDataTranslation($translation);
        }
    }

    private function validateDataTranslation($data)
    {
        return $this->validateData($data, $this->_rulesTranslations);
    }

    // -- PRESENTERS --> REFACTOR --
    protected function presentAllWithTranslations($data)
    {
        foreach ($data as $record) {
            $returnData[] = $this->presentFindWithTranslations($record);
        }
        return $returnData;
    }

    protected function presentFindWithTranslations($data)
    {
        if (!isset($data["translations"]))
            return $data;

        $translations = [];
        foreach ($data["translations"] as  $translation) {
            $translations[$translation["language_code"]] = $translation;
        }
        $data["translations"] = $translations;

        return $data;
    }

    protected function presentDetailWithTranslations($data)
    {
        return (count($data["translations"])) ? $data["translations"][0] : null;
    }

    protected function presentListWithTranslations($data)
    {
        foreach ($data as $index => $record) {
            $data[$index]["translations"] = $this->presentDetailWithTranslations($record);
        }

        return $data;
    }
   
}
