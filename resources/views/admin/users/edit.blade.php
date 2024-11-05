<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                {{-- Include the form for updating user information --}}
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    {{-- Include the update form partial --}}
                    @include('admin.users.update-users')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
