<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - ShadiKarwao</title>
    <link rel="icon" type="image/png" href="/ShadiKarwao/logo.png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
        }
        h1 { 
            font-size: 2.5em; 
            color: #dc3545; 
            margin: 10px 0;
        }
        p { 
            font-size: 1.2em; 
            margin: 10px 0; 
            line-height: 1.6;
        }
        .button {
            background-color: #007bff; 
            color: white; 
            padding: 10px 20px; 
            text-decoration: none; 
            border-radius: 5px; 
            transition: background-color 0.3s, transform 0.2s;
            font-size: 1em;
        }
        .button:hover {
            background-color: #0056b3; 
            transform: scale(1.05);
        }
        .image-container {
            margin-bottom: 20px;
        }
        .image-container img {
            max-width: 150px; 
            height: auto; 
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            h1 {
                font-size: 2em;
            }
            p {
                font-size: 1em;
            }
            .button {
                padding: 8px 15px;
                font-size: 0.9em;
            }
            .image-container img {
                max-width: 120px;
            }
        }

        @media (max-width: 450px) {
            h1 {
                font-size: 1.5em;
            }
            p {
                font-size: 0.9em;
            }
            .button {
                padding: 6px 12px;
                font-size: 0.85em;
            }
            .image-container img {
                max-width: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="image-container">
        <img src="/ShadiKarwao/logo.png" alt="ShadiKarwao Logo">
    </div>
    <h1>404 Not Found</h1>
    <p>Oops! The page you are looking for was not found.</p>
    <p>It seems we can’t find what you’re looking for.</p>
    <a href="http://localhost/ShadiKarwao/home.php" class="button">Go to Homepage</a>
</body>
</html>