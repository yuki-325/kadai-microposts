
    <ul class="list-unstyled">
    @foreach ($favorites as $favorite)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($favorite->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $favorite->user->name, ['id' => $favorite->user->id]) !!} <span class="text-muted">posted at {{ $favorite->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($favorite->content)) !!}</p>
                </div>
                <div class="btn-group">
                    @if (Auth::user()->is_favoriting($favorite->id))
                        {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Unfavorite', ['class' => "btn btn-success mr-1", 'type' => 'button']) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['favorites.favorite', $favorite->id]]) !!}
                            {!! Form::submit('Favorite', ['class' => "btn btn-light mr-1", 'type' => 'button']) !!}
                        {!! Form::close() !!}
                    @endif                    
                
                
                    @if (Auth::id() == $favorite->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $favorite->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delate', ['class' => 'btn btn-danger btn-sm', 'type' => 'button']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {{ $favorites->render('pagination::bootstrap-4') }}