<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component {
    //
}; ?>

<section class="w-full space-y-6">
    @include('partials.settings-heading')

    <x-settings.layout heading="Appearance" subheading="Update your account's appearance settings">
        <div class="space-y-4">
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Choose how the interface should look on this device.
            </p>

            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance" class="w-full max-sm:flex max-sm:flex-col">
                <flux:radio value="light" icon="sun">Light</flux:radio>
                <flux:radio value="dark" icon="moon">Dark</flux:radio>
                <flux:radio value="system" icon="computer-desktop">System</flux:radio>
            </flux:radio.group>
        </div>
    </x-settings.layout>
</section>
