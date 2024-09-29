
<x-layout>
  <x-slot name="title">Create New Artwork</x-slot>
   <h1>Create New Artwork</h1>
  <form action="/artworks" method="POST">
    @csrf
    <div class="my-5">
    <input type="text" name="title" placeholder="Title" value="{{ old('title') }}">
    @error('title')
    <div class="text-rose-500 mt-2 text-sm">
      {{ $message }}</div>
    @enderror
    </div>
    <div class="mb-5">
    <input type="text" name="description" placeholder="Description" value="{{ old('description') }}">
    @error('description')
    <div class="text-rose-500 mt-2 text-sm">
      {{ $message }}</div>
    @enderror
    </div>
    <button type="submit">Create</button>
</x-layout>