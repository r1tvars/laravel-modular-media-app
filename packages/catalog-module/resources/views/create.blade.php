<x-layouts.app>
    <div class="mx-auto max-w-3xl space-y-6 p-6 lg:p-8">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Add Catalog Item</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Create a new media item in the catalog.
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

        <form method="POST" action="{{ route('catalog.store') }}" class="space-y-6 rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
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
                    <label for="description" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                    >{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="release_date" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Release Date</label>
                    <input
                        id="release_date"
                        name="release_date"
                        type="date"
                        value="{{ old('release_date') }}"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                    >
                </div>

                <div>
                    <label for="genre" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Genre</label>
                    <input
                        id="genre"
                        name="genre"
                        type="text"
                        value="{{ old('genre') }}"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                    >
                </div>

                <div>
                    <label for="publication_status" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Publication Status</label>
                    <select
                        id="publication_status"
                        name="publication_status"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                        required
                    >
                        <option value="draft" @selected(old('publication_status') === 'draft')>Draft</option>
                        <option value="published" @selected(old('publication_status') === 'published')>Published</option>
                        <option value="archived" @selected(old('publication_status') === 'archived')>Archived</option>
                    </select>
                </div>

                <div>
                    <label for="availability_status" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Availability Status</label>
                    <select
                        id="availability_status"
                        name="availability_status"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                        required
                    >
                        <option value="inactive" @selected(old('availability_status') === 'inactive')>Inactive</option>
                        <option value="active" @selected(old('availability_status') === 'active')>Active</option>
                        <option value="coming_soon" @selected(old('availability_status') === 'coming_soon')>Coming soon</option>
                        <option value="leaving_soon" @selected(old('availability_status') === 'leaving_soon')>Leaving soon</option>
                    </select>
                </div>

                <div>
                    <label for="poster_path" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Poster Path</label>
                    <input
                        id="poster_path"
                        name="poster_path"
                        type="text"
                        value="{{ old('poster_path') }}"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                    >
                </div>

                <div>
                    <label for="notification_label" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Notification Label</label>
                    <input
                        id="notification_label"
                        name="notification_label"
                        type="text"
                        value="{{ old('notification_label') }}"
                        placeholder="e.g. Coming soon"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                    >
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white dark:bg-white dark:text-zinc-900"
                >
                    Save item
                </button>

                <a href="{{ route('catalog.index') }}" class="text-sm text-zinc-600 dark:text-zinc-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>