<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public function edit(int $id): void
    {
        $this->dispatch('edit-note', $id);
    }

    public function delete(int $id): void
    {
        $this->dispatch('delete-note', $id);
    }

    public function render(): \Illuminate\View\View
    {
        $notes = Note::orderByDesc('created_at')->paginate(5);
        return view('livewire.notes', compact('notes'));
    }
}
