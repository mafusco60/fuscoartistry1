
<x-layout> 
 <h1>Artwork Listings</h1>
  <ul>
    @forelse($artworks as $artwork)
      <li>
        {{ $artwork }}
      </li>
    @empty
      <li>No artworks found</li>
    @endforelse
  </ul>
</x-layout>
