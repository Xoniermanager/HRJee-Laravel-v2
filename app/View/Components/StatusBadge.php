<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatusBadge extends Component
{
    public $status, $text;

    /**
     * Create a new component instance.
     *
     * @param string $status
     */
    public function __construct($status, $text)
    {
        $this->status = strtolower($status);
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.status-badge');
    }
}
