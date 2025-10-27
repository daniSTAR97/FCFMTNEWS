<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <img src="{{ asset('images/fcfmt-logo.png') }}" alt="FCFMT Logo" class="w-20 mx-auto mb-4 shadow-md rounded-lg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- ✅ STATISTICS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-blue-100 p-6 rounded-xl shadow">
                    <p class="text-sm text-gray-500">Total Users</p>
                    <h3 class="text-3xl font-bold">{{ $totalUsers ?? 0 }}</h3>
                </div>
                <div class="bg-green-100 p-6 rounded-xl shadow">
                    <p class="text-sm text-gray-500">Announcements</p>
                    <h3 class="text-3xl font-bold">{{ $totalAnnouncements ?? 0 }}</h3>
                </div>
                <div class="bg-yellow-100 p-6 rounded-xl shadow">
                    <p class="text-sm text-gray-500">Events</p>
                    <h3 class="text-3xl font-bold">{{ $totalEvents ?? 0 }}</h3>
                </div>
                <div class="bg-purple-100 p-6 rounded-xl shadow">
                    <p class="text-sm text-gray-500">News</p>
                    <h3 class="text-3xl font-bold">{{ $totalNews ?? 0 }}</h3>
                </div>
            </div>

            {{-- ✅ RECENT ANNOUNCEMENTS --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-lg font-semibold mb-4">Recent Announcements</h4>
                <ul>
                    @forelse($recentAnnouncements ?? [] as $announcement)
                        <li class="border-b py-2 flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $announcement->title }}</p>
                                <p class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="space-x-2">
                                <a href="{{ route('public.announcements.show', $announcement->id) }}" class="text-blue-600 text-sm">View</a>
                            </div>
                        </li>
                    @empty
                        <p class="text-gray-500">No recent announcements.</p>
                    @endforelse
                </ul>
            </div>

            {{-- ✅ QUICK ACTIONS --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-lg font-semibold mb-4">Quick Actions</h4>
                <div class="space-x-4">
                    <a href="{{ route('announcements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Announcement</a>
                    <a href="#" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Manage Events</a>
                    <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Post News</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>