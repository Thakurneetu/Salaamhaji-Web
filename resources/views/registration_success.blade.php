<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        /* Dark Theme Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Modern font */
            background-color: #121212; /* Dark background */
            color: #ffffff; /* White text */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #222222; /* Darker container background */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7); /* More pronounced shadow */
            text-align: center;
        }

        h1 {
            color: #0EFF06; /* Teal success color */
            margin-bottom: 20px;
            font-size: 36px;
            letter-spacing: 1px;
        }

        p {
            font-size: 18px;
            color: #eeeeee;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            border-radius: 50%;
            background-color: #0EFF06; /* Teal checkmark background */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkmark::after {
            content: '\2713'; /* Checkmark symbol */
            font-size: 60px;
            color: #121212; /* Dark checkmark color */
        }

        /* Glowing Animation */
        @keyframes glowing {
            0% { box-shadow: 0 0 5px #0EFF06; }
            50% { box-shadow: 0 0 30px #0EFF06; }
            100% { box-shadow: 0 0 5px #0EFF06; }
        }

        .glowing-button {
            animation: glowing 2s infinite;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="checkmark glowing-button"></div>
        <h1>Registration Successful!</h1>
        <p>Thank you for registering as a vendor. We have received your information and will be in touch soon.</p>
    </div>

</body>
</html>
