<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WELCOME TO RUST [SEA] BEGINNERS VANILLA-DUO/TRIO SERVER ADMIN') }}
            
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <h1 class="text-2xl text-black font-bold mb-6 text-center">Registered Users</h1>

        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-gray-600">Name</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600">Email</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600">Date Signed Up</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 text-black border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 text-black border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 text-black border-b">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="py-2 px-4 text-black border-b">
                                <a href="{{ route('admin.users.dashboard', $user->id) }}" class="action-link">View</a>
                                <br>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="action-link">Edit</a>
                                <br>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-link text-red-500 hover:text-red-700 transition duration-150">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        /* Custom styles for table and links */
        .action-link {
            color: #3b82f6; /* Tailwind's blue-500 */
            transition: color 0.3s ease;
            font-weight: 600; /* Bold text */
        }
        .action-link:hover {
            color: #2563eb; /* Tailwind's blue-700 */
        }
    </style>
</x-app-layout>
