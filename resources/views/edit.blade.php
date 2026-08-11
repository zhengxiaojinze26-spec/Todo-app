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

        <div class="index-form">
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

    </div>
</body>
</html>
