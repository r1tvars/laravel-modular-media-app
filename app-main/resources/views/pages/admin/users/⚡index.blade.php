<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('components.layouts.app')] class extends Component {
    public function deleteUser(int $userId): void
    {
        $user = User::findOrFail($userId);

        if (auth()->id() === $user->id) {
            $this->dispatch('notify', message: 'You cannot delete your own account.');
            return;
        }

        $user->delete();

        $this->dispatch('notify', message: 'User deleted successfully.');
    }

    public function with(): array
    {
        return [
            'users' => User::latest()->get(),
        ];
    }
};
?>

<div class="mx-auto space-y-6">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Users</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Manage application users and their roles.
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}" wire:navigate class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white dark:bg-white dark:text-zinc-900">
            Create user
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
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Name</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Role</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">Created</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-zinc-700 dark:text-zinc-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-4 py-3 text-sm text-zinc-900 dark:text-zinc-100">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300 capitalize">{{ $user->role }}</td>
                            <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">{{ $user->created_at?->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" wire:navigate class="inline-flex items-center rounded-lg border border-zinc-300 px-3 py-1.5 text-sm text-zinc-700 dark:border-zinc-600 dark:text-zinc-200">
                                        Edit
                                    </a>

                                    @if (auth()->id() !== $user->id)
                                        <button type="button" wire:click="deleteUser({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?" class="inline-flex items-center rounded-lg border border-red-300 px-3 py-1.5 text-sm text-red-700 dark:border-red-800 dark:text-red-300">
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-sm text-zinc-500 dark:text-zinc-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>