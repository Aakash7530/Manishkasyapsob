@extends('layouts.admin')

@section('header', 'Manage Comments')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-900">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Article</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($comments as $comment)
            <tr>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $comment->name }} ({{ $comment->email }})</div>
                    <div class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $comment->content }}</div>
                    <div class="text-xs text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                </td>
                <td class="px-6 py-4">
                    @if($comment->post)
                    <a href="{{ route('blog.show', $comment->post->slug) }}" target="_blank" class="text-sm text-primary-600 hover:underline">
                        {{ Str::limit($comment->post->title, 40) }}
                    </a>
                    @else
                    <span class="text-sm text-gray-500">Post deleted</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('admin.comments.update', $comment->_id) }}" method="POST">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="text-sm rounded-full px-2 py-1 border-0 ring-1 ring-inset {{ $comment->status == 'approved' ? 'bg-green-50 text-green-700 ring-green-600/20' : ($comment->status == 'rejected' ? 'bg-red-50 text-red-700 ring-red-600/20' : 'bg-yellow-50 text-yellow-800 ring-yellow-600/20') }}">
                            <option value="pending" {{ $comment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $comment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $comment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="{{ route('admin.comments.destroy', $comment->_id) }}" method="POST" onsubmit="return confirm('Delete comment?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        {{ $comments->links() }}
    </div>
</div>
@endsection
