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

            <input type="hidden" name="keyword" value="{{ $keyword }}">
            <input type="hidden" name="status" value="{{ $status}}">

            <input type="text" name="title" value="{{$todo->title}}">
            <input type="date" name="due_date" value="{{$todo->due_date}}">
            <select name="priority">
                <option value="high" {{ $todo->priority==='high'?'selected':''}}>
                    高
                </option>
                <option value="medium" {{ $todo->priority==='medium'?'selected':''}}>
                    中
                </option>
                <option value="low" {{ $todo->priority==='low'?'selected':''}}>
                    低
                </option>
            </select>

            <button type="submit">更新</button>
        </form>
        </div>
    </header>

    <!--タスク一覧表示-->
    <main class="tasks">
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
    </main>

    </div>
</body>
</html>
