@extends('layouts.app')

@section('title', 'About Manish Kashyap – Independent Journalist from Bihar')
@section('meta_description', 'Learn about Manish Kashyap, the fearless digital journalist and ground reporter from Bihar who transformed independent media in India.')

@section('content')

{{-- Page Header --}}
<div class="relative py-28 overflow-hidden text-white"
     style="background: linear-gradient(135deg, #2b3035 0%, #121416 100%);">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 24px 24px;"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-block px-4 py-1.5 rounded-full bg-white/20 border border-white/30 text-sm font-semibold tracking-widest uppercase mb-4">The Man. The Mission.</span>
        <h1 class="font-display text-4xl md:text-6xl font-bold mb-4">About Manish Kashyap</h1>
        <p class="text-xl text-orange-100 max-w-2xl mx-auto">The journey of an independent voice bringing the ground reality to millions.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

    {{-- Main Bio Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start mb-24">
        {{-- Photo --}}
        <div class="relative order-2 lg:order-1">
            <div class="absolute -inset-4 bg-primary-200 dark:bg-primary-900/30 blur-2xl rounded-full opacity-40"></div>
            <img src="/images/manish_salute.jpg"
                 onerror="this.src='https://placehold.co/600x700/212529/fff?text=Manish+Kashyap'"
                 alt="Manish Kashyap"
                 class="relative rounded-3xl shadow-2xl border-4 border-white dark:border-charcoal-700 object-cover w-full aspect-[4/5]">
            {{-- Floating tag --}}
            <div class="absolute -bottom-6 -right-4 bg-primary-600 text-white px-6 py-3 rounded-2xl shadow-xl font-bold text-lg">
                🎙️ Sach Tak News
            </div>
        </div>

        {{-- Content --}}
        <div class="space-y-6 order-1 lg:order-2">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900 dark:text-white leading-tight">
                The Man in Front of the Camera,<br><span class="text-primary-600">Changing Bihar</span>
            </h2>

            <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
                Manish Kashyap completely transformed how digital journalism is done in Bihar. Armed with just a microphone, a mobile camera, and an aggressive voice, he bypassed traditional television studios to expose the raw reality of local administrative failures.
            </p>

            <div class="space-y-4">
                <div class="flex gap-4 p-4 bg-offwhite-100 dark:bg-charcoal-700 rounded-xl border border-offwhite-200 dark:border-charcoal-600">
                    <div class="flex-shrink-0 w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center text-white text-lg">🌱</div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">The Voice of the Soil</h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Popularly called the "Son of Bihar," he built a massive digital empire of millions of followers. His reporting didn't focus on high-profile political debates, but on things that directly impact daily life — broken bridges, empty government school classrooms, corrupt local officials, and incomplete roads.</p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 bg-offwhite-100 dark:bg-charcoal-700 rounded-xl border border-offwhite-200 dark:border-charcoal-600">
                    <div class="flex-shrink-0 w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center text-white text-lg">⚡</div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">Fearless Confrontation</h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">His signature style involves walking right into government offices or public project sites and confronting authorities on camera. By demanding real-time answers for substandard work, he forced local bureaucracies to be accountable to ordinary citizens.</p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 bg-red-50 dark:bg-charcoal-700 rounded-xl border border-red-100 dark:border-charcoal-600">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-white text-lg">⚖️</div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">The Cost of Firebrand Journalism</h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">His uncompromising and aggressive style has frequently landed him in deep legal trouble. In 2023, he was imprisoned for nine months over a controversial, unverified video regarding Bihari migrant workers. Even after his release, his fearless streak continued — including a highly publicized on-camera clash with hospital staff while investigating mismanagement at Patna Medical College and Hospital (PMCH).</p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 bg-amber-50 dark:bg-charcoal-700 rounded-xl border border-amber-100 dark:border-charcoal-600">
                    <div class="flex-shrink-0 w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center text-white text-lg">🏛️</div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">The Political Shift</h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Recognizing the limits of just standing behind a camera, he stepped directly into the political battlefield. After brief stints with national parties, he contested the November 2025 Bihar Assembly Elections from the Chanpatiya constituency under Prashant Kishor's Jan Suraaj party. Though he lost the election, he remains a powerful public voice navigating the intersection of digital media and grassroots activism.</p>
                    </div>
                </div>
            </div>

            <blockquote class="border-l-4 border-primary-600 pl-5 italic text-gray-700 dark:text-gray-300 text-xl font-display bg-offwhite-100 dark:bg-charcoal-700 py-4 pr-4 rounded-r-xl">
                "Journalism is not about reading teleprompters in AC studios; it's about asking tough questions on the broken roads of rural India."
            </blockquote>
        </div>
    </div>

    {{-- Achievements --}}
    <div class="mb-24">
        <h2 class="font-display text-3xl font-bold text-gray-900 dark:text-white text-center mb-12">Impact &amp; Reach</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($achievements as $stat)
            <div class="bg-white dark:bg-charcoal-700 rounded-2xl p-8 text-center shadow-sm border border-offwhite-200 dark:border-charcoal-600 hover:-translate-y-2 hover:shadow-lg transition duration-300">
                <div class="text-4xl mb-3">{{ $stat['icon'] }}</div>
                <div class="text-3xl font-bold text-primary-600 dark:text-primary-400 mb-1 font-display">{{ $stat['number'] }}</div>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Timeline --}}
    <div class="max-w-4xl mx-auto">
        <h2 class="font-display text-3xl font-bold text-gray-900 dark:text-white text-center mb-12">The Journey</h2>
        <div class="relative border-l-2 border-primary-300 dark:border-primary-700 ml-4 space-y-10 pb-8">
            @foreach($timeline as $event)
            <div class="relative pl-10">
                <div class="absolute w-5 h-5 bg-primary-600 rounded-full -left-[11px] top-1 border-4 border-white dark:border-charcoal-900 shadow-md"></div>
                <span class="inline-block text-primary-600 font-bold text-lg mb-1">{{ $event['year'] }}</span>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $event['title'] }}</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400 leading-relaxed">{{ $event['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
