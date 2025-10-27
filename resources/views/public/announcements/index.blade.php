<x-guest-layout>

    <!-- ✅ Login/Signup Links -->
    <img src="{{ asset('images/fcfmt-logo.png') }}" alt="FCFMT Logo" class="w-20 mx-auto mb-4 shadow-md rounded-lg">
    <div class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-end space-x-4 text-sm">
            @auth
                <a href="{{ route('dashboard') }}" class="text-blue-900 font-semibold hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-900 font-semibold hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-blue-900 font-semibold hover:underline">Sign Up</a>
            @endauth
        </div>
    </div>

    <!-- Existing announcement UI starts here -->

    <div class="max-w-6xl mx-auto mt-10 px-4">
        <h1 class="text-4xl font-bold text-center mb-10 text-blue-900">
            📢 Announcements Board
        </h1>
        

        <!-- 🔍 Search & Category Filter -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm mb-8">
            <form method="GET" action="{{ route('public.announcements') }}" class="flex flex-col sm:flex-row flex-wrap gap-4 items-center">
                <input type="text" name="search" placeholder="Search announcements..."
                       value="{{ request('search') }}"
                       class="w-full sm:w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">

                <select name="category"
                        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="bg-blue-800 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Filter
                </button>
            </form>
        </div>

        <!-- 📄 Announcement Cards -->
        @forelse ($announcements as $announcement)
            <div class="bg-white shadow-md rounded-lg p-6 mb-6 border-l-4 border-blue-800">
                <h2 class="text-2xl font-bold text-gray-800 mb-2 hover:underline">
                    <a href="{{ route('public.announcements.show', $announcement->id) }}">
                        {{ $announcement->title }}
                    </a>
                </h2>

                <p class="text-gray-700 mb-4 leading-relaxed">
                    {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 200) }}
                </p>

                <div class="flex justify-between text-sm text-gray-600">
                    <div>
                        📂 <span class="font-medium">{{ $announcement->category->name ?? 'Uncategorized' }}</span>
                    </div>
                    <div>
                        🗓️ <span>{{ $announcement->created_at->format('F j, Y') }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-10">
                No announcements found.
            </div>
        @endforelse

        <!-- 📑 Pagination -->
        <div class="mt-8">
            {{ $announcements->withQueryString()->links() }}
        </div>
    </div>
</x-guest-layout>
