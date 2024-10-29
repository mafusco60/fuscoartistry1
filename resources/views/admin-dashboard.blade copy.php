{{-- Dashboard: admins/dashboard.blade.php --}}

{{-- Admin Dashboard: Admins' menu --}}
{{-- Admins can create, manage, and archive listings, view and archive messages, view users, update their password, and update their profile. --}}
{{-- If an admin is logged in, it will display their name and profile image.  If not, it will display a login link. --}}
{{-- The admin can also logout. --}}

<x-layout>
    <body>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-3 bg-indigo-900 h-max">
                <div
                    class="text-white flex flex-col relative items-start px-5 h-[200vh]"
                >
                    <button
                        class="bg-yellow-400 rounded-t-lg flex items-center py-2 px-6"
                    ></button>

                    <div
                        class="{{-- group relative --}}"
                    ></div>
                    <x-card>
                        <h2
                            class="text-xl text-center text-indigo-800 font-bold"
                        >
                            Admin Dashboard
                        </h2>

                        @if (Auth::guard('admin')->user() && Auth::guard('admin')->user()->status == 1)
                            <p class="text-rose-500 text-md text-center">
                                Hello
                                {{ Auth::guard('admin')->user()->firstname }}!
                            </p>
                        @else
                            <a href="{{ route('admin.authenticate') }}">
                                <p class="text-rose-500 text-lg">
                                    Login Please
                                </p>
                            </a>
                        @endif

                        @if (Auth::guard('admin')->user()->avatar != null)
                            <img
                                src=" {{ asset(Auth::guard('admin')->user()->avatar) }} "
                                alt=" "
                                class="mx-auto object-cover rounded-[100%] w-[100px]"
                            />
                        @else
                            <img
                                src=" {{ asset('avatars/default-avatar.png') }} "
                                alt=" "
                                class="mx-auto object-cover rounded-[100%] w-1/6"
                            />
                        @endif
                    </x-card>
                    {{-- -------- --}}
                    <div class="flex items-start w-[100%] flex-col mt-5">
                        {{-- -------- --}}
                        {{-- <div class="flex flex-col"> --}}
                        <ul>
                            <li>
                                <a
                                    href="{{ route('artworks.create') }}"
                                    class="space-x-1 flex text-white text-sm py-2 px-8 rounded-xl hover:opacity-80"
                                >
                                    <i class="fa-solid fa-square-plus pr-4"></i>
                                    Create Listing
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('home') }}"
                                    class="space-x-1 flex text-white text-sm py-2 px-8 rounded-xl hover:opacity-80"
                                >
                                    <i class="fa-solid fa-list pr-4"></i>

                                    Manage Listings
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('archive-listings.index') }}"
                                    class="flex text-white space-x-1 text-sm py-2 px-8 rounded-xl hover:opacity-80"
                                >
                                    <i
                                        class="fa-solid fa-archive pr-4 inline"
                                    ></i>
                                    Archived Listings
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('messages.index') }}"
                                    class="flex text-white text-sm py-2 px-8 rounded-md hover:opacity-80"
                                >
                                    <i class="fa-solid fa-envelope pr-4"></i>

                                    Messages
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('archive-messages.index') }}"
                                    class="flex text-white text-sm py-2 px-8 rounded-md hover:opacity-80"
                                >
                                    <i class="fa-solid fa-archive pr-4"></i>
                                    Archived Messages
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('home') }}"
                                    class="flex text-white text-sm py-2 px-8 rounded-md hover:opacity-80"
                                >
                                    <i class="fa-solid fa-users pr-4"></i>
                                    Users
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('home') }}"
                                    class="flex text-white text-sm py-2 px-8 rounded-md hover:opacity-80"
                                >
                                    <i class="fa-solid fa-lock pr-4"></i>
                                    Update Password
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ url('home') }}"
                                    class="flex text-white text-sm py-2 px-8 rounded-md hover:opacity-80"
                                >
                                    <i
                                        class="fa-solid fa-user-cog inline pr-4"
                                    ></i>
                                    Update Profile
                                </a>
                            </li>

                            <li>
                                <a
                                    href="{{ route('home') }}"
                                    class="flex text-white text-sm py-2 px-8 rounded-md hover:opacity-80"
                                >
                                    <i
                                        class="fa-solid fa-user-cog inline pr-4"
                                    ></i>
                                    CMS Pages
                                </a>
                            </li>
                        </ul>

                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                            class="inline"
                        >
                            @csrf
                            <button
                                type="submit"
                                class="flex text-white text-sm py-2 px-8 rounded-md hover:opacity-80 w-full text-left"
                            >
                                <i class="fa-solid fa-sign-out pr-4"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <p></p>
</x-layout>
