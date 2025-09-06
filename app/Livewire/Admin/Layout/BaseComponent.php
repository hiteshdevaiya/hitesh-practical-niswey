<?php

namespace App\Livewire\Admin\Layout;

use App\Traits\WithSearch;
use App\Traits\WithSort;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.admin.layout.app')]
class BaseComponent extends Component
{
    use WithSearch, WithSort;
}
