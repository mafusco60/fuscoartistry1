{{-- User: /admins/users/show/{{$user->id}} --}}

{{-- For Admin use: Lists all of the chosen user's favorite artworks. If the user has no favorites, a message is displayed. --}}

@php
    use Illuminate\Support\Str;
@endphp

<x-layout>
    <x-card class="p-10">
        <header>
            {{-- Full Name and ID## --}}
            <p class="text-lg text-rose-900 font-bold text-center">
                {{ $user->firstname }} {{ $user->lastname }}: User ID#
                {{ $user->id }}
            </p>

            <a href="mailto:{{ $user->email }}">
                <p class="text-rose-900 text-center font-bold text-lg">
                    {{ $user->email }}
                </p>
            </a>
        </header>

        {{-- Subscribed? --}}
        <div class="text-center">
            @if ($user->subscribe == 1)
                <i class="fas fa-check text-indigo-500"></i>
                <span class="text-indigo-900">Subscribed</span>
            @else
                <i class="fas fa-times text-rose-500"></i>
                <span class="text-indigo-900">Not Subscribed</span>
            @endif
        </div>

        {{-- Total Favorites --}}
        <p class="text-center text-indigo-700">
            Total Favorites: {{ $favorites->count() }}
        </p>
        <td>
            <img
                @unless ($user->avatar == null)
                    src="{{ asset($user->avatar) }}"
                @else
                    src="{{ asset("avatars/default-avatar.png") }}"
                @endunless
                alt="{{ $user->firstname }} "
                class="mx-auto object-cover rounded-[100%] w-1/6"
            />
        </td>

        {{-- Favorites Header: Checking for user's names ending in 's' and adding an apostrophe and 's' to the name if it does not end in 's'. --}}
        <p class="text-3xl text-rose-700 text-center font-bold mt-6">
            @if (Str::endsWith($user->firstname, "s"))
                {{ $user->firstname }}' Favorites
            @else
                {{ $user->firstname }}'s Favorites
            @endif
            <i class="text-xl fa-solid fa-heart"></i>
        </p>

        {{-- Add Favorites Button - Redirects to Favorites View --}}

        {{-- Fetch all favorites for the user --}}
        <table class="w-full table-auto rounded-sm">
            <tbody>
                {{-- Check if user has any favorites --}}
                @if ($favorites && $favorites->count() > 0)
                    @foreach ($favorites as $favorite)
                        {{-- Check that the artwork is still available (not null) --}}
                        @if ($favorite->artwork != null)
                            <tr class="border-gray-300">
                                <td
                                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                                >
                                    {{-- Display artwork image - Clickable to single artwork view --}}
                                    <a
                                        href="{{ route("artworks/" . $favorite->artwork->id) }}"
                                    >
                                        <img
                                            src="{{ asset($favorite->artwork->image) }}"
                                            alt=" "
                                            class="object-cover rounded-t-xl w-[100px] flex mx-auto"
                                        />
                                    </a>
                                </td>
                                <td
                                    class="text-rose-800 text-xl mx-auto text-centerpx-4 py-8 border-t border-b border-gray-300"
                                >
                                    {{-- Display artwork title - Clickable to single artwork view --}}
                                    <a
                                        href="{{ url("artworks/" . $favorite->artwork->id) }}"
                                    >
                                        <p class="text-center mx-auto">
                                            {{ $favorite->artwork->title }}
                                        </p>
                                        <p class="text-center mx-auto">
                                            {{ $favorite->artwork->type }}
                                        </p>
                                        <p class="text-center mx-auto">
                                            Artwork ID:
                                            {{ $favorite->artwork->id }}
                                        </p>
                                    </a>
                                </td>
                                <td
                                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                                ></td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg text-center"
                        >
                            No favorites yet!
                        </td>
                    </tr>
                @endif
                <a
                    href="{{ route("users.index") }}"
                    class="text-blue-600 underline text-xs font-normal"
                >
                    <i class="fas fa-arrow-left"></i>
                    Back to Users
                </a>
            </tbody>
        </table>
    </x-card>
</x-layout>
