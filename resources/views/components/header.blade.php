
<header class="bg-blue-900 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-3xl font-semibold">
        <a href="{{url('/')}}">
        <img src="{{url('/images/logo.png')}}" class="w-[200px]" alt="Fusco Artistry" class="h-12 w-12">
        </a>
      </h1>
      <nav class="hidden md:flex items-center space-x-4">
        <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link> 
        <x-nav-link url="/artworks" :active="request()->is('artworks')">Gallery</x-nav-link>
        <x-nav-link url="/artworks/saved" :active="request()->is('artworks/saved')">Fav's'</x-nav-link>
        <x-nav-link url="/login" :active="request()->is('login')">Login</x-nav-link>
        <x-nav-link url="/register" :active="request()->is('register')">Register</x-nav-link>
        <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge">Dashboard</x-nav-link>

       <x-button-link url="/artworks/create" icon="edit" textClass="text-white">Create Artwork</x-button-link>
     
       
      </nav>
      <button
          id="hamburger"
          class="text-white md:hidden flex items-center"
      >
          <i class="fa fa-bars text-2xl"></i>
      </button>
  </div>
  <!-- Mobile Menu -->
  <nav
      id="mobile-menu"
      class=" hidden md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2"
  >
  
  
  <x-nav-link url="/" :active="request()->is('/')" :mobile="true">Home</x-nav-link>
  <x-nav-link url="/artworks" :active="request()->is('artworks')" :mobile="true">Gallery</x-nav-link>
  <x-nav-link url="/artworks/saved" :active="request()->is('artworks/saved')" :mobile="true">Fav's'</x-nav-link>
  <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
  <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
  <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge" :mobile="true">Dashboard</x-nav-link>

  <x-button-link url="/artworks/create" icon="edit" textClass="text-white" :block="true">Create Artwork</x-button-link>

  </nav>
</header>