<?php

namespace App\Observers;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityObserver
{
    public function created($model)
    {
        if (!Auth::check()) return;

        Activity::create([
            'user_name' => Auth::user()->name,
            'action' => 'menambahkan ' . class_basename($model)
        ]);
    }

    public function updated($model)
    {
        if (!Auth::check()) return;

        Activity::create([
            'user_name' => Auth::user()->name,
            'action' => 'mengubah ' . class_basename($model)
        ]);
    }
}

