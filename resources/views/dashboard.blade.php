<x-layout>
    <main class="container mx-auto p-8">
        {{-- <section class="flex flex-col md:flex-row gap-4"> --}}
        {{-- Profile Info Form --}}
        {{--
            <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-2xl text-center font-semibold mb-4">
            Profile Info
            </h3>
            <form
            method="POST"
            action="{{ route('profile.update') }}"
            enctype="multipart/form-data"
            >
            @csrf
            @method('PUT')
            
            <x-avatar :user="$user" />
            
            <x-inputs.text
            id="name"
            name="name"
            label="Full name"
            value="{{$user->name }}"
            />
            <x-inputs.text
            id="email"
            name="email"
            label="Email Address"
            type="email"
            value="{{$user->email }}"
            />
            <x-inputs.file
            id="avatar"
            name="avatar"
            label="Upload Avatar"
            />
            
            <button
            type="submit"
            class="w-full bg-indigo-900 hover:bg-indigo-700 text-white px-4 py-2 border rounded focus:outline-none"
            >
            Update Profile
            </button>
            </form>
            </div>
        --}}
</section class="flex flex-col md:flex-row">
        <x-profile-form :user="$user" />

        {{-- Orders --}}
        {{--
            <div class="bg-white p-8
            rounded-lg shadow-md w-full">
            <h3 class="text-2xl text-center font-semibold mb-4">Orders</h3>
            <p class="text-lg font-semibold">Order #1:</p>
            <p class="text-md">Placeholder for orders</p>
            <p class="text-sm">...see more</p>
            </div>
        --}}

        {{-- Favorites --}}
        {{-- <section class="flex flex-col md:flex-row gap-4"> --}}
   <x-card>
    <div class="bg-white p-8 rounded-lg shadow-md w-full">
        <h3 class="text-2xl text-center font-semibold mb-4">Favorites</h3>
       {{--  <h2 class="text-3xl text-center mb-4 font-bold border border-gray-300 p-3">
            Favorite Artworks
            </h2> --}}
            
            @forelse ($favorites as $favorite)
            <div class="flex gap-4 mb-3">
            <x-artwork-card 
            :artwork="$favorite"
            artworkWidth="w-[150px]" 
                             />
            @empty
            <p class="text-gray-500 text-center">
            You have no favorite artworks yet.
            </p>
            </div>
            @endforelse
        </div> 
    </x-card>

        {{-- </section> --}}
        
        {{--
            <x-favorites :favorites="$favorites" :artworks="$artworks" />
        --}}
        {{--
            <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-2xl text-center font-semibold mb-10 pb-10">
            Favorites
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
        --}}

        {{--
            @forelse ($favorites as $fasvorite)
            <div class="flex gap-4 mb-3">
            
            <img src="{{ asset($favorite->artwork->image) }}" alt="artwork image" width="0" height="0" sizes="100vw" class=" w-[300px] md:block rounded-xl mx-auto"/>
            @empty
            <p class="text-gray-500 text-center">
            You have no favorite artworks yet.
            </p>
            </div>
            @endforelse
        --}}
    </main>
    <x-bottom-banner />
</x-layout>
