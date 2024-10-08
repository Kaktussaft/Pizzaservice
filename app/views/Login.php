<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Pizzaservice/app/style/Shared.css">
    <link rel="stylesheet" href="/Pizzaservice/app/style/Login.css">
    <script src="/Pizzaservice/app/Shared.js"></script>
    <script src="/Pizzaservice/app/Api.js"></script>
    <title>Login</title>
</head>

<body>
    <div id="register-box" class="register-box" style="display: none;">
        <h1>Registrieren</h1>

        <div class="input-group">
            <input id="Name" type="text" placeholder="Name">
            <input id="Stadt" type="text" placeholder="Stadt">
        </div>

        <div class="input-group">
            <input id="Nachname" type="text" placeholder="Nachname">
            <input id="Postleitzahl" type="text" placeholder="Postleitzahl">
        </div>

        <div class="input-group">
            <input id="Passwort" type="password" placeholder="Passwort">
            <input id="Straße" type="text" placeholder="Straße">
        </div>

        <div class="input-group">
            <input id="Passwort bestätigen" type="password" placeholder="Passwort bestätigen">
            <input id="Hausnummer" type="text" placeholder="Hausnummer">
        </div>

        <button id="registration" type="submit" class="action-button">Registrieren</button>
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

        document.getElementById('registration').addEventListener('click', function() {
            const registerBox = document.getElementById('register-box');
            const inputs = registerBox.querySelectorAll('input[type="text"], input[type="password"]');
            const registrationButton = document.getElementById('registration');

            password = document.getElementById('Passwort').value;
            passwordConfirm = document.getElementById('Passwort bestätigen').value;

            if (!passwordMatches(password, passwordConfirm)) {
                alert('Passwörter stimmen nicht überein');
                return;
            }

            if (!checkInputs(inputs)) {
                alert('Bitte füllen Sie alle Felder aus');
                return;
            }

            const data = {
                name: document.getElementById('Name').value,
                surname: document.getElementById('Nachname').value,
                password: password,
                city: document.getElementById('Stadt').value,
                postal_code: document.getElementById('Postleitzahl').value,
                street: document.getElementById('Straße').value,
                house_number: document.getElementById('Hausnummer').value
            };

            backendCall('UserController', 'register', data)
                .then(response => {
                    if (response === 'User already exists') {
                        alert('User already exists');
                    } else {
                        alert('User created');
                    }
                });

            document.getElementById('register-box').style.display = 'none';
            document.getElementById('login-box').style.display = 'block';
        });

        function checkInputs(inputs) {
            for (let input of inputs) {
                if (input.value.trim() === '') {
                    return false;
                }
            }
            return true;
        }

        function passwordMatches(password, passwordConfirm) {
            return password === passwordConfirm;
        }
    </script>
</body>

</html>