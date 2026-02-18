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
            background: #0f172a;
            color: #fff;
        }

        .payment-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .payment-card {
            background: #1e293b;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }

        .payment-option {
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 20px;
            cursor: pointer;
            transition: 0.3s ease;
            text-align: center;
        }

        .payment-option:hover {
            border-color: #6366f1;
            background: #0f172a;
        }

        .active-option {
            border-color: #6366f1;
            background: #0f172a;
        }

        .hidden-section {
            display: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
        }
    </style>
</head>
<body>

<div class="container payment-container">
    <div class="row justify-content-center w-100">
        <div class="col-lg-7">

            <div class="payment-card">

                <h3 class="text-center mb-4">Complete Your Registration</h3>

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

                <!-- ================= CASH SECTION ================= -->
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

                <!-- ================= GCASH SECTION ================= -->
                <div id="gcashSection" class="hidden-section mt-4">

                    <div class="text-center mb-4">
                        <p>Scan the QR Code below:</p>
                        <img src="{{ asset('assets/gcash-qr.png') }}"
                             alt="GCash QR Code"
                             class="img-fluid"
                             style="max-width:250px;">
                    </div>

                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="payment_method" value="gcash">

                        <!-- Reference Number -->
                        <div class="mb-3">
                            <label class="form-label">GCash Reference Number</label>
                            <input type="text" name="reference_number" class="form-control" required>
                        </div>

                        <!-- Upload Proof -->
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
