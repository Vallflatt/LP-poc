<?php

namespace App\Formatter;

use App\Classes\FormBlock;
use App\Forms\WorkContractForm;

class WorkContractFormatter
{
    private WorkContractForm $form;

    public function __construct(WorkContractForm $form)
    {
        $this->form = $form;
    }

    public function getDisplayName(): string
    {
        return $this->form->getTitle();
    }

    public function getEmployeeInformation(): string | null
    {
        $personalInformations = $this->getPersonalInformation();
        $value = [];
        $value[] = $this->getPersonTitle();
        $value[] = $personalInformations->getFieldBySlug('lastname')->getValue();
        $value[] = $personalInformations->getFieldBySlug('firstname')->getValue();
        return join(' ', $value);
    }

    public function getJobTitle(): string | null
    {
        return $this->getWorkFunction()->getFieldBySlug('job-title')->getValue();
    }

    private function getPersonalInformation(): FormBlock
    {
        return $this->form->getStepBySlug('employee-information')->getBlockBySlug('personal-information');
    }

    private function getWorkFunction(): FormBlock
    {
        return $this->form->getStepBySlug('employee-functions')->getBlockBySlug('work-function');
    }

    private function getPersonTitle(): string
    {
        switch ($this->getPersonalInformation()->getFieldBySlug('gender')->getValue()) {
            case 'male':
                return 'Mr.';
            case 'female':
                return 'Mrs.';
            case 'other':
                return 'Mx.';
            default:
                return '';
        }
    }
}
