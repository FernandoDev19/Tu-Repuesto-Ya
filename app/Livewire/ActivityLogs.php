<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Activity_log;

class ActivityLogs extends Component
{
    #[On('refresh')]
    public function render()
    {
        $activities = Activity_log::where('role', auth()->user()->role)->latest()->paginate(50);

        return view('livewire.activity-logs', compact('activities'));
    }
}
