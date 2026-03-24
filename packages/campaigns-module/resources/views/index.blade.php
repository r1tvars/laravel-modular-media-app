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
                            <th class="px-4 py-3 text-right text-sm font-medium text-zinc-700 dark:text-zinc-200">Actions</th>
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
                                <td class="px-4 py-3 text-sm">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                                        {{ $campaign->campaign_type?->value === 'catalog_item'
                                            ? 'bg-blue-100 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300'
                                            : 'bg-zinc-100 text-zinc-700 dark:bg-zinc-700/60 dark:text-zinc-200' }}">
                                        {{ $campaign->campaign_type?->label() ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $campaign->catalogItem?->title ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                                        {{ $campaign->audience_type?->value === 'all_users'
                                            ? 'bg-violet-100 text-violet-700 dark:bg-violet-950/40 dark:text-violet-300'
                                            : 'bg-amber-100 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300' }}">
                                        {{ $campaign->audience_type?->label() ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                                        {{ match($campaign->status?->value) {
                                            'scheduled' => 'bg-blue-100 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300',
                                            'sent' => 'bg-green-100 text-green-700 dark:bg-green-950/40 dark:text-green-300',
                                            default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-700/60 dark:text-zinc-200',
                                        } }}">
                                        {{ $campaign->status?->label() ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $campaign->send_at?->format('Y-m-d H:i') ?? '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a
                                            href="{{ route('campaigns.show', $campaign) }}"
                                            class="inline-flex items-center rounded-lg border border-zinc-300 px-3 py-1.5 text-sm text-zinc-700 dark:border-zinc-600 dark:text-zinc-200"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('campaigns.edit', $campaign) }}"
                                            class="inline-flex items-center rounded-lg border border-zinc-300 px-3 py-1.5 text-sm text-zinc-700 dark:border-zinc-600 dark:text-zinc-200"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('campaigns.destroy', $campaign) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this campaign?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center rounded-lg border border-red-300 px-3 py-1.5 text-sm text-red-700 dark:border-red-800 dark:text-red-300"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-sm text-zinc-500 dark:text-zinc-400">
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