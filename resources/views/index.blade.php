<h1>Todoリスト</h1>

<!--追加フォーム-->
<form action="/todos" method="POST">
    @csrf
    <input type="text" name="title" value="{{old('title')}}" placeholder="タスクを入力">
    <button type="submit">追加</button>
</form>

<!--タスク一覧表示-->
@foreach($todos as $todo)
    @if($todo->completed)
        <p>Θ{{$todo->title}}</p>
    @else
        <p>Ο{{$todo->title}}</p>
    @endif

    <!--削除フォーム-->
    <form action="/todos/{{$todo->id}}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>

    <!--完了フォーム-->
    <form action="/todos/{{$todo->id}}/complete" method="POST" style="display: inline;">
        @csrf
        @method('PATCH')
        <button type="submit">完了</button>
    </form>
@endforeach
