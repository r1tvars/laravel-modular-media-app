<x-layouts.app>
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-semibold">Catalog</h1>
            <p class="text-sm text-gray-600">
                Media items available in the platform catalog.
            </p>
        </div>

        <div class="overflow-hidden rounded-xl border bg-white">
            @if($items->isEmpty())
                <div class="p-4 text-sm text-gray-600">
                    No catalog items found.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Title</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Genre</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Release date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Publication</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Availability</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Notification</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($items as $item)
                                <tr>
                                    <td class="px-4 py-3 align-top">
                                        <div class="font-medium text-gray-900">{{ $item->title }}</div>

                                        @if($item->description)
                                            <div class="mt-1 text-sm text-gray-500">
                                                {{ $item->description }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item->genre ?? '—' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item->release_date?->format('Y-m-d') ?? '—' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item->publication_status }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item->availability_status }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item->notification_label ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>