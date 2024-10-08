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

        // document.getElementById('registration').addEventListener('click', function() {

        //     document.getElementById('register-box').style.display = 'none';
        //     document.getElementById('login-box').style.display = 'block';
        // });

        document.addEventListener('DOMContentLoaded', function() { //Registration button clickability
            const registerBox = document.getElementById('register-box');
            const inputs = registerBox.querySelectorAll('.input-field');
            const registrationButton = document.getElementById('registration');
            console.log("hallo");
            function checkInputs() {
                let allFilled = true;
                inputs.forEach(input => {
                    if (input.value.trim() === '') {
                        allFilled = false;
                        alert('Please fill in all fields');
                        console.log('Please fill in all fields');
                    }
                });
                registrationButton.disabled = !allFilled;
            }

            inputs.forEach(input => {
                input.addEventListener('input', checkInputs);
            });

            checkInputs();
        });
    </script>
</body>

</html>