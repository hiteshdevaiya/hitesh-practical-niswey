<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Notification extends Component
{
    public $message;
    public $type;
    public $show = false;

    public function mount()
    {
        if (session()->has('success')) {
            $this->message = session('success');
            $this->type = 'success';
            $this->show = true;
        }
    }

    public function dismiss()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.components.notification');
    }
}