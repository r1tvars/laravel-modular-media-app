<x-layouts.app>
    <div class="mx-auto space-y-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Campaign Notifications</h1>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Manage promotional and informational campaigns for users.
                </p>
            </div>

            <a href="{{ route('campaigns.create') }}" class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white dark:bg-white dark:text-zinc-900">
                Create campaign
            </a>
        </div>

        @if (session('success'))
            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-900 dark:bg-green-950/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-900/60">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Title</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Type</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Catalog item</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Audience</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Send at</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($campaigns as $campaign)
                            <tr>
                                <td class="px-4 py-3 align-top">
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $campaign->title }}
                                    </div>
                                    <div class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
                                        {{ $campaign->message }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $campaign->campaign_type?->label() ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $campaign->catalogItem?->title ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $campaign->audience_type?->label() ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $campaign->status?->label() ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $campaign->send_at?->format('Y-m-d H:i') ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-sm text-zinc-500 dark:text-zinc-400">
                                    No campaigns found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>