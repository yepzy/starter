<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Okipa\LaravelTable\Table as LaravelTable;

class Table extends Component
{
    protected LaravelTable $table;

    protected $listeners = ['refreshComponent' => 'refreshComponent'];

    public function mount(string $tableClass): void
    {
        $this->table = app($tableClass)->setup();
    }

    public function refreshComponent(string $componentClassToRefresh): void
    {
        $this->table = app($componentClassToRefresh)->setup();
    }

    public function render(): View
    {
        return view('livewire.table', ['table' => $this->table]);
    }
}
