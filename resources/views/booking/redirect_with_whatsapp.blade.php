<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Booking...</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        .loader {
            text-align: center;
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        h2 {
            color: #333;
            margin: 10px 0;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="loader">
        <div class="spinner"></div>
        <h2>{{ $message }}</h2>
        <p>Opening WhatsApp and redirecting...</p>
    </div>

    <script>
        // Open WhatsApp in new tab immediately
        window.open("{{ $whatsappUrl }}", '_blank');

        // Redirect current page after a short delay
        setTimeout(function() {
            window.location.href = "{{ $redirectUrl }}";
        }, 1000); // 1 second delay so WhatsApp has time to open
    </script>
</body>
</html>
