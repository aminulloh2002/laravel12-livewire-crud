<div>
    <flux:modal name="edit-note" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Note</flux:heading>
                <flux:text class="mt-2">Update notes for your personal use.</flux:text>
            </div>

            <flux:input wire:model.live.blur="title" label="title" placeholder="Title..."/>

            <flux:textarea wire:model.live.blur="content" label="content" placeholder="Content..."/>

            <div class="flex">
                <flux:spacer/>

                <flux:button wire:click="save" type="submit" variant="primary" class="cursor-pointer">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
