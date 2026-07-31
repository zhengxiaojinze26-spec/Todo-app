<h1>Todo一覧</h1>

<form action="/todos" method="POST">
    @csrf
    <input type="text" name="title" value="{{old('title')}}" placeholder="タスクを入力">
    <button type="submit">追加</button>
</form>

@foreach($todos as $todo)
    @if($todo->completed)
        <p>Θ{{$todo->title}}</p>
    @else
        <p>Ο{{$todo->title}}</p>
    @endif

    <form action="/todos/{{$todo->id}}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
@endforeach
