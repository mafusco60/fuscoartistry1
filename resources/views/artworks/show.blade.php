{{-- Show Page - /artworks/show.blade.php --}}

{{-- Individual Artwork with details.  Admins have the option of editing or deleting the artwork. Users can add or remove the artwork from their favorites.  Users can also contact the artist.  The artwork details include the title, type, price, substrate, dimensions, and description.  If the artwork is an original, the price, substrate, and dimensions are displayed.  If the artwork is not an original, a message is displayed.  The user can also view print prices --}}

<x-layout>

  {{-- Admin function: edit --}}

{{-- <x-card class="mt-4 p-2 flex space-x-6"> --}}
  {{-- <a href="{{url('admins/' . $artwork->id . '/artworks/edit')}}" class="text-cyan-700">
    <i class="fa-solid fa-pencil"></i>
    Edit Artwork
  </a>
  <script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this artwork?")) {
            document.getElementById('delete-form').submit();
        }
    }
    </script> --}}

      {{-- Admin function: delete --}}
 {{--  <form id="delete-form" method="POST" action="/artworks/{{$artwork->id}}" >
  @csrf
  @method('DELETE')
  <button type="button" class="text-red-700" onclick="confirmDelete()">
    <i class="fa-solid fa-trash"></i>
    Delete Artwork
  </form> 
</x-card> --}}

{{-- Add or Remove 'Favorites' Button - in view if logged in --}}
  <div class="mx-4">
    {{-- <x-card class="p-10"> --}}
      <div class="flex flex-col items-center justify-center text-center font-bold text-rose-800">
       
        <div class="text-lg inline text-rose-600 mb-4 border rounded-xl py-2 px-6">

{{--           @auth
          @php
            $bookmark = auth()->user()->bookmarks()->where('artwork_id', $artwork->id)->first();
          @endphp --}}
          {{-- Remove Favorites Button --}}
{{--           @if ($bookmark)
          <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" method="POST">
              @csrf
              @method('DELETE')

              <i class="fa-solid fa-heart"></i>
              <button type="submit">Remove from Your Favorite</button>
          </form> --}}
          {{-- Add Favorites Button - Redirects to Favorites View --}}
{{--           @else
          <form action="{{ route('bookmarks.store') }}" method="POST">
              @csrf
              <input type="hidden" name="user_id" value="{{ auth()->id() }}">
              <input type="hidden" name="artwork_id" value="{{ $artwork->id }}">
              <i class="fa-solid fa-heart"></i>
              <button type="submit">Add to Your Favorites</button>
          </form>
      @endif
  @endauth 
    </div> --}}

{{-- Display Artwork Image and Details --}}
{{-- Image --}}
        <img
          class="w-[450px] mr-6 mb-6 rounded-xl"
          src="{{ asset($artwork->image) }}"
          alt=""
        />
        {{-- Title --}}
        <h3 class="text-2xl mb-2">
          "{{ $artwork->title }}"
        </h3>
{{-- Medium Type --}}
        <div class="text-xl text-cyan-800 mb-4">Medium:
          {{ ucwords($artwork->medium) }}
         {{--  <x-artwork-type --}} {{-- :medium="$artwork->medium" /> --}}
        </div>

{{-- If Original exists, Original Price, Substrate, Dimensions --}}
        @if ($artwork->original)
          <div class="text-lg text-cyan-800 ">Original:  ${{$artwork->price}}
          </div>
          <div class="text-lg text-cyan-800 ">Substrate: {{ucwords($artwork->original_substrate)}}</div>
          <div class="text-lg text-cyan-800 mb-2">Dimensions: {{$artwork->original_dimensions}}</div>
            @else <h2>Original Not Available</h2>
        @endif

        {{-- Link to Prices for Prints --}}
        <a href="{{url('pricings')}}" 
        class="text-rose-800 text-xl my-4 py-2 px-8 rounded-xl hover:opacity-80 border border-rounded-lg">
          <i class="fa-solid fa-dollar"></i>
           Prices for Prints</a>
        </div>  
        <div class="border border-gray-200 w-full mb-6 text-center"></div>
        
        {{-- Description --}}
        <div>
          <h3 class="text-3xl font-bold mb-4 text-center">Description</h3>
          <div class="text-lg text-cyan-800 space-y-6 text-center font-normal">
            {{ $artwork->description }}</div>
            <div class="border border-gray-200 w-full mt-8 text-center"></div>

            {{-- Contact Artist Button - Redirects to contact form --}}
  {{--        <a
              href="{{url('contact-messages/create')}}"
              class="block bg-cyan-800 text-white mt-6 py-2 rounded-xl hover:opacity-80 text-center"
            >
              <i class="fa-solid fa-envelope"></i>
               Contact Artist   
            </a> --}}
          </div>
        </div>
      </div>
    {{-- </x-card>    --}}
  </div>
</x-layout>
