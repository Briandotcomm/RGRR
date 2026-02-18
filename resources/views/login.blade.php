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

                        <!-- Email -->
                        <div class="mb-3">
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control"
                                placeholder="Email"
                                required
                            >
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control"
                                placeholder="Password"
                                required
                            >
                        </div>

                        <!-- Remember Me + Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="remember" 
                                    id="remember"
                                >
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <a href="/forgot-password" class="small text-decoration-none">
                                Forgot password?
                            </a>

                        </div>

                        <!-- Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>

                    </form>

                    <div class="text-center">
                        <small>
                            No account yet?
                            <a href="/register" class="text-decoration-none">Register</a>
                        </small>
                    </div>

                    <div class="text-center mt-3">
                        <a href="/" class="btn btn-outline-secondary btn-sm">
                            ← Back to Landing Page
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
