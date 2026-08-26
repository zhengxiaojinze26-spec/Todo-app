<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Todo管理アプリ</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <div class="container">

    <header>
        <div class="d-flex justify-content-between">
        <h1>Todoリスト</h1>

        <!--ログアウト-->
        <form class="d-flex align-items-end me-3" action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit">Log out</button>
        </form>
        </div>

        <div class="header-form">
        <p>追加するタスクを入力してください。</p>

        <!--追加フォーム-->
        <form action="/todos" method="POST">
            @csrf
            <!--期限/優先度フォーム-->
            <input type="text" name="title" value="{{ old('title') }}" placeholder="タスクを入力">
            <input type="date" name="due_date" value="{{ old('due_date')}}">
            <select name="priority">
                <option value="high" {{ old('priority')==='high'?'selected':'' }}>
                    高
                </option>
                <option value="medium" {{ old('priority','medium')==='medium'?'selected':'' }}>
                    中
                </option>
                <option value="low" {{ old('priority')==='low'?'selected':'' }}>
                    低
                </option>
            </select>

            <button type="submit">追加</button>
        </form>
        </div>
    </header>

    <!--タスク一覧表示-->
    <main class="tasks">
    <!--メッセージ-->
    <p>「{{ $keyword }}/{{ $status }}」の検索結果： {{ $todos->count() }}件の表示</p>
    @if($todos->isEmpty())
        <p>該当するTodoがありません。</p>
    @endif

    <!--各タスク表示-->
    @foreach($todos as $todo)
        <!--タスク完了/未完了判定-->
        <div class="task-column">
            <div class="task-content">
                @if($todo->completed)
                    <p>Θ　{{$todo->title}}</p>
                @else
                    <p>Ο　{{$todo->title}}</p>
                @endif

                <div class="d-flex text-muted small gap-4">
                <p>期限：{{$todo->due_date ?? 'なし'}}</p>
                <p>優先度：{{$todo->priority}}</p>
                </div>
            </div>

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
                <form action="/todos/{{$todo->id}}/edit" method="GET" style="display: inline;">
                    <input type="hidden" name="keyword" value="{{ $keyword }}">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <button type="submit">編集</button>
                </form>
            </div>
        </div>
    @endforeach

    <!--検索フォーム-->
    <form action="{{ route('todos.search')}}" method="GET">
        <button type="submit">検索</button>
    </form>
    </main>

    </div>
</body>
</html>
