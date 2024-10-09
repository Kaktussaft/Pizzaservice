<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Pizzaservice/app/style/Shared.css">
    <link rel="stylesheet" href="/Pizzaservice/app/style/Orderpage.css">
    <script src="/Pizzaservice/app/Shared.js"></script>
    <script src="/Pizzaservice/app/Api.js"></script>
    <title>Orderpage</title>
</head>

<body>
    <div class="navigation">
        <button id="Receipt" class="navigation-button" type="submit">Rechnung</button>
        <button id="Logout" class="navigation-button" type="submit">Logout</button>
    </div>

    <div class="order-box">
        <div class="container">
            <h1 class="h1-formatting">Pizzaservice</h1><br>
        </div>

        <div class="grid-container">
            <div class="grid-item label-row label-create-pizza">Pizza selber Zusammenstellen</div>
            <div class="grid-item label-row label-create-pizza">Pizza auswählen</div>

            <div class="grid-item content-row">
                <div class="grid-container-equal-split" id="custom-pizza">
                    <div>
                        <label class="checkbox-label checkbox-top-label">
                            <input type="checkbox" name="zutaten[]" value="Tomatensauce">
                            <img src="/Pizzaservice/app/ressources/tomatensauce.jpeg" alt="Tomatensauce" class="ingredient-image"> Tomatensauce
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="zutaten[]" value="Mozzarella">
                            <img src="/Pizzaservice/app/ressources/mozzarella.jpeg" alt="Mozzarella" class="ingredient-image"> Mozzarella
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="zutaten[]" value="Salami">
                            <img src="/Pizzaservice/app/ressources/salami.jpeg" alt="Salami" class="ingredient-image"> Salami
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="zutaten[]" value="Schinken">
                            <img src="/Pizzaservice/app/ressources/schinken.jpeg" alt="Schinken" class="ingredient-image"> Schinken
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="zutaten[]" value="Pilze">
                            <img src="/Pizzaservice/app/ressources/pilze.jpeg" alt="Pilze" class="ingredient-image"> Pilze
                        </label>
                    </div>
                    <div>
                        <label class="checkbox-label checkbox-top-label">
                            <input type="checkbox" name="zutaten[]" value="Zwiebeln">
                            <img src="/Pizzaservice/app/ressources/zwiebeln.jpeg" alt="Zwiebeln" class="ingredient-image"> Zwiebeln
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="zutaten[]" value="Paprika">
                            <img src="/Pizzaservice/app/ressources/paprika.jpeg" alt="Paprika" class="ingredient-image"> Paprika
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="zutaten[]" value="Oliven">
                            <img src="/Pizzaservice/app/ressources/oliven.jpeg" alt="Oliven" class="ingredient-image"> Oliven
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="zutaten[]" value="Speck">
                            <img src="/Pizzaservice/app/ressources/speck.jpeg" alt="Speck" class="ingredient-image"> Speck
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="zutaten[]" value="Thunfisch">
                            <img src="/Pizzaservice/app/ressources/thunfisch.jpeg" alt="Thunfisch" class="ingredient-image"> Thunfisch
                        </label>
                    </div>
                    <textarea id="message" type="text" class="message" placeholder="Nachricht an den Koch"></textarea>

                </div>

            </div>

            <div class="grid-item content-row">
                <select class="pizza-select" id="non-custom-pizza">
                    <option>Margherita </option>
                    <option> Pepperoni </option>
                    <option> Supreme </option>
                    <option> BBQ </option>
                    <option> Tonno </option>
                    <option> Prosciutto </option>
                    <option> Vegetarisch </option>
                </select>
            </div>

            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close-button" id="closeButton">&times;</span>
                    <h2>Bestellübersicht</h2>
                    <p>Hier ist Ihre Bestellung:</p>

                </div>
            </div>

        </div>
        <div class="grid-container-three-way">
            <button id="order" class="orderpage-button" type="submit">zur Bestellung hinzufügen</button>
            <button class="orderpage-button" type="button" id="orderButton">Meine Bestellung</button>
            <button class="orderpage-button" type="button">Bestellen</button>
        </div>

    </div>




    <script>
        var orderButton = document.getElementById('orderButton');
        var popup = document.getElementById('popup');
        var closeButton = document.getElementById('closeButton');

        orderButton.addEventListener('click', function() {
            popup.style.display = 'flex';
        });

        closeButton.addEventListener('click', function() {
            popup.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        });

        document.getElementById('Receipt').addEventListener('click', function() {
            backendCall("UserController", "redirectToReceipt", null);
        });
        document.getElementById('Logout').addEventListener('click', function() {
            backendCall("UserController", "Logout", null);
        });

        document.getElementById('order').addEventListener('click', function() {

            const checkboxes = document.querySelectorAll('input[name="zutaten[]"]');
            const messageElement = document.getElementById('message');
            const message = messageElement ? messageElement.value.trim() : '';
            const selectedPizza = document.getElementById('non-custom-pizza').value;

            let isChecked = false;
            if (checkboxes) {
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        isChecked = true;
                    }
                });
            }

            if (!isChecked && message === '') {
                event.preventDefault();
                backendCall("PizzaController", "createPizza", {
                        pizza: selectedPizza
                    })
                    .then(data => {
                        if (data.error) {
                            alert("Error: " + data.error);
                        } else {
                            alert(data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred: ' + error.message);
                    });

            } else if(!isChecked ){
                alert("Bitte wählen Sie mindestens einen Belag aus");
            }
            else {
                const toppings = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        toppings.push(checkbox.value);
                    }
                });
                backendCall("PizzaController", "createCustomPizza", {
                        toppings: toppings,
                        message: message
                    })
                    .then(data => {
                        if (data.error) {
                            alert("Error: " + data.error);
                        } else {
                            alert(data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred: ' + error.message);
                    });
            }

        });
    </script>
</body>

</html>