<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Reset styles */
        body, html, .body {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* Responsive grid */
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0 20px;
            max-width: 580px;
        }

        /* Top header */
        .header {
            background-color: #333333;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        /* Main content */
        .content {
            padding: 20px 0;
            text-align: center;
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
            text-align: center;
            padding: 20px 0;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <table class="body">
        <tr>
            <td class="container">
                <!-- Header -->
                <table class="row header">
                    <tr>
                        <td class="wrapper">
                            <h1 style="text-align: center;">Welcome to Our Site</h1> <!-- Centering the title -->
                        </td>
                    </tr>
                </table>

                <!-- Content -->
                <table class="row content">
                    <tr>
                        <td class="wrapper">
                            <p>Dear {{-- {{ $user->name }} --}},</p>
                            <p>Thank you for joining our community! We're thrilled to have you on board.</p>
                            <p>Feel free to explore our site and discover all the amazing features we have to offer.</p>
                        </td>
                    </tr>
                </table>

                <!-- Footer -->
                <table class="row footer">
                    <tr>
                        <td class="wrapper">
                            <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
                            <p>Best Regards,<br> The Our Site Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
