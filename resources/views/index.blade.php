<h1>Todo一覧</h1>
@foreach($todos as $todo)
    @if($todo->completed)
        <p>Θ{{$todo->title}}</p>
    @else
        <p>Ο{{$todo->title}}</p>
    @endif
@endforeach
