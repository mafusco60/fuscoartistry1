@props([
    'user' => 'user',
    'route' => 'profiles.update',
])

<section>
    {{-- class="flex flex-col md:flex-row gap-4"> --}}
    {{-- Profile Info Form --}}
    <div class="bg-white p-8 rounded-lg shadow-md w-full">
        <h3 class="text-2xl text-center font-semibold mb-4">Profile Info</h3>
        <form
            method="POST"
            action="{{ route($route) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <x-avatar :userOrAdmin="$user" />

            {{ $slot }}

            {{--
                <x-inputs.text
                id="name"
                name="name"
                label="Full name"
                value="{{$user->name }}"
                />
            --}}

            <x-inputs.text
                id="firstname"
                name="firstname"
                label="First name"
                value="{{$user->firstname }}"
            />

            <x-inputs.text
                id="lastname"
                name="lastname"
                label="Last name"
                value="{{$user->lastname }}"
            />

            <x-inputs.text
                id="phone"
                name="phone"
                label="Phone"
                value="{{$user->phone }}"
            />

            <x-inputs.text
                id="email"
                name="email"
                label="Email Address"
                type="email"
                value="{{$user->email }}"
            />
            <x-inputs.file id="avatar" name="avatar" label="Upload Avatar" />
            @if (! Auth::guard('admin')->user())
                <x-inputs.select
                    id="subscribe"
                    name="subscribe"
                    label="Subscribe to Newsletter"
                    type="boolean"
                    :options="[1 => 'Yes', 0 => 'No']"
                    :value="old('subscribe', $user->subscribe)"
                />
            @endif

            <button
                type="submit"
                class="w-full bg-indigo-900 hover:bg-indigo-700 text-white px-4 py-2 border rounded focus:outline-none"
            >
                Update Profile
            </button>
        </form>
    </div>
</section>
