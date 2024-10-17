@props([
    
    'artwork',
    'favorites',
    
])

{{-- Display favorite artworks --}}
{{--
    <h2 class="text-3xl text-center mb-4 font-bold border border-gray-300 p-3">
    Favorite Artworks
    </h2>
    
    @forelse ($favorites as $favorite)
    <div class="flex gap-4 mb-3">
    
    <x-artwork-card :artwork="$favorite" />
    @empty
    <p class="text-gray-500 text-center">
    You have no favorite artworks yet.
    </p>
    </div>
    @endforelse
--}}

<section class="flex flex-col md:flex-row gap-4">
{{--     Favorites

    
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
        <h3 class="text-2xl text-center font-semibold mb-10 pb-10">
        Favorites
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
        
        @forelse ($favorites as $favorite)
        <div class="flex gap-4 mb-3">
        
        <img src="{{ asset($favorite->artwork->image) }}" alt="artwork image" width="0" height="0" sizes="100vw" class=" w-[300px] md:block rounded-xl mx-auto"/>
        </div>
        @empty
        </div>
        <p class="text-gray-500 text-center">
        You have no favorite artworks yet.
        </p>
        @endforelse
        </div> --}}
        <h2 class="text-3xl text-center mb-4 font-bold border border-gray-300 p-3">
          Favorite Artworks
      </h2>
  
        @forelse ($favorites as $favorite)
          <div class="flex gap-4 mb-3">
            {{-- <a href="/artworks/{{  }}"> --}}
        <img
            src="{{ asset($favorites->image) }}"
            alt="artwork image"
            width="0"
            height="0"
            sizes="100vw"
            class="w-[300px] md:block rounded-xl mx-auto"
        />
        {{-- </a> --}}
              {{-- <x-artwork-card :artworks="$artworks" /> --}}
        @empty
              <p class="text-gray-500 text-center">
                  You have no favorite artworks yet.
              </p>
            </div>
        @endforelse
</section>
