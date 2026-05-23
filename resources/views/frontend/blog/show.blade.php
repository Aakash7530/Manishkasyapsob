@extends('layouts.app')

@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description)
@section('meta_keywords', $post->meta_keywords)

@section('content')
<article class="bg-white dark:bg-dark-bg min-h-screen pb-20">
    <!-- Post Header Image -->
    <div class="w-full h-[50vh] md:h-[60vh] relative bg-gray-900">
        <img src="{{ $post->featured_image ? Storage::url($post->featured_image) : ($post->image_url ?? 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?w=1600') }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-t from-dark-bg via-dark-bg/60 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full p-6 md:p-12">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-block bg-primary-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4">{{ $post->category_name ?? 'News' }}</span>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-display font-bold text-white leading-tight mb-6">
                    {{ $post->title }}
                </h1>
                <div class="flex flex-wrap justify-center items-center gap-4 text-sm text-gray-300">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ $post->author_name ?? 'Editorial Team' }}
                    </span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $post->created_at->format('F d, Y') }}
                    </span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        {{ $post->reading_time }} min read
                    </span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        {{ number_format($post->view_count) }} views
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100 dark:border-gray-800">
            <!-- Share Buttons -->
            <div class="flex flex-wrap items-center gap-4 mb-8 pb-8 border-b border-gray-100 dark:border-gray-800">
                <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Share:</span>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white flex items-center justify-center transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-700 hover:bg-blue-700 hover:text-white flex items-center justify-center transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-green-50 text-green-500 hover:bg-green-500 hover:text-white flex items-center justify-center transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.88-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>
                
                <div class="relative flex items-center ml-auto md:ml-4">
                    <button id="copyLinkBtn" class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition" onclick="copyToClipboard('{{ request()->url() }}')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        Copy Link
                    </button>
                    <span id="copyTooltip" class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs py-1 px-2 rounded opacity-0 transition-opacity duration-300 pointer-events-none">Copied!</span>
                </div>
            </div>

            <script>
                function copyToClipboard(text) {
                    navigator.clipboard.writeText(text).then(() => {
                        const tooltip = document.getElementById('copyTooltip');
                        tooltip.classList.remove('opacity-0');
                        setTimeout(() => {
                            tooltip.classList.add('opacity-0');
                        }, 2000);
                    });
                }
            </script>

            <!-- Prose Content -->
            <div class="prose prose-lg dark:prose-invert prose-primary max-w-none font-sans">
                {!! $post->content !!}
            </div>

            @if($post->tags)
            <div class="mt-10 pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-wrap gap-2">
                <span class="text-sm font-semibold text-gray-500 py-1">Tags:</span>
                @foreach($post->tags as $tag)
                    <a href="{{ route('blog.index', ['tag' => $tag]) }}" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-md text-sm transition">#{{ $tag }}</a>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Author Bio Box -->
        <div class="mt-12 bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 flex items-center gap-6">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author_name ?? 'Admin') }}&background=dc2626&color=fff" alt="" class="w-20 h-20 rounded-full shadow-md">
            <div>
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Written by {{ $post->author_name ?? 'Manish Kashyap Desk' }}</h4>
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Dedicated to bringing unfiltered journalism and ground reports directly from the heart of India.</p>
            </div>
        </div>

        <!-- Comments Section -->
        @if($post->comments_enabled)
        <div class="mt-16">
            <h3 class="text-2xl font-display font-bold text-gray-900 dark:text-white mb-8">Comments ({{ $comments->count() }})</h3>
            
            <div class="card-glass p-6 md:p-8 mb-10">
                <h4 class="font-bold text-lg mb-4 dark:text-white">Leave a Comment</h4>
                <form action="{{ route('blog.comment', $post->slug) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="name" placeholder="Name" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500">
                        <input type="email" name="email" placeholder="Email" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500">
                    </div>
                    <textarea name="content" rows="4" placeholder="Your comment..." required class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500"></textarea>
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg font-medium transition">Post Comment</button>
                </form>
            </div>

            <div class="space-y-6">
                @foreach($comments as $comment)
                <div class="flex gap-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->name) }}&background=random" class="w-12 h-12 rounded-full flex-shrink-0">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-5 flex-grow border border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-start mb-2">
                            <h5 class="font-bold text-gray-900 dark:text-white">{{ $comment->name }}</h5>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 text-sm">{{ $comment->content }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Related Posts -->
        @if($related->count() > 0)
        <div class="mt-20 pt-10 border-t border-gray-200 dark:border-gray-800">
            <h3 class="text-2xl font-display font-bold text-gray-900 dark:text-white mb-8">Related Articles</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $rel)
                <a href="{{ route('blog.show', $rel->slug) }}" class="group block">
                    <div class="h-40 rounded-lg overflow-hidden mb-3 bg-gray-200 dark:bg-gray-800">
                        <img src="{{ $rel->featured_image ? Storage::url($rel->featured_image) : ($rel->image_url ?? 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?w=600') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary-600 transition">{{ $rel->title }}</h4>
                    <span class="text-xs text-gray-500 mt-2 block">{{ $rel->created_at->format('M d, Y') }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</article>
@endsection
