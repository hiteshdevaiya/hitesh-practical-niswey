<?php

namespace App\Livewire\Admin\Dashboard;

use App\Livewire\Admin\Layout\BaseComponent;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class Dashboard extends BaseComponent
{
    public string $activeTab = 'weekly';
    public $custom_range;

    public string $contactsCount = '0';


    public function mount()
    {
        $this->updateTab($this->activeTab);
    }

    public function updateTab(string $tab): void
    {
        $this->activeTab = $tab;

        match ($tab) {
            'weekly' => $this->loadWeeklyStats(),
            'monthly' => $this->loadMonthlyStats(),
            'yearly' => $this->loadYearlyStats(),
            'custom' => $this->loadCustomStats(),
            default => null,
        };
    }

    protected function getDateRange($start, $end)
    {
        $this->contactsCount = 0;
    }

    protected function loadWeeklyStats()
    {
        $start = now()->startOfWeek();
        $end = now()->endOfWeek();
        $this->getDateRange($start, $end);
    }

    protected function loadMonthlyStats()
    {
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();
        $this->getDateRange($start, $end);
    }

    protected function loadYearlyStats()
    {
        $start = now()->startOfYear();
        $end = now()->endOfYear();
        $this->getDateRange($start, $end);
    }

    protected function loadCustomStats()
    {
        [$start, $end] = explode(' to ', $this->custom_range . ' to ');

        if (empty(trim($start))) {
            return;
        }

        try {
            $startDate = Carbon::createFromFormat('d/m/Y', trim($start))->startOfDay();

            $endDate = $end
                ? Carbon::createFromFormat('d/m/Y', trim($end))->endOfDay()
                : Carbon::createFromFormat('d/m/Y', trim($start))->endOfDay();
        } catch (\Exception $e) {
            $startDate = $endDate = now();
        }

        $this->getDateRange($startDate, $endDate);
    }

    public function render()
    {
        $admin = Auth::guard('admin')->user();

        return view('livewire.admin.dashboard.dashboard', [
            'admin' => $admin,
            'contacts' => $this->contactsCount,
        ]);
    }
}
