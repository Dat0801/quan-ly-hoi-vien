<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-fluid {
            background-image: url('/images/BG-error.png');
            background-color: #FFE3CD;
            background-size: cover;
            background-position: center;
            border-radius: 24px 0 0 0;
            height: 100vh;
            position: relative;
        }
        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            text-align: center;
        }
        h1 {
            font-size: 48px;
            margin-top: 20px;
            text-transform: uppercase;
            color: #803B03;
        }
        p {
            font-size: 20px;
            margin: 15px 0;
        }
        .btn-go-back {
            background-color: #FF7506; 
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            width: 100%; 
        }

        .btn-go-back:hover {
            background-color: #FF5722; 
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 80px;
        }
        .copyright {
            position: absolute;
            bottom: 10px;
            left: 20px;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <img src="/images/logo.png" alt="Logo" class="logo">
        
        <div class="content">
            <img src="/images/404-error.png" alt="404 Error" class="img-fluid mb-4">
            <h1>Oops! Page Not Found</h1>
            <p>Sorry, we couldn't find the page you are looking for.</p>
            <a href="{{ url('/') }}" class="btn btn-go-back">Go Back</a>
        </div>
        
        <div class="copyright">
            Copyright &copy; 2020 Alta Software
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
