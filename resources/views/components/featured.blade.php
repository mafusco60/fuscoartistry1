{{-- Featured: components/featured.blade.php --}}

{{-- --------------- Featured --------------- --}}
{{-- Four of the featured artworks.  If more than four are tagged as featured, it will show random sets of four. --}}

@props([
  'artworks',
])

{{-- Featured Artworks Heading --}}

<section class="bg-indigo-50 px-4 pt-6 pb-10">
  <div class="container-xl lg:container m-auto">
    <h2 class="text-3xl font-bold text-indigo-900 mb-6 text-center">
      Featured Artworks
    </h2>

    {{-- Four cards. --}}

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach ($artworks as $artwork)
        {{-- Card --}}
        <div
          class="bg-white rounded-xl shadow-md relative flex flex-col md:flex-row"
        >
          {{-- Image links to individual artwork --}}
          <a href="{{ 'artworks/' . $artwork->id }}">
            <img
              src="{{ asset($artwork->image) }}"
              alt=" {{ $artwork->title }}"
              class="object-contain rounded-t-xl md:rounded-tr-none md:rounded-l-xl w-full md:w-[300px] h-[300px] md:h-auto"
            />
          </a>
          {{-- Title / Medium --}}

          <div class="p-6">
            <h3 class="text-xl font-bold">
              {{ $artwork->title }}
            </h3>
            <div class="text-gray-600 mb-4">
              {{-- <x-artwork-type :type="$artwork->medium" /> --}}
            </div>

            <div class="border border-gray-200 mb-5"></div>

            {{-- if original exists show original price --}}

            @if ($artwork->original)
              <div class="text-lg font-bold mb-4">
                Original: ${{ $artwork->original_price }}
              </div>
            @else
              {{-- If no original --}}

              <a href="{{ url('pricings') }}">
                <span class="text-lg font-bold mb-4">Prints Available</span>
              </a>
            @endif

            {{-- Details Button - Link to Artwork Details Page --}}
            {{--
              <a
              href="{{ 'artworks/' . $artwork->id }}"
              class="absolute bottom-[25px] right-[15px] bg-indigo-900 hover:bg-indigo-800 text-white p-4 rounded-lg text-center text-sm w-2/3 md:w-1/3"
              >
              Details
              </a>
            --}}
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
