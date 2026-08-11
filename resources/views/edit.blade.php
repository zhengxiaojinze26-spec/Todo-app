<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>編集画面</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="container">

    <header>
        <h1>編集画面</h1>

        <div class="header-form">
        <p>タスク名を変更してください。</p>

        <!--編集フォーム-->
        <form action="/todos/{{$todo->id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{$todo->title}}">
            <button type="submit">更新</button>
        </form>
        </div>
    </header>

    <!--タスク一覧表示-->
    <div class="tasks">
    @foreach($todos as $task)

        <div class="task-column {{$task->id===$todo->id ? 'editing' : ''}}">
            <div class="task-content">
                @if($task->completed)
                    <p>Θ　{{$task->title}}</p>
                @else
                    <p>Ο　{{$task->title}}</p>
                @endif

            </div>
        </div>

    @endforeach
    </div>

    <!--トップページに戻る-->
    <form class="back" action="/" Method="get">
        <button type="submit">戻る</button>
    </form>
    </div>
</body>
</html>
