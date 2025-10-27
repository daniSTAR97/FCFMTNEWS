<x-guest-layout>
    <div class="max-w-4xl mx-auto mt-10 px-4">
        <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-blue-900">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $announcement->title }}</h1>
            <div class="text-sm text-gray-500 mb-4">
                📂 {{ $announcement->category->name ?? 'Uncategorized' }} | 🗓️ {{ $announcement->created_at->format('M d, Y') }}
            </div>
            <div class="text-gray-700 leading-relaxed">
                {!! nl2br(e($announcement->content)) !!}
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('public.announcements') }}" class="text-blue-700 hover:underline">← Back to announcements</a>
        </div>
    </div>
</x-guest-layout>
