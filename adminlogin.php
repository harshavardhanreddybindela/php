<!DOCTYPE html>
<html>
<head>
    <title>It's Your Birthday Inc Admin - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 80vh;
            background: url('') no-repeat center center;
            background-size: cover;
        }
        .form_div {
            width: 300px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
        }
        .form_div label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .field_class {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
        }
        .submit_class {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ffa500;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .submit_class:hover {
            background-color: #ff7f00;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            box-shadow: 0px -5px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>It's Your Birthday Inc Admin - Login</h1>
        </header>
        <main>
            <form method="POST" action="admin_auth.php">
                <div class="form_div">
                    <label for="login_txt">Login:</label>
                    <input class="field_class" name="login_txt" id="login_txt" type="text" placeholder="Enter User Id" autofocus>
                    <hr>
                    <label for="password_txt">Password:</label>
                    <input id="pass" class="field_class" name="password_txt" id="password_txt" type="password" placeholder="Enter Password">
                    <hr>
                    <button type="submit" class="submit_class" name="submit" id="submit">Login</button>
                </div>
            </form>
        </main>
        <footer>
            <p>&copy; 2023 It's Your Birthday Inc.| <a href="#">Privacy Policy</a></p>
        </footer>
    </div>
</body>
</html>