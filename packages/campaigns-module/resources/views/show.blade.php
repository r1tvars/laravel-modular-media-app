<x-layouts.app>
    <div class="mx-auto max-w-5xl space-y-6 p-6 lg:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
            <div class="space-y-3">
                <div>
                    <h1 class="text-3xl font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ $campaign->title }}
                    </h1>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        Campaign notification details.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                        {{ $campaign->campaign_type?->value === 'catalog_item'
                            ? 'bg-blue-100 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300'
                            : 'bg-zinc-100 text-zinc-700 dark:bg-zinc-700/60 dark:text-zinc-200' }}">
                        {{ $campaign->campaign_type?->label() ?? '—' }}
                    </span>

                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                        {{ $campaign->audience_type?->value === 'all_users'
                            ? 'bg-violet-100 text-violet-700 dark:bg-violet-950/40 dark:text-violet-300'
                            : 'bg-amber-100 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300' }}">
                        {{ $campaign->audience_type?->label() ?? '—' }}
                    </span>

                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                        {{ match($campaign->status?->value) {
                            'scheduled' => 'bg-blue-100 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300',
                            'sent' => 'bg-green-100 text-green-700 dark:bg-green-950/40 dark:text-green-300',
                            default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-700/60 dark:text-zinc-200',
                        } }}">
                        {{ $campaign->status?->label() ?? '—' }}
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('campaigns.edit', $campaign) }}"
                    class="inline-flex items-center rounded-lg border border-zinc-300 px-3 py-2 text-sm text-zinc-700 dark:border-zinc-600 dark:text-zinc-200"
                >
                    Edit
                </a>

                <a
                    href="{{ route('campaigns.index') }}"
                    class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white dark:bg-white dark:text-zinc-900"
                >
                    Back to campaigns
                </a>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[minmax(0,1.6fr)_minmax(280px,1fr)]">
            <div class="space-y-6">
                <div class="rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="mb-3">
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Message</h2>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            The content users will receive from this campaign.
                        </p>
                    </div>

                    <div class="rounded-xl bg-zinc-50 p-4 text-sm leading-6 text-zinc-700 dark:bg-zinc-900/60 dark:text-zinc-300">
                        {{ $campaign->message }}
                    </div>
                </div>

                @if ($campaign->catalogItem)
                    <div class="rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Linked catalog item</h2>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                This campaign is connected to a catalog entry.
                            </p>
                        </div>

                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="w-full max-w-[140px] shrink-0 overflow-hidden rounded-xl border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-900">
                                @if ($campaign->catalogItem->poster_path)
                                    <img
                                        src="{{ $campaign->catalogItem->poster_path }}"
                                        alt="{{ $campaign->catalogItem->title }} poster"
                                        class="aspect-[2/3] h-full w-full object-cover"
                                    >
                                @else
                                    <div class="flex aspect-[2/3] items-center justify-center text-xs text-zinc-500 dark:text-zinc-400">
                                        No poster
                                    </div>
                                @endif
                            </div>

                            <div class="min-w-0 flex-1 space-y-3">
                                <div>
                                    <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                                        {{ $campaign->catalogItem->title }}
                                    </h3>

                                    @if ($campaign->catalogItem->description)
                                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-300">
                                            {{ $campaign->catalogItem->description }}
                                        </p>
                                    @endif
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    @if ($campaign->catalogItem->genre)
                                        <span class="inline-flex rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-700/60 dark:text-zinc-200">
                                            {{ $campaign->catalogItem->genre }}
                                        </span>
                                    @endif

                                    @if ($campaign->catalogItem->publication_status)
                                        <span class="inline-flex rounded-full bg-sky-100 px-2.5 py-1 text-xs font-medium text-sky-700 dark:bg-sky-950/40 dark:text-sky-300">
                                            {{ $campaign->catalogItem->publication_status->label() }}
                                        </span>
                                    @endif

                                    @if ($campaign->catalogItem->availability_status)
                                        <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">
                                            {{ $campaign->catalogItem->availability_status->label() }}
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <a
                                        href="{{ route('catalog.show', $campaign->catalogItem) }}"
                                        class="inline-flex items-center rounded-lg border border-zinc-300 px-3 py-2 text-sm text-zinc-700 dark:border-zinc-600 dark:text-zinc-200"
                                    >
                                        Open catalog item
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Campaign details</h2>

                    <div class="mt-4 space-y-4">
                        <div>
                            <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Type</div>
                            <div class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $campaign->campaign_type?->label() ?? '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Audience</div>
                            <div class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $campaign->audience_type?->label() ?? '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Status</div>
                            <div class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $campaign->status?->label() ?? '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Send at</div>
                            <div class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $campaign->send_at?->format('Y-m-d H:i') ?? '—' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Metadata</h2>

                    <div class="mt-4 space-y-4">
                        <div>
                            <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Slug</div>
                            <div class="mt-1 break-all text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $campaign->slug }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Created</div>
                            <div class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $campaign->created_at?->format('Y-m-d H:i') ?? '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Updated</div>
                            <div class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $campaign->updated_at?->format('Y-m-d H:i') ?? '—' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>