<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse ($artworks as $artwork)
            <x-artwork-card :artwork="$artwork" />
        @empty
            <h2>No artworks found</h2>
        @endforelse
    </div>
</x-layout>
