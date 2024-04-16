<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Reset styles */
        body,
        html,
        .body {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
        }

        /* Responsive grid */
        .container {
            width: 100%;
            margin: 0;
            padding: 0;
            border: 0;
        }

        /* Top header */
        .header {
            color: #333333;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            border: 0;
            text-align: left;
        }

        /* Main content */
        .content {
            margin: 0;
            padding: 0;
            border: 0;
            text-align: left;
            color: #333333;
            background-color: #ffffff;
        }

        /* Button styles */
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Footer */
        .footer {
            text-align: left;
            margin: 0;
            padding: 0;
            border: 0;
            color: #333333;
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="header">
                <h1>Thank you for your registration, and welcome to our website!</h1>
            </div>
            <div class="content">
                <p>Dear {{ $username }} ,<br>
                    Thank you for joining our community! We're thrilled to have you on board.<br>
                    Feel free to explore our site and discover all the amazing features we have to offer.<br>
                    If you have any questions or need assistance, please don't hesitate to contact us.</p>
            </div>
            <div class="footer">
                <br>
                <p>Best Regards,<br> Finance team!</p>
            </div>
        </div>
    </div>
</body>

</html>
