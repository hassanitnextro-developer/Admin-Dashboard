<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Biz Admin is a Multipurpose bootstrap 4 Based Dashboard & Admin Site Responsive Template by uxliner." />
    <meta name="keywords"
        content="admin, admin dashboard, admin template, cms, crm, Biz Admin, Biz Adminadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="uxliner" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/et-line-font/et-line-font.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simple-lineicon/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/_all-skins.min.css') }}">

    <style>
        /* ✅ Remove scrollbars & make page fill viewport */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* ✅ Background image full screen */
        body.login-page {
            background: url('{{ asset('uploads/19.png') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ✅ Center login box nicely */
        .login-box {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .login-box h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }
    </style>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-box-body">
            <h3 class="login-box-msg">Admin Login</h3>
            @if (session('fail'))
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <label>Enter your Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group has-feedback">
                    <label>Enter your password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
            </form>
        </div>
    </div>

    <!-- jQuery 3 -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>
