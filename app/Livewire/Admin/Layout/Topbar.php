<?php

namespace App\Livewire\Admin\Layout;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Topbar extends Component
{
    public function render()
    {
        $admin = Auth::guard('admin')->user();
        return view('livewire.admin.layout.topbar', compact('admin'));
    }
}
