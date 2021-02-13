
@if (Auth::user()->is_favorite($micropost->id))
        {{-- お気に入り登録解除ボタンのフォーム --}}
    　　{!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-secondary btn-sm"]) !!}
        {!! Form::close() !!}      
@else
        {{-- お気に入り登録ボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
            {!! Form::submit('favorite', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
@endif
