<?php

use App\Http\Controllers\WorkContractController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class,'home'])->name('home');

Route::group(['prefix'=> 'work-contract'], function () {
    Route::get('/', [WorkContractController::class,'workContractPage'])->name('form.work-contract');
    Route::get('/{slug}', [WorkContractController::class,'workContractPreviousStep'])->name('form.work-contract-previous-step');
    Route::post('/{slug}', [WorkContractController::class,'workContractStep'])->name('form.work-contract-step');
});
