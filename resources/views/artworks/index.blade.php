
<x-layout> 
 <h1>Artwork Listings</h1>
  <ul>
    @forelse($artworks as $artwork)
      <li>
        <a href ="{{route("artworks.show", $artwork->id)}}">
        {{ $artwork->title }} 
      </li>
        <li>Artwork Description
        : {{ $artwork->description }}

      </li></a>
    @empty
      <li>No artworks found</li>
    @endforelse
  </ul>
</x-layout>
