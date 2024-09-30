
<x-layout> 

 <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6"
  <ul>
    @forelse($artworks as $artwork)
    <x-artwork-card :artwork="$artwork" />

    @empty
      <li>No artworks found</li>
    @endforelse
    </div>
  </ul>
</x-layout>
