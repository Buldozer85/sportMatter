<?php

namespace App\Livewire\App;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddFavoriteMatch extends Component
{
    public string $match;

    public function mount(string $match): void
    {
        $this->match = $match;

    }
    public function render()
    {
        return view('livewire.app.add-favorite-match');
    }

    public function add(): void
    {
        if(!Auth::check()) {
            return;
        }

        if(!user()->favoriteMatches()->where('match_id', $this->match)->exists()) {
            user()->favoriteMatches()->attach($this->match);
            return;
        }

        user()->favoriteMatches()->detach($this->match);
    }
}
