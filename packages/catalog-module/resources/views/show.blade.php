<x-layouts.app>
    <div class="mx-auto max-w-6xl space-y-6 p-6 lg:p-8">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-zinc-900 dark:text-zinc-100">
                    {{ $item->title }}
                </h1>

                <div class="mt-2 flex flex-wrap items-center gap-2">
                    @if($item->genre)
                        <flux:badge size="sm" color="sky">{{ $item->genre }}</flux:badge>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-2">
                <flux:button :href="route('catalog.edit', $item)" icon="pencil-square">
                    Edit
                </flux:button>

                <flux:button :href="route('catalog.index')" variant="subtle" icon="arrow-left">
                    Back
                </flux:button>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[260px_minmax(0,1fr)] xl:grid-cols-[300px_minmax(0,1fr)]">
            <flux:card class="self-start overflow-hidden p-0">
                @if ($item->poster_path)
                    <img
                        src="{{ $item->poster_path }}"
                        alt="{{ $item->title }} poster"
                        class="aspect-[2/3] w-full object-cover"
                    >
                @else
                    <div class="flex aspect-[2/3] w-full items-center justify-center bg-zinc-100 text-sm text-zinc-500 dark:bg-zinc-900 dark:text-zinc-400">
                        No poster available
                    </div>
                @endif
            </flux:card>

            <div class="space-y-6 min-w-0">
                <flux:card class="space-y-4">
                    <div>
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Overview</h2>
                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-300">
                            {{ $item->description ?: 'No description available.' }}
                        </p>
                    </div>
                </flux:card>

                <div class="grid gap-6 md:grid-cols-2">
                    <flux:card class="space-y-4">
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Details</h2>

                        <dl class="space-y-3">
                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Release date</dt>
                                <dd class="text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->release_date?->format('Y-m-d') ?? '—' }}
                                </dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Genre</dt>
                                <dd class="text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->genre ?: '—' }}
                                </dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Publication</dt>
                                <dd class="text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->publication_status?->label() ?? '—' }}
                                </dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Availability</dt>
                                <dd class="text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->availability_status?->label() ?? '—' }}
                                </dd>
                            </div>
                        </dl>
                    </flux:card>

                    <flux:card class="space-y-4">
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Metadata</h2>

                        <dl class="space-y-3">
                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Notification label</dt>
                                <dd class="text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->notification_label ?: '—' }}
                                </dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Poster path</dt>
                                <dd class="max-w-[16rem] break-all text-right text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->poster_path ?: '—' }}
                                </dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Created</dt>
                                <dd class="text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->created_at?->format('Y-m-d H:i') ?? '—' }}
                                </dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Updated</dt>
                                <dd class="text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->updated_at?->format('Y-m-d H:i') ?? '—' }}
                                </dd>
                            </div>
                        </dl>
                    </flux:card>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>