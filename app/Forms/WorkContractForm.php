<?php

namespace App\Forms;

use App\Classes\FormBlock;
use App\Classes\FormInputRadioField;
use App\Classes\FormInputTextField;
use App\Classes\FormStep;
use App\Classes\LegalForm;

class WorkContractForm extends LegalForm {
    public function __construct(string | null $currentStepSlug = null)
    {
        $this->title = 'Contrat de travail';
        $this->slug = 'work-contract';
        $this->steps = [
            'employee-information' => new FormStep('employee-information', [
                new FormBlock('personal-information', [
                    new FormInputTextField('firstname', 'required|string'),
                    new FormInputTextField('lastname', 'required|string'),
                    new FormInputRadioField('gender', 'required|string', ['male' => 'male', 'female' => 'female', 'other' => 'other']),
                ]),
                new FormBlock('contact-information', [
                    new FormInputTextField('phone', 'required|string'),
                    new FormInputTextField('email', 'required|email'),
                ]),
                new FormBlock('address-information', [
                    new FormInputTextField('address', 'required|string'),
                    new FormInputTextField('city', 'required|string'),
                    new FormInputTextField('zip', 'required|string'),
                ]),
            ]),
            'employee-functions' => new FormStep('employee-functions', [
                new FormBlock('work-function', [
                    new FormInputTextField('job-title', 'required|string'),
                    new FormInputTextField('job-description', 'required|string'),
                ]),
            ]),
            'work-location' => new FormStep('work-location', [
                new FormBlock('work-location', [
                    new FormInputTextField('workplace', 'required|string'),
                    new FormInputTextField('workplace-description', 'required|string'),
                ]),
            ]),
            'work-rate' => new FormStep('work-rate', [
                new FormBlock('work-rate', [
                    new FormInputTextField('work-rate', 'required|string'),
                    new FormInputTextField('work-rate-description', 'required|string'),
                ]),
            ]),
        ];
        $this->currentStepSlug = $currentStepSlug ?: array_key_first($this->steps);
    }
}
