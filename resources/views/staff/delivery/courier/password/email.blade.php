@component('mail::message')

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Password Reset Request</div>
                <div class="card-body">
                    <p>You requested a password reset. Click the button below to reset your password.</p>
                    <a href="{{ $object->url }}" class="btn btn-primary">Reset Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

@endcomponent