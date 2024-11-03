@props(['routename' => 'artworks.search'])

<form
  method="GET"
  action="{{ route($routename) }}"
  class="block mx-5 space-y-2 md:mx-auto md:space-x-2"
>
  <input
    type="text"
    name="keywords"
    placeholder="Keywords"
    class="w-full md:w-72 px-4 py-3 focus:outline-none rounded-md"
    value="{{ request('keywords') }}"
  />

  <button
    class="w-full md:w-auto bg-indigo-900 hover:bg-indigo-600 text-white px-4 py-3 focus:outline-none rounded-md"
  >
    <i class="fa fa-search mr-1"></i>
    Search
  </button>
</form>
