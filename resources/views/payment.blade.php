<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - RGRR WebMaker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: radial-gradient(circle at top left, #1e293b, #0f172a 60%);
        color: #fff;
        font-family: 'Inter', sans-serif;
    }

    .payment-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .payment-card {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.6);
        position: relative;
        overflow: hidden;
    }

    .payment-card::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(99,102,241,0.3), transparent 70%);
        top: -100px;
        right: -100px;
        z-index: 0;
    }

    .payment-card * {
        position: relative;
        z-index: 1;
    }

    h3 {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .payment-option {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 30px 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        height: 100%;
    }

    .payment-option h5 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .payment-option p {
        font-size: 14px;
        opacity: 0.7;
        margin-bottom: 0;
    }

    .payment-option:hover {
        transform: translateY(-6px);
        border-color: #6366f1;
        box-shadow: 0 10px 30px rgba(99,102,241,0.3);
    }

    .active-option {
        border-color: #6366f1;
        background: linear-gradient(145deg, rgba(99,102,241,0.15), rgba(15,23,42,0.9));
        box-shadow: 0 10px 35px rgba(99,102,241,0.4);
    }

    .hidden-section {
        display: none;
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert {
        border-radius: 12px;
        border: none;
    }

    .form-control {
        background: rgba(15, 23, 42, 0.9);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        border-radius: 10px;
        padding: 10px 14px;
    }

    .form-control:focus {
        background: rgba(15, 23, 42, 0.95);
        border-color: #6366f1;
        box-shadow: 0 0 0 0.2rem rgba(99,102,241,0.25);
        color: #fff;
    }

    .form-label {
        font-size: 14px;
        opacity: 0.8;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59,130,246,0.4);
    }

.btn-success {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    border: none;
    border-radius: 12px;
    padding: 12px;
    font-weight: 600;
    transition: 0.3s ease;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(99,102,241,0.4);
}

    a.text-secondary {
        text-decoration: none;
        opacity: 0.6;
        transition: 0.3s;
    }

    a.text-secondary:hover {
        opacity: 1;
        color: #8b5cf6 !important;
    }

    img {
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    }
</style>

</head>
<body>

<div class="container payment-container">
    <div class="row justify-content-center w-100">
        <div class="col-lg-7">

            <div class="payment-card">

                <h3 class="text-center mb-4">Complete Your Registration</h3>

                <!-- SUCCESS MESSAGE -->
                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>

                    @if(session('redirect'))
                        <script>
                            setTimeout(() => {
                                window.location.href = "{{ session('redirect') }}";
                            }, 5000); // Redirect after 5 seconds
                        </script>
                    @endif
                @endif

                <p class="text-center mb-5">
                    Please choose your preferred payment method to activate your student account.
                </p>

                <!-- Payment Options -->
                <div class="row mb-4">
                    <!-- CASH -->
                    <div class="col-md-6 mb-3">
                        <div id="cashOption" class="payment-option" onclick="selectCash()">
                            <h5>Cash Payment</h5>
                            <p>Pay directly at the RGRR WebMaker office.</p>
                        </div>
                    </div>

                    <!-- GCASH -->
                    <div class="col-md-6 mb-3">
                        <div id="gcashOption" class="payment-option" onclick="selectGCash()">
                            <h5>GCash</h5>
                            <p>Scan QR code and upload proof of payment.</p>
                        </div>
                    </div>
                </div>

                <!-- CASH SECTION -->
                <div id="cashSection" class="hidden-section mt-4">
                    <div class="alert alert-info">
                        Please visit the RGRR WebMaker office to complete your payment.
                        Your account will remain <strong>Pending</strong> until payment is confirmed by the admin.
                    </div>

                    <form method="POST" action="{{ route('payment.process') }}">
                        @csrf
                        <input type="hidden" name="payment_method" value="cash">
                        <button type="submit" class="btn btn-primary w-100">
                            Confirm Cash Payment Selection
                        </button>
                    </form>
                </div>

                <!-- GCASH SECTION -->
                <div id="gcashSection" class="hidden-section mt-4">
                    <div class="text-center mb-4">
                        <p>Scan the QR Code below:</p>
                        <img src="{{ asset('assets/qrcode.jpg') }}"
                             alt="GCash QR Code"
                             class="img-fluid"
                             style="max-width:250px;">
                    </div>

                    <form method="POST" action="{{ route('payment.process') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="payment_method" value="gcash">

                        <div class="mb-3">
                            <label class="form-label">GCash Reference Number</label>
                            <input type="text" name="reference_number" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Upload Proof of Payment</label>
                            <input type="file" name="proof_of_payment" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Submit Payment Details
                        </button>
                    </form>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('register') }}" class="text-secondary">
                        ← Back to Registration
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    function selectCash() {
        document.getElementById('cashSection').style.display = 'block';
        document.getElementById('gcashSection').style.display = 'none';
        document.getElementById('cashOption').classList.add('active-option');
        document.getElementById('gcashOption').classList.remove('active-option');
    }

    function selectGCash() {
        document.getElementById('gcashSection').style.display = 'block';
        document.getElementById('cashSection').style.display = 'none';
        document.getElementById('gcashOption').classList.add('active-option');
        document.getElementById('cashOption').classList.remove('active-option');
    }
</script>

</body>
</html>
