<h1>編集画面</h1>
<form action="/todos/{{$todo->id}}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{$todo->title}}">
    <button type="submit">更新</button>
</form>
