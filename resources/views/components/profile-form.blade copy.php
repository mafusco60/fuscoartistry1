@props([
    'user',
])

<section>
    {{-- class="flex flex-col md:flex-row gap-4"> --}}
    {{-- Profile Info Form --}}
    <div class="bg-white p-8 rounded-lg shadow-md w-full">
        <h3 class="text-2xl text-center font-semibold mb-4">Profile Info</h3>
        <form
            method="POST"
            action="{{ route('profile.update') }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <x-avatar :userOrAdmin="$user" />

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
            <x-inputs.file id="avatar" name="avatar" label="Upload Avatar" />

            <button
                type="submit"
                class="w-full bg-indigo-900 hover:bg-indigo-700 text-white px-4 py-2 border rounded focus:outline-none"
            >
                Update Profile
            </button>
        </form>
    </div>
</section>
