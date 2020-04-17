<div>
    @foreach ($episodes as $episode)
    <a href="{{ $episode->path() }}">
        {{ $episode->number }}
    </a>
    @endforeach
</div>