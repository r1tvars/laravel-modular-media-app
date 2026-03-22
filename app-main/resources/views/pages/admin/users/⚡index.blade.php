<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('components.layouts.app')] class extends Component {
    public function with(): array
    {
        return [
            'users' => User::latest()->get(),
        ];
    }
};
?>

<div class="space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Users</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Manage application users and review account access.</p>
        </div>

        <div class="rounded-2xl border border-zinc-200 bg-white px-4 py-3 text-sm shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            <div class="text-zinc-500 dark:text-zinc-400">Total accounts</div>
            <div class="mt-1 text-xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $users->count() }}</div>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-950/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-300">Name</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-300">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-300">Role</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-300">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 bg-white dark:divide-zinc-800 dark:bg-zinc-900">
                    @forelse ($users as $user)
                        <tr class="align-top">
                            <td class="px-4 py-4 text-sm text-zinc-900 dark:text-zinc-100">
                                <div class="font-medium">{{ $user->name }}</div>
                            </td>
                            <td class="px-4 py-4 text-sm text-zinc-600 dark:text-zinc-400">{{ $user->email }}</td>
                            <td class="px-4 py-4 text-sm">
                                <span class="inline-flex rounded-full border border-zinc-200 px-2.5 py-1 text-xs font-medium capitalize text-zinc-700 dark:border-zinc-700 dark:text-zinc-300">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-zinc-600 dark:text-zinc-400">{{ $user->created_at?->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-sm text-zinc-500 dark:text-zinc-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
