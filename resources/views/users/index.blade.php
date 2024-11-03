{{-- Show all Users: /admins/users/index.blade.php --}}

{{-- A listing of all users in the database. Each user is displayed with their name, ID, email address, whether or not they are a subscriber. The user's creation date and time are also displayed. Clicking on the "View User" link will take you to the user's profile page which shows their favorite artworks. The Listing ID's are enumerated for quick view --}}

<x-layout>
  <div class="text-center text-md mt-5 md:mx-auto">
    <x-search :routename="'users.search'" />
    @if (request()->has('keywords'))
      <a
        href="{{ route('users.index') }}"
        class="block mt-4 text-center text-indigo-900 hover:text-indigo-600"
      >
        Clear search
      </a>
    @endif
  </div>

  <x-card class="py-2">
    <header>
      <h1 class="text-3xl text-center font-bold my-2 text-indigo-900">Users</h1>
    </header>

    <table class="w-full table-auto rounded-sm">
      <tbody>
        {{-- Get users from database --}}
        @unless ($users->isEmpty())
          @foreach ($users as $user)
            <tr class="border-gray-300">
              <td class="border-t border-b border-gray-300">
                {{-- Display Creation Date and Time --}}
                @unless ($user->created_at == null)
                  <div class="text-indigo-900 text-center">
                    <p class="text-sm">Registered:</p>
                    <p class="text-sm">
                      {{ \Carbon\Carbon::parse($user->created_at)->setTimezone('America/New_York')->format('m-d-y') }}
                    </p>
                    <p class="text-sm">
                      {{ \Carbon\Carbon::parse($user->created_at)->setTimezone('America/New_York')->format('h:i a') }}
                    </p>
                  </div>
                @endunless
              </td>

              {{-- Display Favorite Listing ID's --}}
              <td
                class="border-t border-b border-gray-300 text-indigo-900 px-4"
              >
                @if ($user->favorites != null)
                  @if ($user->favorites->count() == 1)
                    <span>{{ $user->favorites->count() }} - Favorite</span>
                  @elseif ($user->favorites->count() == 0)
                    <span>No Favorites</span>
                  @else
                    <span>{{ $user->favorites->count() }} - Favorites</span>
                  @endif
                @endif
              </td>

              {{-- View User --}}
              <td class="border-t border-b border-gray-300">
                <a
                  href="{{ route('users.show', $user) }}"
                  class="text-blue-600 underline text-xs font-normal"
                >
                  <i class="fas fa-heart"></i>
                  User Profile
                </a>
              </td>

              {{-- Display Name / Email Address --}}
              <td class="border-t border-b border-gray-300">
                <x-card>
                  <div>
                    {{-- Name / ID# --}}

                    <p class="text-sm text-indigo-900 font-bold">
                      {{ $user->firstname }}
                      {{ $user->lastname }}: ID#
                      {{ $user->id }}
                    </p>

                    <div class="text-indigo-500 font-bold text-sm">
                      {{-- Email Address --}}
                      <div>
                        <a
                          href="mailto:{{ $user->email }}"
                          class="text-blue-600 underline text-xs font-normal"
                        >
                          {{ $user->email }}
                        </a>
                      </div>

                      {{-- Subscribed? --}}
                      <p class="inline">Subscribed:</p>
                      @if ($user->subscribe == 1)
                        <i class="fas fa-check text-indigo-500"></i>
                        <span class="inline text-indigo-900">Yes</span>
                      @else
                        <i class="fas fa-times text-rose-500"></i>
                        <span class="inline text-indigo-900">No</span>
                      @endif
                    </div>
                  </div>
                </x-card>
              </td>
            </tr>
          @endforeach
        @endunless
      </tbody>
    </table>

    {{-- Pagination Links --}}
    {{--
      <div class="mt-6 p-4">
      {{ $users->links() }}
      </div>
    --}}
  </x-card>
</x-layout>
