<x-layouts.app>
    <div class="space-y-6">
        <section class="overflow-hidden rounded-[2rem] border border-zinc-200 bg-linear-to-br from-white via-zinc-50 to-zinc-100 p-6 shadow-sm sm:p-8 dark:border-zinc-700 dark:from-zinc-900 dark:via-zinc-900 dark:to-zinc-800">
            <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_320px] xl:items-end">
                <div class="space-y-4">
                    <div class="inline-flex items-center rounded-full border border-zinc-200 bg-white/80 px-3 py-1 text-xs font-medium uppercase tracking-[0.2em] text-zinc-600 shadow-sm dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-300">
                        Control center
                    </div>

                    <div>
                        <h1 class="text-3xl font-semibold tracking-tight text-zinc-950 sm:text-4xl dark:text-zinc-50">Dashboard</h1>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if (Route::has('catalog.index'))
                            <a href="{{ route('catalog.index') }}" wire:navigate class="inline-flex items-center rounded-xl bg-zinc-950 px-4 py-2.5 text-sm font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">
                                Open catalog
                            </a>
                        @endif
                        @if (Route::has('campaigns.index'))
                            <a href="{{ route('campaigns.index') }}" wire:navigate class="inline-flex items-center rounded-xl border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 dark:border-zinc-600 dark:text-zinc-200">
                                View campaigns
                            </a>
                        @endif
                    </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-3 xl:grid-cols-1">
                    <div class="rounded-2xl border border-white/70 bg-white/80 p-4 backdrop-blur dark:border-zinc-700 dark:bg-zinc-900/80">
                        <div class="text-xs uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-400">Users</div>
                        <div class="mt-2 text-3xl font-semibold text-zinc-950 dark:text-zinc-50">{{ \App\Models\User::count() }}</div>
                    </div>

                    <div class="rounded-2xl border border-white/70 bg-white/80 p-4 backdrop-blur dark:border-zinc-700 dark:bg-zinc-900/80">
                        <div class="text-xs uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-400">Role</div>
                        <div class="mt-2 text-2xl font-semibold capitalize text-zinc-950 dark:text-zinc-50">{{ auth()->user()->role }}</div>
                    </div>
                </div>
            </div>
        </section>

        <div class="grid gap-4 xl:grid-cols-[minmax(0,1fr)_320px]">
            <div class="rounded-3xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold text-zinc-950 dark:text-zinc-50">Quick access</h2>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    Jump into the main areas of the platform.
                </p>

                <div class="mt-4 flex flex-wrap gap-3">
                    @if (Route::has('catalog.index'))
                        <a href="{{ route('catalog.index') }}" wire:navigate class="inline-flex items-center rounded-xl border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 dark:border-zinc-600 dark:text-zinc-200">
                            Catalog
                        </a>
                    @endif

                    @if (Route::has('campaigns.index'))
                        <a href="{{ route('campaigns.index') }}" wire:navigate class="inline-flex items-center rounded-xl border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 dark:border-zinc-600 dark:text-zinc-200">
                            Campaigns
                        </a>
                    @endif

                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.users') }}" wire:navigate class="inline-flex items-center rounded-xl border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 dark:border-zinc-600 dark:text-zinc-200">
                            Users
                        </a>
                    @endif

                    <a href="{{ route('settings.profile') }}" wire:navigate class="inline-flex items-center rounded-xl border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 dark:border-zinc-600 dark:text-zinc-200">
                        Settings
                    </a>
                </div>
            </div>

            <div class="rounded-3xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold text-zinc-950 dark:text-zinc-50">Overview</h2>
                <div class="mt-4 space-y-3">
                    @if (Route::has('catalog.index'))
                        <div class="rounded-2xl bg-zinc-50 p-4 dark:bg-zinc-800/60">
                            <div class="text-xs uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-400">Catalog</div>
                        </div>
                    @endif
                    @if (Route::has('campaigns.index'))
                        <div class="rounded-2xl bg-zinc-50 p-4 dark:bg-zinc-800/60">
                            <div class="text-xs uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-400">Campaigns</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
