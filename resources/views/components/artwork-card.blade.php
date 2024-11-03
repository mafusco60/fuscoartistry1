@props([
  'artwork',
  'artworkWidth' => 'w-[300px]',
])

{{-- Display artwork with link to details page --}}
<div class="relative group">
  <a href="{{ url('artworks/' . $artwork->id) }}">
    <img
      src="{{ asset($artwork->image) }}"
      alt="artwork image"
      width="0"
      height="0"
      sizes="100vw"
      class="{{ $artworkWidth }} md:block rounded-xl mx-auto"
    />
  </a>

  {{-- Create hidden / translucent overlay with artwork details --}}
  <a href="/artworks/{{ $artwork->id }}">
    <div
      class="md:absolute bottom-0 md:left-0 md:right-0 p-2 px-4 text-white duration-500 bg-indigo-900 opacity-0 group-hover:opacity-100 bg-opacity-40"
    >
      <div class="flex justify-between">
        <div class="font-normal">
          <p class="text-sm">"{{ $artwork->title }}"</p>
          <p class="text-xs">{{ $artwork->medium }}</p>

          @if ($artwork->original)
            <p class="text-xs">Original: ${{ $artwork->original_price }}</p>
          @else
            <p class="text-xs">Original Not Available</p>
          @endif
        </div>
      </div>
    </div>
  </a>
</div>
