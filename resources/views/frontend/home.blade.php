@extends('layouts.app')

@section('title', 'Manish Kashyap – Fearless Journalism from Bihar, India')
@section('meta_description', 'Official website of Manish Kashyap. Independent reporter, digital media creator, and voice of Bihar.')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative text-white overflow-hidden"
         style="background: linear-gradient(135deg, #2b3035 0%, #212529 60%, #121416 100%);">
    {{-- Decorative blobs --}}
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-black/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 24px 24px;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-36 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            {{-- Text --}}
            <div class="space-y-7">
                <span class="inline-block py-1.5 px-4 rounded-full bg-white/15 border border-white/30 text-sm font-semibold tracking-widest uppercase">
                    Unfiltered Truth · Independent Voice
                </span>
                <h1 class="font-display text-5xl md:text-6xl font-bold leading-tight">
                    Revealing the<br>
                    <span class="text-yellow-300">Ground Reality</span>
                </h1>
                <p class="text-lg md:text-xl text-offwhite-200 leading-relaxed max-w-xl">
                    Manish Kashyap is an influential Indian digital media creator and reporter, widely recognized for his aggressive and grassroots style of ground reporting.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="{{ route('blog.index') }}"
                       class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-primary-700 font-bold rounded-full hover:bg-yellow-50 transition shadow-xl">
                        Read Latest News
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="https://www.youtube.com/@ManishKashyapsob" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 px-7 py-3.5 bg-white/15 hover:bg-white/25 text-white font-semibold rounded-full border border-white/30 transition">
                        <svg class="w-5 h-5 text-red-300" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        Watch on YouTube
                    </a>
                </div>
            </div>

            {{-- Profile Image --}}
            <div class="relative flex justify-center">
                <div class="relative w-72 h-72 md:w-96 md:h-96">
                    <div class="absolute inset-0 border-2 border-white/30 rounded-full animate-[spin_20s_linear_infinite]"></div>
                    <div class="absolute inset-4 border-2 border-yellow-300/40 rounded-full animate-[spin_15s_linear_infinite_reverse]"></div>
                    <div class="absolute inset-8 rounded-full overflow-hidden border-4 border-white shadow-2xl bg-offwhite-200">
                        <img src="/images/landing.jpg"
                             onerror="this.src='https://placehold.co/400x400/212529/fff?text=MK'"
                             alt="Manish Kashyap" class="w-full h-full object-cover object-top">
                    </div>
                    {{-- Badge --}}
                    <div class="absolute -bottom-4 right-0 bg-white text-charcoal-800 px-5 py-3 rounded-2xl shadow-2xl border border-offwhite-200"
                         style="animation: bounce 3s infinite;">
                        <div class="flex items-center gap-3">
                            <div class="bg-red-100 text-red-600 p-2 rounded-full">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Followers Family</p>
                                <p class="font-bold text-lg">10 Million+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ HIS STORY (Featured) ═══ --}}
<section class="py-20 bg-white dark:bg-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1.5 rounded-full bg-primary-100 text-primary-700 font-semibold text-sm mb-4 uppercase tracking-wider">Featured Story</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Manish Kashyap's Story</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Manish Kashyap is a popular digital media reporter and creator from Bihar, India, known for his platform "Sach Tak News" and aggressive, anti-corruption ground reporting style.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-white to-offwhite-100 dark:from-charcoal-700 dark:to-charcoal-800 p-8 rounded-2xl border border-primary-200 dark:border-charcoal-600 hover:shadow-lg hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.361a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-primary-700 dark:text-primary-400 mb-3">The Reporter (Pre-2023)</h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">Built a massive online following of millions by recording confrontational, on-camera videos targeting local bribery, substandard roads, and broken government infrastructure.</p>
            </div>

            <div class="bg-gradient-to-br from-red-50 to-red-100 dark:from-charcoal-700 dark:to-charcoal-800 p-8 rounded-2xl border border-red-200 dark:border-charcoal-600 hover:shadow-lg hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-red-700 dark:text-red-400 mb-3">The Controversy (2023)</h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">Spent nine months in prison after being arrested for sharing fabricated videos regarding the harassment of Bihari migrant workers in Tamil Nadu, which had triggered a public safety panic.</p>
            </div>

            <div class="bg-gradient-to-br from-amber-50 to-yellow-100 dark:from-charcoal-700 dark:to-charcoal-800 p-8 rounded-2xl border border-amber-200 dark:border-charcoal-600 hover:shadow-lg hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                </div>
                <h3 class="text-xl font-bold text-amber-700 dark:text-amber-400 mb-3">The Politician (2024–Present)</h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">After briefly joining the BJP, he contested the November 2025 Bihar Assembly Elections from Chanpatiya under Prashant Kishor's Jan Suraaj party. Though he lost, he has since hinted at returning to digital content creation.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══ FEATURED POSTS ═══ --}}
<section class="py-20" style="background: linear-gradient(135deg, #FFFFFF 0%, #F8F9FA 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary-100 text-primary-700 font-semibold text-sm mb-3 uppercase tracking-wider">Latest Articles</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Featured Stories</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">The most impactful journalism covering current affairs.</p>
            </div>
            <a href="{{ route('blog.index') }}" class="hidden md:flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition">
                View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($featuredPosts as $post)
            <article class="bg-white dark:bg-charcoal-700 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-offwhite-200 dark:border-charcoal-600 group hover:-translate-y-1 transition duration-300 flex flex-col">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ $post->featured_image ? Storage::url($post->featured_image) : ($post->image_url ?? 'https://placehold.co/600x400/212529/fff?text=News') }}"
                         alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $post->category_name ?? 'News' }}</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold mb-3 text-gray-900 dark:text-white line-clamp-2 group-hover:text-primary-600 transition">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-4 flex-grow">{{ $post->excerpt }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 border-t border-offwhite-200 dark:border-charcoal-600 pt-4">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $post->created_at->format('M d, Y') }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            {{ $post->reading_time ?? 3 }} min read
                        </span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-16">
                <div class="text-5xl mb-4">📰</div>
                <p class="text-gray-500 dark:text-gray-400">No featured stories yet. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══ STATS BANNER ═══ --}}
<section class="py-20 relative overflow-hidden text-white"
         style="background: linear-gradient(135deg, #343a40 0%, #212529 100%);">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 20px 20px;"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="font-display text-3xl font-bold mb-12">The Impact in Numbers</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-white/20">
            <div class="px-4">
                <div class="font-display text-5xl font-extrabold text-yellow-300 mb-2">10M+</div>
                <div class="text-orange-100 font-medium uppercase tracking-wider text-sm">Subscribers</div>
            </div>
            <div class="px-4">
                <div class="font-display text-5xl font-extrabold text-yellow-300 mb-2">2500+</div>
                <div class="text-orange-100 font-medium uppercase tracking-wider text-sm">Videos</div>
            </div>
            <div class="px-4">
                <div class="font-display text-5xl font-extrabold text-yellow-300 mb-2">2B+</div>
                <div class="text-orange-100 font-medium uppercase tracking-wider text-sm">Views</div>
            </div>
            <div class="px-4">
                <div class="font-display text-5xl font-extrabold text-yellow-300 mb-2">5+</div>
                <div class="text-orange-100 font-medium uppercase tracking-wider text-sm">Years Reporting</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ LATEST UPDATES ═══ --}}
@if($latestPosts->count() > 0)
<section class="py-20 bg-white dark:bg-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-10 text-center">Latest Updates</h2>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            {{-- Big card --}}
            <div class="lg:col-span-2 group">
                <div class="relative h-full min-h-[380px] overflow-hidden rounded-2xl shadow-lg">
                    <img src="{{ $latestPosts[0]->featured_image ? Storage::url($latestPosts[0]->featured_image) : ($latestPosts[0]->image_url ?? 'https://placehold.co/800x500/212529/fff?text=Latest+News') }}"
                         alt="" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8 w-full">
                        <span class="bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase mb-3 inline-block">{{ $latestPosts[0]->category_name ?? 'Latest' }}</span>
                        <h3 class="text-2xl font-bold text-white mb-2 leading-tight">
                            <a href="{{ route('blog.show', $latestPosts[0]->slug) }}" class="hover:text-yellow-300 transition">{{ $latestPosts[0]->title }}</a>
                        </h3>
                        <p class="text-gray-300 text-sm">{{ $latestPosts[0]->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            {{-- Small cards --}}
            <div class="lg:col-span-2 flex flex-col gap-5">
                @foreach($latestPosts->skip(1)->take(4) as $post)
                <div class="flex gap-4 group items-center bg-offwhite-100 dark:bg-charcoal-700 rounded-xl p-3 hover:bg-offwhite-200 dark:hover:bg-charcoal-600 transition border border-offwhite-200 dark:border-charcoal-500">
                    <div class="w-28 h-20 flex-shrink-0 overflow-hidden rounded-lg bg-offwhite-200 dark:bg-charcoal-800">
                        <img src="{{ $post->featured_image ? Storage::url($post->featured_image) : ($post->image_url ?? 'https://placehold.co/300x200/212529/fff?text=News') }}"
                             alt="" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-primary-600 uppercase tracking-wider">{{ $post->category_name ?? 'News' }}</span>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-primary-600 transition">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@endsection
