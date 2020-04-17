<div>
    Episode-{{ $episode->number }}-


    <form action="/episodes" method="POST">
        {{ csrf_field() }}        
        <div>   
            @foreach ($boys as $boys)
            {{ $boys->name }}
            <input type="radio" name="boys_id" value="{{ $boys->id }}">
            @endforeach            
        </div>

        <br>

        <div>
            @foreach ($girls as $girls)
            {{ $girls->name }}
            <input type="radio" name="girls_id" value="{{ $girls->id }}">
            @endforeach    
        </div>

        <button type="submit">投票する！</button>

    </form>


</div>