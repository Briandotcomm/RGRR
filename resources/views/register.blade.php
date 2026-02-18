<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - RGRR WebMaker</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (for eye icon) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Your existing styles -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body class="bg-dark text-light">

<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-7 col-lg-5">

            <div class="card bg-black border-secondary shadow-lg">
                <div class="card-body p-4">

                    <h4 class="text-center mb-4">Student Registration</h4>

                    <form method="POST" action="{{ route('register.process') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" required>
                        </div>

                        <!-- School -->
                        <div class="mb-3">
                            <label class="form-label">School Name / Address</label>
                            <input type="text" name="school" class="form-control form-control-sm" required>
                        </div>

                        <!-- Year Level -->
                        <div class="mb-3">
                            <label class="form-label">School Year / Level</label>
                            <select name="year_level" class="form-control form-control-sm">
                                <option value="">Select Year Level</option>
                                <option>1st Year</option>
                                <option>2nd Year</option>
                                <option>3rd Year</option>
                                <option>4th Year</option>
                            </select>
                        </div>

                        <!-- Hours -->
                        <div class="mb-3">
                            <label class="form-label">Number of Hours to Render</label>
                            <input type="number" name="hours" class="form-control form-control-sm" required>
                        </div>

<!-- Create Password -->
<div class="mb-3">
    <label class="form-label">Create Password</label>
    <input type="password" name="password" id="password" class="form-control form-control-sm" required>
</div>

<!-- Confirm Password -->
<div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" id="confirmPassword" class="form-control form-control-sm" required>
</div>



                        <!-- Document -->
                        <div class="mb-4">
                            <label class="form-label">Attach MOA / Document</label>
                            <input type="file" name="document" class="form-control form-control-sm">
                        </div>
                        <!-- Terms and Conditions Checkbox -->
<div class="mb-4 form-check">
    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
    <label class="form-check-label" for="terms">
        I have read and agree to the <a href="#" class="text-decoration-underline">Terms and Conditions</a>
    </label>
</div>


                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="/" class="btn btn-outline-secondary btn-sm px-4">
                                Back
                            </a>

                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                Proceed
                            </button>
                        </div>

                    </form>

                    

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Password Visibility Toggle -->
<script>
    function togglePassword(fieldId, eyeId) {
        const field = document.getElementById(fieldId);
        const eye = document.getElementById(eyeId);

        if (field.type === "password") {
            field.type = "text";

            eye.classList.remove("bi-eye");
            eye.classList.add("bi-eye-slash");
            eye.style.color = "#0d6efd"; 
        } else {
            field.type = "password";

           
            eye.classList.remove("bi-eye-slash");
            eye.classList.add("bi-eye");
            eye.style.color = ""; 
        }
    }
</script>

</body>
</html>
