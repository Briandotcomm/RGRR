<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - RGRR WebMaker</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your existing styles -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body class="bg-dark text-light">

<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-7 col-lg-5">

            <div class="card bg-black border-secondary shadow-lg">
                <div class="card-body p-5">

                    <h3 class="text-center mb-4">Student Registration</h3>

                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- School -->
                        <div class="mb-3">
                            <label class="form-label">School Name / Address</label>
                            <input type="text" name="school" class="form-control" required>
                        </div>

                        <!-- Year Level -->
                        <div class="mb-3">
                            <label class="form-label">School Year / Level</label>
                            <select name="year_level" class="form-control">
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
                            <input type="number" name="hours" class="form-control" required>
                        </div>

                        <!-- Document -->
                        <div class="mb-4">
                            <label class="form-label">Attach MOA / Document</label>
                            <input type="file" name="document" class="form-control">
                        </div>

                        <!-- Buttons -->
                      <div class="d-flex justify-content-between mt-3">
    <a href="/" class="btn btn-outline-secondary px-4 py-1">
        Back
    </a>

    <button type="submit" class="btn btn-primary px-4 py-1">
        Proceed
    </button>
</div>


                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
