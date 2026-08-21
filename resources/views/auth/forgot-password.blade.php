<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>パスワードリクエスト</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <div class="container">
    <header>
        <h1>パスワードリセット</h1>
    </header>

    <!--セッションステータス-->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="mt-4 d-flex text-muted">
        パスワードを忘れた場合、登録時のメールアドレスを入力することでパスワードリセット用のリンクを送ることができます。
    </div>

    <main class="forgot-main d-flex justify-content-center align-items-end">
    <form class="w-75" method="POST" action="{{route('password.email')}}">
        @csrf

        <!--メールアドレス入力フォーム-->
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{old('email')}}"
            class="form-control @error('email') is-invalid @enderror"
            required autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <!--リンク送信-->
        <div class="d-flex justify-content-end align-items-center mt-4">
            <button type="submit" class="btn btn-primary">
                リンクを送信
            </button>
        </div>
    </form>
    </main>

    <!--ログイン画面に戻る-->
    <form class="mt-5" action="{{route('login')}}" method="GET">
        <button type="submit">戻る</button>
    </form>

    </div>
</body>
</html>
