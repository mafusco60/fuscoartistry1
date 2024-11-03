{{-- class="flex flex-col md:flex-row gap-4"> --}}
{{-- Profile Info Form --}}
<x-layout>
<x-admin-sidebar />

    <main class="container mx-auto p-8">
        <x-card>
            <div class="bg-white p-8 rounded-lg shadow-md w-full ">
                <h3 class="text-2xl text-center font-semibold mb-4">
                    Admin Profile Info
                </h3>
                <form
                    method="POST"
                    action="{{ route('admin-profiles.update') }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <x-avatar :userOrAdmin="$admin" />

                    <x-inputs.text
                        :readonly="true"
                        id="email_status_type"
                        name="email_status_type"
                        value="{{ $admin->email }} - {{ $admin_status}} - {{ $admin->type }} "
                    />

                    <x-inputs.text
                        label="First Name"
                        id="firstname"
                        name="firstname"
                        value="{{$admin->firstname }}"
                    />

                    <x-inputs.text
                        label="Last name"
                        id="lastname"
                        name="lastname"
                        value="{{$admin->lastname }}"
                    />

                    <x-inputs.file
                        label="Change Avatar Image"
                        id="avatar"
                        name="avatar"
                    />

                    <button
                        type="submit"
                        class="w-full bg-indigo-900 hover:bg-indigo-700 text-white px-4 py-2 border rounded focus:outline-none"
                    >
                        Update Profile
                    </button>
                </form>
            </div>
        </x-card>
    </main>
</x-layout>
