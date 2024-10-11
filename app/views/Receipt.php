<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Pizzaservice/app/style/Shared.css">
    <link rel="stylesheet" href="/Pizzaservice/app/style/Receipt.css">
    <script src="/Pizzaservice/app/Shared.js"></script>
    <script src="/Pizzaservice/app/Api.js"></script>
    <title>Receipt</title>
</head>

<body>
    <div class="nav">
        <button class="navigation-receipt nav-button" type="submit" id="Main-menu">Hauptmenü</button>
    </div>

    <div class="receipt-box width90">
        <div>
            <h1>Rechnungen</h1>
        </div>
        <div class="receipt-container">
            <select name="rechnungen" id="rechnungen" class="receipt-select" onselect=>

            </select>
        </div> <br>
        <div class="receipt-form">
            <p id="name"></p>
            <p class="placeholder"></p>
            <p id="surname"></p>
            <p class="placeholder"></p>
            <p id="city-plz"></p>
            <p class="placeholder"></p>
            <p id="street-housenr."></p>
        </div>

        <p id="divider" class="divider margin-top"></p>

        <div class="height" id="pizza-container"></div>

        <p id="divider1" class="divider-bottom margin-top"></p>

        <div class="receipt-form">
            <p></p>
            <p class="position-bottom" id="Gesamtpreis"></p>
        </div>

    </div>
    </div>

    <script>
        document.getElementById('Main-menu').addEventListener('click', function() {
            backendCall("UserController", "redirectToMainMenu", null);
        });

        document.onload = backendCall("ReceiptController", "getClosedReceipts", null)
            .then(function(response) {
                let select = document.getElementById('rechnungen');
                let defaultOption = document.createElement('option');
                defaultOption.text = "bitte wählen";
                defaultOption.value = "default";
                defaultOption.selected = true;
                defaultOption.disabled = true;
                select.add(defaultOption);

                response.forEach(item => {
                    let option = document.createElement('option');
                    option.text = item.orderdate +" Nr."+ item.receipt_id;
                    option.value = item.receipt_id;
                    select.add(option);
                });


            });
        let lastSelectedValue = null;

        document.getElementById('rechnungen').addEventListener('click', function() {
            let select = document.getElementById('rechnungen');
            let selectedValue = select.value;
            if (selectedValue !== "default" && selectedValue !== lastSelectedValue) {
                lastSelectedValue = selectedValue;
                clearPreviousContent()
                backendCall("ReceiptController", "getFullReceipt", {
                        receipt_id: selectedValue
                    })
                    .then(function(response) {
                        let user = response.user[0];
                        document.getElementById('name').innerText = user.name;
                        document.getElementById('surname').innerText = user.surname;
                        document.getElementById('city-plz').innerText = user.city + " " + user.postal_code;
                        document.getElementById('street-housenr.').innerText = user.street + " " + user.house_number;
                        document.getElementById('divider').style.backgroundColor = "black";
                        document.getElementById('divider1').style.backgroundColor = "black";

                        let pizzaContainer = document.getElementById('pizza-container');
                        let priceContainer = document.getElementById('price-container');
                        let pizzaArray = [];
                        response.pizzas.forEach(pizza => {
                            pizzaArray.push({
                                name: customPizzaOrName(pizza),
                                price: pizza.price
                            });
                        });

                        pizzaArray.forEach(pizza => {
                            let pizzaItem = document.createElement('div');
                            pizzaItem.className = 'pizza-item';

                            let pizzaElement = document.createElement('p');
                            pizzaElement.className = 'pizza-name';
                            pizzaElement.innerText = customPizzaOrName(pizza);
                            pizzaItem.appendChild(pizzaElement);

                            let pizzaPrice = document.createElement('p');
                            pizzaPrice.className = 'pizza-price';
                            pizzaPrice.innerText = pizza.price + " €";
                            pizzaItem.appendChild(pizzaPrice);

                            pizzaContainer.appendChild(pizzaItem);
                        });
                        document.getElementById('Gesamtpreis').innerText = "Gesamt:" + response.totalPrice + " €";
                    });
            }
        });

        function customPizzaOrName(pizza) {
            if (pizza.hasOwnProperty('name') && pizza.name !== "") {
                return pizza.name;
            } else {
                return "Pizza mit " + pizza.toppings.join(", ") + " - " + pizza.message;
            }
        }

        function clearPreviousContent() {
            let pizzaContainer = document.getElementById('pizza-container');
            pizzaContainer.innerHTML = '';
           

        }
    </script>

</body>

</html>