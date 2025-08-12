<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Carbon\Carbon;
use App\Models\HrPolicy;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    // public $policy;

    public function __construct()
    {
        // $today = Carbon::now();
        // return $today;
        // return $$this->policy = HRPolicy::where('year', $today)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
