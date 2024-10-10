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
        <div class="container">
            <h1 class="h1-formatting">Pizzaservice</h1><br>
        </div>

        <button id="Receipt" class="navigation-button" type="submit">Rechnung</button>
        <button id="Logout" class="navigation-button" type="submit">Logout</button>
    </div>

    <div class="order-box">


        <div class="grid-container">
            <button id="showCustomPizza" class="grid-item label-row button-create-pizza" type="submit">Pizza selber Zusammenstellen</button>
            <button id="showNormalPizza" class="grid-item label-row button-create-pizza margin-left" type="submit">Pizza auswählen</button>

            <div id="customPizza" class="grid-item content-row display-none">
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

            <div class="grid-item content-row display-none" id="normalPizza">
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
                <div class="popup-header">
                    <span class="close-button" id="closePopup">&times;</span>
                    <h2>Bestellübersicht</h2>
                    <div class="popup-content">

                    </div>
                </div>

            </div>

        </div>
        <div class="grid-container-three-way">
            <button id="addToOrder" class="orderpage-button" type="submit">zur Bestellung hinzufügen</button>
            <button id="myOrderButton" class="orderpage-button" type="button">Meine Bestellung</button>
            <button id="order" class="orderpage-button" type="button">Bestellen</button>
        </div>

    </div>

    <script>
        //alternate between custom and normal pizza

        document.getElementById('showCustomPizza').addEventListener('click', function() {
            if (customPizza.style.display === 'grid') {
                customPizza.style.display = 'none';
            } else [
                customPizza.style.display = 'grid',
            ]

        });

        document.getElementById('showNormalPizza').addEventListener('click', function() {
            if (normalPizza.style.display === 'grid') {
                normalPizza.style.display = 'none';
            } else [
                normalPizza.style.display = 'grid',
            ]
        });



        //view order popup visibility
        myOrderButton.addEventListener('click', function() {
            popup.style.display = 'flex';
        });

        closePopup.addEventListener('click', function() {
            popup.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        });

        //navigation
        document.getElementById('Receipt').addEventListener('click', function() {
            backendCall("UserController", "redirectToReceipt", null);
        });
        document.getElementById('Logout').addEventListener('click', function() {
            backendCall("UserController", "Logout", null);
        });

        document.getElementById('addToOrder').addEventListener('click', function() {

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

            } else if (!isChecked) {
                alert("Bitte wählen Sie mindestens einen Belag aus");
            } else {
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

        document.getElementById('myOrderButton').addEventListener('click', function() {
            var popup = document.getElementById('popup');
            var closePopup = document.getElementById('closePopup');

            myOrderButton.addEventListener('click', function() {
                popup.style.display = 'flex';
            });

            closePopup.addEventListener('click', function() {
                popup.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target == popup) {
                    popup.style.display = 'none';
                    clearPopupContent()
                }
            });

            backendCall("PizzaController", "getOpenOrders", null)
                .then(response => {
                    if (response === "Ihre Bestellung ist leer") {
                        const p = document.createElement('p');
                        p.textContent = response;
                        document.querySelector('.popup-content').appendChild(p);
                    } else {
                        for (const pizza of response) {
                            const p = document.createElement('p');
                            if (pizza.name) {
                                p.textContent = ` ${pizza.name} - €${parseFloat(pizza.price).toFixed(2)}`;
                            } else {
                                p.textContent = ` Pizza mit: ${pizza.toppings.join(', ')} ${pizza.message} - €${parseFloat(pizza.price).toFixed(2)}`;
                            }
                            document.querySelector('.popup-content').appendChild(p);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred: ' + error.message);
                });

        });

        document.getElementById('order').addEventListener('click', function() {
            backendCall("ReceiptController", "order", null)
                .then(response => {
                    alert(response);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred: ' + error.message);
                });
        });

        function clearPopupContent() {
            const popupContent = document.querySelector('.popup-content');
            while (popupContent.firstChild) {
                popupContent.removeChild(popupContent.firstChild);
            }
        }
    </script>
</body>

</html>