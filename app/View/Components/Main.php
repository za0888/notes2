<?php

namespace App\View\Components;

use App\Models\Team;
use App\Models\User;
use Illuminate\View\Component;

class Main extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public User $user, public $team=null)
    {
        if (\Auth::user()) {
            $this->user = \Auth::user();
            $this->team=Team::find($this->user->team_id);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.main');
    }
}
