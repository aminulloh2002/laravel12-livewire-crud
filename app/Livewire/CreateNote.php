<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateNote extends Component
{
    public string $title;
    public string $content;

    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('notes', 'title'),
            ],
            'content' => [
                'required',
                'string',
                'min:3',
                'max:1000',
            ],
        ];
    }

//    reactive validation
// change the wire:model to wire:model.live / blur / debounce
    public function updated($property, $value): void
    {
        $this->validateOnly($property);
    }

    public function save(): void
    {
        $this->validate();

        Note::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->reset(['title', 'content']);
        Flux::modal('create-note')->close();

        session()->flash('success', 'Note created successfully!');

//        so the new note is visible in the notes list
//        usually you would use an event to notify the parent component in livewire 2
        $this->redirectRoute('notes', navigate: true);
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.create-note');
    }
}
