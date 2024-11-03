<x-layout>
  <div
    class="bg-white rounded lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12"
  >
    <h2 class="text-2xl text-center font-bold mb-4">Login</h2>
    <form method="POST" action="{{ route('login.authenticate') }}">
      @csrf
      <x-inputs.text
        id="email"
        name="email"
        placeholder="Email address"
        type="email"
      />
      <x-inputs.text
        id="password"
        name="password"
        placeholder="Password"
        type="password"
      />

      <button
        type="submit"
        class="w-full bg-indigo-900 hover:bg-indigo-800 text-white mt-4 px-4 py-2 rounded focus:outline-none"
      >
        Login
      </button>
      <p class="mt-4 text-indigo-900">
        Don't have an account'?
        <a class="text-indigo-900" href="{{ route('register') }}">Register</a>
      </p>
    </form>
  </div>
</x-layout>
