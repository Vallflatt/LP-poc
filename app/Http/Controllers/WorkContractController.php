<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Forms\WorkContractForm;
use Illuminate\Http\Request;
use App\Formatter\WorkContractFormatter;

// TODO build a factory to avoid copy pasting same code in every Form controller
class WorkContractController
{
    public function workContractPage(): View
    {
        $form = new WorkContractForm();
        $formatter = new WorkContractFormatter($form);
        return view('pages.work-contract', ['form' => $form, 'formatter' => $formatter]);
    }

    public function workContractStep(Request $request, string $slug)
    {
        $form = new WorkContractForm($slug);
        $form->loadFromSession($request);

        if ($form->getCurrentStep()->validate($request)->hasError)
        {
            return view('helpers.form', ['form' => $form]);
        }

        $form->saveInSession($request);

        if ($form->nextStep())
        {
            $formatter = new WorkContractFormatter($form);

            $formView = view('helpers.form', ['form' => $form, 'class' => 'next'])->render();
            $stepperView = view('pages.partials.stepper', ['form' => $form, 'oob' => true])->render();
            $formatterView = view('previews.work-contract', ['formatter' => $formatter, 'oob' => true])->render();
            return "$stepperView $formView $formatterView";
        }

        // TODO store form values from session into database

        $form->clearSession($request);

        return "<h1>Success</h1>";
    }

    public function workContractPreviousStep(Request $request, string $slug)
    {
        $form = new WorkContractForm($slug);
        $form->loadFromSession($request);

        if ($form->hasPreviousStep())
        {
            $form->previousStep();
        }

        $formatter = new WorkContractFormatter($form);

        $formView = view('helpers.form', ['form' => $form, 'class' => 'previous'])->render();
        $stepperView = view('pages.partials.stepper', ['form' => $form, 'oob' => true])->render();
        $formatterView = view('previews.work-contract', ['formatter' => $formatter, 'oob' => true])->render();
        return "$stepperView $formView $formatterView";
    }
}
