@props([
  'artworks' => collect(),
  'favoritesClass' => 'grid grid-cols-2 md:grid-cols-4 
lg:grid-cols-5 xl:grid-cols-6
gap-4 mb-3 mx-auto',
  'artworkWidth' => 'w-[150px]',
  'favorites' => [],
])

<section>
  <div class="bg-white p-8 rounded-lg shadow-md w-full">
    <h3 class="text-2xl text-center font-semibold mb-4">Favorites</h3>
    <div class="{{ $favoritesClass }}">
      @forelse ($favorites as $favorite)
        <x-artwork-card :artwork="$favorite" artworkWidth="w-[150px]" />
      @empty
        <div class="grid grid-cols-1 mb-3">
          <p class="text-gray-500 text-center">
            You have no favorite artworks yet.
          </p>
        </div>
      @endforelse
    </div>
  </div>
</section>
