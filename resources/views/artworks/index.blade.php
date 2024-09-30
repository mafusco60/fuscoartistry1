
<x-layout> 
 <h1>Artwork Listings</h1>
  <ul>
    @forelse($artworks as $artwork)
    <li>
      <img src="{{ $artwork->image }}" alt="{{ $artwork->title }}" style="width: 100px; height: 100px; object-fit: cover;">
    </li>
      <li>
        <a href ="{{route("artworks.show", $artwork->id)}}">
        {{ $artwork->title }} 
      </li>
        <li>Artwork Medium
        : {{ $artwork->medium }}

      </li></a>
      <li>Search Tags:

        {{ $artwork->search_tags }} 
      </li>
        <li>Artwork Description
        : {{ $artwork->description }}

      </li>
      <li>Featured?
        : {{ $artwork->featured }}
        </li>
        
      <li>Original Available:

        {{ $artwork->original }} 
      </li>
  

        <li>Original Substrate:

          {{ $artwork->original_substrate }} 
        </li>
          <li>Original Dimensions:

          {{ $artwork->original_dimensions }}
         
  
        </li>
        <li>Original Price:

          {{ $artwork->original_price }}

      </li>

    @empty
      <li>No artworks found</li>
    @endforelse
  </ul>
</x-layout>
