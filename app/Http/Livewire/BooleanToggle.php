<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class BooleanToggle extends Component
{
    public Model $model;

    public string $field;

    public ?string $componentClassToRefresh;

    public function toggle(): void
    {
        $this->model->update([$this->field => ! $this->model->{$this->field}]);
        $this->dispatchBrowserEvent('toast:success', ['title' => __('Line #' . $this->model->id . ' updated.')]);
        if($this->componentClassToRefresh) {
            $this->emitUp('refreshComponent', $this->componentClassToRefresh);
        }
    }

    public function mount(Model $model, string $field, ?string $componentClassToRefresh = null): void
    {
        $this->model = $model;
        $this->field = $field;
        $this->componentClassToRefresh = $componentClassToRefresh;
    }

    public function render(): View
    {
        return view('livewire.boolean-toggle');
    }
}
