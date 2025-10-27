@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Announcement</h1>

    <form action="{{ route('announcements.update', $announcement) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $announcement->title }}" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == $announcement->category_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" rows="5" class="form-control" required>{{ $announcement->content }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
