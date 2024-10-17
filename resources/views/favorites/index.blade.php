<x-layout>
    
        <h2 class="text-3xl text-center mb-4 font-bold border border-gray-300 p-3">
        Favorite Artworks
        </h2>
        
        @forelse ($favorites as $favorite)
        <div class="flex gap-4 mb-3">
        <x-artwork-card 
        :artwork="$favorite"
        artworkWidth="w-[250px]"/>
        @empty
        <p class="text-gray-500 text-center">
        You have no favorite artworks yet.
        </p>
        </div>
        @endforelse
    
 
</x-layout>
