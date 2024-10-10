<x-layout>
    <main class="container mx-auto p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @forelse ($artworks as $artwork)
                <x-artwork-card :artwork="$artwork" />
            @empty
                <h2>No artworks found</h2>
            @endforelse
        </div>
        <div class="mt-6 p-4"></div>
        {{ $artworks->links() }}
    </main>
</x-layout>
