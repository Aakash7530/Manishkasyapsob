@extends('layouts.app')

@section('title', 'Journalism & Articles - Manish Kashyap')

@section('content')
<!-- Blog Hero Image -->
<div class="relative w-full h-64 md:h-80 overflow-hidden bg-charcoal-900">
    <img src="/images/blog.jpg" class="w-full h-full object-cover opacity-80" style="object-position: center 25%;" alt="Journalism">
    <div class="absolute inset-0 flex items-center justify-center bg-black/30">
        <h1 class="text-4xl md:text-5xl font-display font-bold text-white drop-shadow-lg">Journalism & News</h1>
    </div>
</div>

<!-- Search & Filter Header -->
<div class="bg-white dark:bg-charcoal-800 border-b border-offwhite-200 dark:border-charcoal-700 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="hidden md:block"></div> <!-- spacer -->
            
            <form action="{{ route('blog.index') }}" method="GET" class="w-full md:w-96 flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..." class="w-full rounded-l-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 rounded-r-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>
        
        <!-- Category Pills -->
        <div class="flex flex-wrap gap-2 mt-6">
            <a href="{{ route('blog.index') }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ !request('category') ? 'bg-gray-900 text-white dark:bg-white dark:text-gray-900' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">All</a>
            @foreach($categories as $category)
                <a href="{{ route('blog.index', ['category' => $category->name]) }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ request('category') == $category->name ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(request('search'))
        <div class="mb-8 text-lg text-gray-600 dark:text-gray-400">
            Showing results for: <span class="font-bold text-gray-900 dark:text-white">"{{ request('search') }}"</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <article class="card-glass flex flex-col overflow-hidden group">
            <div class="relative h-52 overflow-hidden bg-gray-200 dark:bg-gray-800">
                <img src="{{ $post->featured_image ? Storage::url($post->featured_image) : ($post->image_url ?? 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?w=600') }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute top-4 left-4">
                    <span class="bg-white/90 dark:bg-gray-900/90 backdrop-blur text-primary-600 dark:text-primary-400 text-xs font-bold px-3 py-1 rounded-full">{{ $post->category_name ?? 'News' }}</span>
                </div>
            </div>
            <div class="p-6 flex-grow flex flex-col">
                <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white leading-tight">
                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-primary-600 transition">{{ $post->title }}</a>
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-4 flex-grow">
                    {{ $post->excerpt }}
                </p>
                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-500 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                    <span>{{ $post->reading_time }} min read</span>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20">
            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            <h3 class="text-xl font-medium text-gray-900 dark:text-white">No articles found</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Try adjusting your search or filter criteria.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</div>
@endsection
