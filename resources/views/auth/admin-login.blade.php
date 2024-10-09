<x-layout>
  {{-- <x-card class="bg-gray-50 border border-gray-200 p-10 max-w-lg mx-auto mt-24"> --}}
    {{-- <header class="text-center"> --}}
      <i class="fa-solid fa-lock text-rose-500 inline text-2xl"></i>
      <h2 class="text-2xl font-bold inline px-2 uppercase mb-1">Admin Sign In</h2>
    </header>

    {{-- @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif --}}

    @if (Session::has('error_message'))
      <div
        class="alert alert-warning alert-dismissible danger fade show"
        role="alert"
      >
        <strong>Error:</strong>
        {{ Session::get('error_message') }}
        <button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

  <form method="POST" action="/auth/admin-login" type="email">
      @csrf
      <div class="input-group mb-6">
        <input
          type="email"
          class="mt-10 input-group append border border-gray-200 rounded p-2 w-full"
          name="email"
          value="{{ old('email') }}"
          placeholder= 'Email'
          value="{{ old('email') }}"
        />
        @error('email')
          <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6 input group">
        <input
          type="password"
          class="form-control border border-gray-200 rounded p-2 w-full"
          name="password"
          placeholder="Password"
        />
        @error('password')
          <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button
          type="submit"
          class="bg-rose-500 text-white w-full font-semibold rounded py-2 px-4 hover:bg-rose-800"
        >
          Sign In
        </button>
      </div>
    </form>
  
  <!-- Remember Me -->
  <div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
      <input
        id="remember_me"
        type="checkbox"
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
        name="remember"
      />
      <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
    </label>
  </div>

  <div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
      <a
        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        href="{{ route('password.request') }}"
      >
        {{ __('Forgot your password?') }}
      </a>
    @endif
  {{-- </x-card> --}}
</x-layout>
