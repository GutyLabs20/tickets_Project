<?php

namespace App\Http\Livewire\Entidad;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ToggleButton extends Component
{
    public Model $model;
    public string $field;

    public bool $isActive;

    public string $designTemplate = 'bootstrap';

    public function mount()
    {
        $this->isActive = (bool) $this->model->getAttribute($this->field);
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
    }

    public function render()
    {
        return view('livewire.entidad.'.$this->designTemplate.'.toggle-button');
    }
}
