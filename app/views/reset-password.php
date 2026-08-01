<?php
session_start();
$token = $_GET['token'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Changer le mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2b376b;
            margin-bottom: 25px;
        }

        label {
            font-size: 15px;
            color: #333;
        }

        input {
            width: 100%;
            height: 40px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 0 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            height: 42px;
            background: #2b376b;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #1d2650;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Créer un nouveau mot de passe</h2>
        <form method="POST">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <label>Nouveau mot de passe :</label>
            <input type="password" name="password" required>
            <button type="submit"> Changer le mot de passe</button>
        </form>
    </div>
</body>
</html>