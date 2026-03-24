<x-layouts.app>
    <div class="mx-auto space-y-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Catalog</h1>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Manage media items available in the platform catalog.
                </p>
            </div>

            <a href="{{ route('catalog.create') }}" class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white dark:bg-white dark:text-zinc-900">
                Add item
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
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Genre</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Release date</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Publication</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Availability</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Notification</th>
                            <th class="px-4 py-3 text-right text-sm font-medium text-zinc-700 dark:text-zinc-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($items as $item)
                            <tr>
                                <td class="px-4 py-3 align-top">
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $item->title }}
                                    </div>

                                    @if ($item->description)
                                        <div class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
                                            {{ $item->description }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->genre ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->release_date?->format('Y-m-d') ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->publication_status?->label() ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->availability_status?->label() ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                    {{ $item->notification_label ?? '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('catalog.show', $item) }}" class="inline-flex items-center rounded-lg border border-zinc-300 px-3 py-1.5 text-sm text-zinc-700 dark:border-zinc-600 dark:text-zinc-200">
                                            View
                                        </a>

                                        <a href="{{ route('catalog.edit', $item) }}" class="inline-flex items-center rounded-lg border border-zinc-300 px-3 py-1.5 text-sm text-zinc-700 dark:border-zinc-600 dark:text-zinc-200">
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('catalog.destroy', $item) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this catalog item?');"
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
                                    No catalog items found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>