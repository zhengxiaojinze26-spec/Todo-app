<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>login</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <div class="container">

    <header>
        <h1>ログイン画面</h1>
    </header>

    <main class="login-main d-flex justify-content-center align-items-center">
    <form class="w-75" method="POST" action="{{route('login')}}">
        @csrf

        <!--メールアドレス入力フォーム-->
        <div class="mb-4">
            <label for="email" class="form-label">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{old('email')}}"
            class="form-control @error('email') is-invalid @enderror"
            required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <!--パスワード入力フォーム-->
        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input id="password" type="password" name="password"
            class="form-control @error('password') is-invalid @enderror"
            required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <!--セッション維持-->
        <div class="mb-5 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">ログイン状態を維持する</label>
        </div>

        <!--パスワードリクエスト-->
        <div class="d-flex align-items-center justify-content-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-decoration-underline small text-muted me-3"
                href="{{Route('password.request')}}">パスワードを忘れた場合はこちら</a>
            @endif

            <button type="submit" class="btn btn-primary">
                {{__('Log in')}}
            </button>
        </div>

    </form>
    </main>

    </div>
</body>
</html>
