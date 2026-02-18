<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - RGRR WebMaker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body class="bg-dark text-light">

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-4">

            <div class="card bg-black border-secondary shadow-lg">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Member Login</h3>

                    <form method="POST" action="{{ route('login.perform') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small>
                            No account yet?
                            <a href="/register">Register</a>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
