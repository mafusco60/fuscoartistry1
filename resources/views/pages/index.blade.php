{{--
    <x-layout>
    <h2 class="text-center text-3xl mb-4 font-bold border border-gray-300 px-3">Welcome to Fusco Artistry</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <ul>
    @forelse($artworks as $artwork)
    <x-artwork-card :artwork="$artwork" />
    
    @empty
    <li>No artworks found</li>
    @endforelse
    </ul>
    </div>
    
    <x-bottom-banner />
    </x-layout>
--}}

<x-layout>
    <main class="container mx-auto p-8">
        <x-featured :artworks="$featuredArtworks" />
        <div class="z-40">
            <x-info-boxes />
        </div>
        <div class="z-10">
            <x-recent :artworks="$recentArtworks" />
        </div>
    </main>
    <x-bottom-banner />
</x-layout>
