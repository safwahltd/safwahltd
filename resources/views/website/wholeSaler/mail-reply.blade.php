<!DOCTYPE html>
<html>
<head>
    <title>Become Wholesaler</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            background-color: #ffffff;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #28a745;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
        }

        .email-body {
            padding: 30px;
        }

        .email-body h2 {
            color: #333;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .email-body p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .email-body .content-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .email-body .message {
            background-color: #f9f9f9;
            padding: 15px;
            border-left: 5px solid #28a745;
            font-style: italic;
        }

        .email-footer {
            padding: 20px;
            text-align: center;
            background-color: #f4f4f4;
            color: #777;
            font-size: 14px;
        }

        .email-footer a {
            color: #28a745;
            text-decoration: none;
        }
        .ms-5{
            margin-left: 12px;
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <!-- Email Header -->
    <div class="email-header">
        Your Request Submitted Successfully.
    </div>
    <!-- Email Body -->
    <div class="email-body">
        <p><span class="content-label">Your Submitted : </span></p>
        <p class="message">
            <p class="ms-5"><span class="content-label">Name :</span> {{ $data['name'] }}</p>
            <p class="ms-5"><span class="content-label">Phone :</span> {{ $data['phone'] }}</p>
            <p class="ms-5"><span class="content-label">Email :</span> {{ $data['email'] }}</p>
            <p class="ms-5"><span class="content-label">Subject :</span> {{ $data['subject'] }}</p>
            <p class="ms-5"><span class="content-label">Message :</span></p>
            <p class="message ms-5">{{ $data['message'] }}</p>
            <p class="ms-5">If You Have Any Query Feel Free To Reply This Mail.Thank You.</p>
        </p>
    </div>
    <!-- Email Footer -->
    <div class="email-footer">
        &copy; {{ date('Y') }} SAFWAH LIMITED. All rights reserved.<br>
        <a href="{{route('website.index')}}">Visit our website</a>
    </div>
</div>
</body>
</html>


