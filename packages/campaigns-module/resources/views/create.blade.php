<x-layouts.app>
    <div class="mx-auto max-w-3xl space-y-6 p-6 lg:p-8">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Create Campaign Notification</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Create a campaign linked to a catalog item or a general announcement.
            </p>
        </div>

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900 dark:bg-red-950/30 dark:text-red-300">
                <div class="font-medium">Please fix the following errors:</div>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('campaigns.store') }}" class="space-y-6 rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="title" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Title</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title') }}"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                        required
                    >
                </div>

                <div class="md:col-span-2">
                    <label for="message" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Message</label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                        required
                    >{{ old('message') }}</textarea>
                </div>

                <div>
                    <label for="campaign_type" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Campaign Type</label>
                    <select
                        id="campaign_type"
                        name="campaign_type"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                        required
                    >
                        <option value="general" @selected(old('campaign_type', 'general') === 'general')>General</option>
                        <option value="catalog_item" @selected(old('campaign_type', 'general') === 'catalog_item')>Catalog item</option>
                    </select>
                </div>

                <div>
                    <label for="catalog_item_id" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Catalog Item</label>
                    <select
                        id="catalog_item_id"
                        name="catalog_item_id"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                    >
                        <option value="">None</option>
                        @foreach ($catalogItems as $catalogItem)
                            <option value="{{ $catalogItem->id }}" @selected((string) old('catalog_item_id') === (string) $catalogItem->id)>
                                {{ $catalogItem->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="audience_type" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Audience Type</label>
                    <select
                        id="audience_type"
                        name="audience_type"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                        required
                    >
                        <option value="all_users" @selected(old('audience_type', 'all_users') === 'all_users')>All users</option>
                        <option value="selected_users" @selected(old('audience_type', 'all_users') === 'selected_users')>Selected users</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Status</label>
                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                        required
                    >
                        <option value="draft" @selected(old('status', 'draft') === 'draft')>Draft</option>
                        <option value="scheduled" @selected(old('status', 'draft') === 'scheduled')>Scheduled</option>
                        <option value="sent" @selected(old('status', 'draft') === 'sent')>Sent</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="send_at" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Send At</label>
                    <input
                        id="send_at"
                        name="send_at"
                        type="datetime-local"
                        value="{{ old('send_at') }}"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                    >
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white dark:bg-white dark:text-zinc-900"
                >
                    Save campaign
                </button>

                <a href="{{ route('campaigns.index') }}" class="text-sm text-zinc-600 dark:text-zinc-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>