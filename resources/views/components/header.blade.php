<header class="bg-indigo-900 text-white p-4" x-data="{ open: false }">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">
                <img
                    src="{{ url('/images/logo.png') }}"
                    class="w-[200px]"
                    alt="Fusco Artistry"
                    class="h-12 w-12"
                />
            </a>
        </h1>
        <nav class="hidden text-sm md:flex items-center space-x-4">
            <x-nav-link url="/" :active="request()->is('/')" icon="home">
                Home
            </x-nav-link>
            <x-nav-link
                url="/artworks"
                :active="request()->is('artworks')"
                icon="palette"
            >
                Gallery
            </x-nav-link>
            @auth
                <x-nav-link
                    url="/favorites/index"
                    :active="request()->is('favorites')"
                    icon="heart"
                >
                    Fav's
                </x-nav-link>

                <x-nav-link
                    url="/dashboard"
                    :active="request()->is('dashboard')"
                    icon="gauge"
                >
                    Dashboard
                </x-nav-link>
                <x-logout-button />
                {{--
                    <x-button-link url="/artworks/create" icon="edit">
                    Create Artwork
                    </x-button-link>
                --}}
                <x-avatar :user="auth()->user()" />
            @else
                <x-nav-link url="/login" :active="request()->is('login')">
                    Login
                </x-nav-link>
                <x-nav-link
                    url="/register"
                    :active="request()->is('register')"
                >
                    Register
                </x-nav-link>
            @endauth
        </nav>

        <button
            @click="open = !open"
            id="hamburger"
            class="text-white md:hidden flex items-center"
        >
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav
        x-show="open"
        x-cloak
        @click.away="open = false"
        id="mobile-menu"
        class="bg-indigo-900 text-white mt-5 pb-4 space-y-2"
    >
        <x-nav-link url="/" :active="request()->is('/')" :mobile="true">
            <i class="fa fa-home inline"></i>
            Home
        </x-nav-link>
        <x-nav-link
            url="/artworks"
            :active="request()->is('artworks')"
            :mobile="true"
            icon="palette"
        >
            Gallery
        </x-nav-link>
        @auth
            <x-nav-link
                url="/favorites/index"
                :active="request()->is('favorites')"
                :mobile="true"
                icon="heart"
            >
                Fav's
            </x-nav-link>

            <x-nav-link
                url="/dashboard"
                :active="request()->is('dashboard')"
                icon="gauge"
                :mobile="true"
            >
                Dashboard
            </x-nav-link>
            <x-logout-button />
            {{-- </div> --}}
            {{--
                <x-button-link
                url="/artworks/create"
                icon="edit"
                textClass="text-indigo-900"
                :block="true"
                >
                Create Artwork
                </x-button-link>
            --}}
        @else
            <x-nav-link
                url="/login"
                :active="request()->is('login')"
                :mobile="true"
            >
                Login
            </x-nav-link>
            <x-nav-link
                url="/register"
                :active="request()->is('register')"
                :mobile="true"
            >
                Register
            </x-nav-link>
        @endauth
    </nav>
</header>
