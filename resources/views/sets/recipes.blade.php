{{-- このページは使ってない --}}

<div>
    @foreach ($sets as $set)
        <p>{{ $set->set_name }}</p>
        <div><a href="{{ route('sets.show', $set) }}"><img src="{{ asset($set->set_image) }}" alt="Set Image"></a></div>
    @endforeach
</div>
