<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Todo管理アプリ</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <header>
        <h1>Todoリスト</h1>
        <p>追加するタスクを入力してください。</p>

        <!--追加フォーム-->
        <form action="/todos" method="POST">
            @csrf
            <input type="text" name="title" value="{{old('title')}}" placeholder="タスクを入力">
            <button type="submit">追加</button>
        </form>
    </header>

    <!--タスク一覧表示-->
    <div class="tasks">
    @foreach($todos as $todo)
        @if($todo->completed)
            <p>Θ　{{$todo->title}}</p>
        @else
            <p>Ο　{{$todo->title}}</p>
        @endif

        <div class="forms">
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

        <!--編集ページ移動-->
        <a href="/todos/{{$todo->id}}/edit">編集</a>
        </div>
    @endforeach
    </div>

    <button class="btn btn-primary">
        Bootstrapテスト
    </button>
</body>
</html>
