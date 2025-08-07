<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Notes') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage your notes') }}</flux:subheading>
    <flux:separator variant="subtle"/>

    <flux:modal.trigger name="create-note">
        <flux:button class="mt-10">Create Note</flux:button>
    </flux:modal.trigger>

    @session('success')
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => {show = false }, 3000)"
        class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50"
        role="alert"
    >
        <p>{{$value}}</p>
    </div>
    @endsession

    <livewire:create-note/>
    <livewire:edit-note/>
    <livewire:delete-note/>

    <div class="overflow-x-auto">

        <table class="table-auto w-full min-w-max  bg-gray-100 dark:bg-neutral-800  shadow-md rounded-md mt-5">
            <thead class="bg-gray-200 dark:bg-neutral-900">
            <tr>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Content</th>
                <th class="px-4 py-2 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($notes as $note)
                <tr class="border-b dark:border-b-neutral-900">
                    <td class="px-4 py-2 text-nowrap">{{ $note->title }}</td>
                    <td class="px-4 py-2">{{ $note->content }}</td>
                    <td class="px-4 py-2 text-center">
                        <flux:button size="sm" wire:click="edit({{ $note->id }})" variant="primary"
                                     class="m-2 cursor-pointer">Edit
                        </flux:button>
                        <flux:button size="sm" wire:click="delete({{ $note->id }})" variant="danger"
                                     class="cursor-pointer">Delete
                        </flux:button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-center">No notes available.</td>
            @endforelse
            </tbody>
        </table>

    </div>
    <div class="mt-4">
        {{ $notes->links() }}
    </div>


</div>
