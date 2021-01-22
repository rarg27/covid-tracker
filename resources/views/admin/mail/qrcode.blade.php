<!doctype html>
<html lang="en">
<head>
    <title>Brgy. Bagbag Covid Tracker | QR Code</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-sm-12 m-auto">
            <p>The attached image is your QR Code Identifier for Brgy. Bagbag's Covid Tracking System.</p>
            <br />
            <p>Print and always keep it when you are commuting with our good KGSP TODA tricycle drivers.</p>
            <br />
            <br />
            <p>Best Regards,</p>
            <p>Brgy. Bagbag</p>
            <img src="{{ $message->embedData($qrCode, 'qr_code.png') }}" alt="QR Code">
        </div>
    </div>
</div>
</body>
</html>