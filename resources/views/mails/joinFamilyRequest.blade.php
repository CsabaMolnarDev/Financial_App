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
                <h1>{{ $username }} has invited you into there family!</h1>
            </div>
            <div class="content">
                <p>To accept the invitation, please click the following link:</p>
                <a href="{{ route('family.acceptInvitation', ['token' => $invitation->token]) }}">Accept Invitation</a>
            </div>
            <div class="footer">
                <br>
                <p>Best Regards,<br> Finance team!</p>
            </div>
        </div>
    </div>
</body>

</html>
