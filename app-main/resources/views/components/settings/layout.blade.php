<div class="grid gap-6 lg:grid-cols-[260px_minmax(0,1fr)] lg:items-start">
    <aside class="lg:sticky lg:top-6">
        <div class="rounded-3xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            <div class="mb-4">
                <div class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Preferences</div>
                <div class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Profile, security, and display settings.</div>
            </div>

            <flux:navlist>
                <flux:navlist.item href="{{ route('settings.profile') }}" :current="request()->routeIs('settings.profile')" wire:navigate>Profile</flux:navlist.item>
                <flux:navlist.item href="{{ route('settings.password') }}" :current="request()->routeIs('settings.password')" wire:navigate>Password</flux:navlist.item>
                <flux:navlist.item href="{{ route('settings.appearance') }}" :current="request()->routeIs('settings.appearance')" wire:navigate>Appearance</flux:navlist.item>
            </flux:navlist>
        </div>
    </aside>

    <div class="min-w-0">
        <div class="rounded-3xl border border-zinc-200 bg-white p-5 shadow-sm sm:p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:heading>{{ $heading ?? '' }}</flux:heading>
            <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

            <div class="mt-6 w-full max-w-3xl">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
