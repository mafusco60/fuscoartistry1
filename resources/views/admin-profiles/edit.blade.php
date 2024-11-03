{{-- Profile Info Form --}}
<x-layout>
  <main class="container mx-auto p-8">
    <section class="">
      <x-profile-form :user="$admin" :route="'admin-profiles.update'">
        <x-inputs.text
          textClass="text-sm mt-4 font-semibold"
          :readonly="true"
          id="status_type"
          name="status_type"
          value="{{ $admin_status}} - {{ $admin->type }} "
        />
      </x-profile-form>
    </section>
  </main>
</x-layout>
