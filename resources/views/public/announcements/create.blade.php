<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Create New Announcement</h2>

        <form method="POST" action="{{ route('announcements.store') }}">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded" required>
            </div>

            <!-- Content -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Content</label>
                <textarea name="content" rows="6" class="w-full border px-3 py-2 rounded" required></textarea>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Category</label>
                <select name="category_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select a Category</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
                    Publish Announcement
                </button>
            </div>
        </form>
    </div>
</x-app-layout>