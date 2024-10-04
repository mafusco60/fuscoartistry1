@props([
    'user',
])
<div>
    @if ($user->avatar)
        <img
            src="{{ asset($user->avatar) }}"
            alt="{{ $user->name }}"
            style="
                width: 3rem;
                height: 3rem;
                border-radius: 9999px;
                object-fit: cover;
                margin: 0 auto;
            "
        />
    @else
        <img
            src="{{ asset('avatars/default-avatar.png') }}"
            alt="{{ $user->name }}"
            style="
                width: 3rem;
                height: 3rem;
                border-radius: 9999px;
                object-fit: cover;
                margin: 0 auto;
            "
        />
    @endif
</div>
