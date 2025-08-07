<flux:modal name="delete-note" class="min-w-[22rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete note?</flux:heading>

            <flux:text class="mt-2">
                <p>This action cannot be reversed.</p>
            </flux:text>
        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>

            <flux:button type="submit" variant="danger" wire:click="confirmDelete">Delete</flux:button>
        </div>
    </div>
</flux:modal>
