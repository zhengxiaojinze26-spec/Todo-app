<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Todo検索</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <div class="container">
    <header>
        <h1>Todo検索</h1>
        <p class="text-secondary">検索したいTodoを入力してください。</p>

        <form class="ms-3" action="{{ route('todos.index') }}" method="GET">
            <input type="text" name="keyword" placeholder="Todoを検索">

            <select name="status">
                <option value="all">すべて</option>
                <option value="incomplete">未完了</option>
                <option value="completed">完了済み</option>
            </select>

            <button type="submit" class="btn btn-success btn-sm">検索</button>

            <div class="d-flex align-items-center mt-3">
                <label for="sort" class="me-2">並べ替えオプション:</label>

                <select id="sort" name="sort">
                    <option value="latest">新しい順</option>
                    <option value="due_date">期限が近い順</option>
                    <option value="priority">優先度が高い順</option>
                </select>

            </div>
        </form>
    </header>

    <main class="d-flex min-vh-100">
    <!--トップページに戻る-->
    <form class="back align-items-center mt-5 w-100" action="/" Method="get">
        <button type="submit" class="btn btn-secondary">戻る</button>
    </form>
    </main>

    </div>
</body>
</html>
