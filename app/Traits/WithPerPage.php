<?php

namespace App\Traits;

trait WithPerPage
{
    public int $perPage = 10;

    public function mountWithPerPage()
    {
        $this->perPage = session('perPage', 10);
    }

    public function updatedPerPage()
    {
        session(['perPage' => $this->perPage]);
        $this->resetPage();
    }
}
