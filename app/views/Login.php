<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Pizzaservice/app/style/style.css">
    <script src="/Pizzaservice/app/shared.js"></script>
    <title>Login</title>
</head>

<body>
<div id="register-box" class="register-box" style="display: none;">
        <h1>Registrieren</h1>

        <div class="input-group">
            <input type="text" placeholder="Name">
            <input type="text" placeholder="Stadt">
        </div>

        <div class="input-group">
            <input type="text" placeholder="Nachname">
            <input type="text" placeholder="Postleitzahl">
        </div>

        <div class="input-group">
            <input type="password" placeholder="Passwort">
            <input type="text" placeholder="Straße">
        </div>

        <div class="input-group">
            <input type="password" placeholder="Passwort bestätigen">
            <input type="text" placeholder="Hausnummer">
        </div>

        <button type="submit" class="action-button">Registrieren</button>
    </div>

    <div id="login-box" class="login-box">
        <h1>Login</h1>
        <div class="divider"></div>
        
        <input type="text" placeholder="Name">
        <input type="password" placeholder="Passwort">
        <button type="submit" class="action-button">Login</button>

        <div class="divider"></div>

        <p>Noch keinen Account?</p>
        <button type="button" class="action-button" id="show-register">Registrieren</button>
    </div>
    <script>
        document.getElementById('show-register').addEventListener('click', function() {
            document.getElementById('login-box').style.display = 'none';
            document.getElementById('register-box').style.display = 'block';
        });

        document.getElementById('show-login').addEventListener('click', function() {
            document.getElementById('register-box').style.display = 'none';
            document.getElementById('login-box').style.display = 'block';
        });
    </script>
</body>

</html>