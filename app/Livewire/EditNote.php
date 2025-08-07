<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;

class EditNote extends Component
{
    public string $title, $content;
    public Note $note;

    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('notes', 'title')->ignore($this->note->id),
            ],
            'content' => [
                'required',
                'string',
                'min:3',
                'max:1000',
            ],
        ];
    }

    public function updated($property, $value): void
    {
        $this->validateOnly($property);
    }

    #[On('edit-note')]
    public function editNote(int $id): void
    {
        $note = Note::findOrFail($id);
        $this->note = $note;
        $this->title = $note->title;
        $this->content = $note->content;

        Flux::modal('edit-note')->show();
    }

    public function save(): void
    {
        $this->validate();

        $this->note->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->reset(['title', 'content']);

        Flux::modal('edit-note')->close();

        session()->flash('success', 'Note updated successfully!');

        // Redirect to the notes list, so the updated note is visible
        $this->redirectRoute('notes', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-note');
    }
}
