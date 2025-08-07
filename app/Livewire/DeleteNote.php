<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteNote extends Component
{
    public Note $note;

    #[On('delete-note')]
    public function deleteNote(int $id): void
    {
        $this->note = Note::findOrFail($id);
        Flux::modal('delete-note')->show();
    }

    public function confirmDelete(): void
    {
        $this->note->delete();

        session()->flash('success', 'Note deleted successfully!');

        // Redirect to the notes list
        $this->redirectRoute('notes', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.delete-note');
    }
}
