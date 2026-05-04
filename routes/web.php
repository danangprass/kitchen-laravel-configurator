<?php

use App\Livewire\Configurator;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/configurator", Configurator::class)->name("configurator");
