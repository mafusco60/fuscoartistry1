<div x-data="{ open: false }" class="flex h-screen">
  <!-- Sidebar -->
  <div
    :class="open ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white transform transition-transform duration-300 ease-in-out"
  >
    <div class="p-4">
      <h2 class="text-xl font-semibold mb-4">Admin Dashboard</h2>
      <ul class="space-y-2">
        <li>
          <a
            href="{{ route('dashboard') }}"
            class="space-x-1 flex text-white text-sm py-2 px-8 rounded-xl hover:opacity-80"
          >
            <i class="fa-solid fa-tachometer-alt pr-4"></i>
            Dashboard
          </a>
        </li>
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
            href="{{ route('manage-listings.index') }}"
            class="space-x-1 flex text-white text-sm py-2 px-8 rounded-xl hover:opacity-80"
          >
            <i class="fa-solid fa-list pr-4"></i>
            Manage Listings
          </a>
        </li>
        <!-- Add more sidebar items here -->
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-4">
    <button
      @click="open = !open"
      class="bg-gray-800 text-white px-4 py-2 rounded-md"
    >
      Toggle Sidebar
    </button>
    <!-- Your main content goes here -->
    @yield('content')
  </div>
</div>
