<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Pizzaservice/app/style/Shared.css">
    <link rel="stylesheet" href="/Pizzaservice/app/style/Orderpage.css">
    <script src="/Pizzaservice/app/shared.js"></script>
    <title>Orderpage</title>
</head>

<body>
    <div class="order-box">
        <br><br>
        <h1>Pizza bestellen</h1>
        <br>
        <div class="options">
            <div>
                <label class="select-label" for="pizza">Pizza zusammenstellen</label><br><br>
                <div class="checkbox-container">
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option1"> Tomatensauce
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option2"> Mozzarella
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option3"> Salami 
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option4"> Schinken
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option5"> Pilze
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option6"> Zwiebeln
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option7"> Paprika
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option8"> Oliven
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option9"> Speck
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="zutaten[]" value="option10"> Thunfisch
                    </label>
                </div>

                <br>
                
            </div>
            <div>
                <label class="select-label" for="pizza">Pizza auswählen</label><br><br>
                <select class="pizza-select" id="pizza">
                    <option>Margherita  </option>
                    <option> Pepperoni </option>
                    <option> Supreme </option>
                    <option> BBQ </option>
                    <option> Tonno </option>
                    <option> Prosciutto </option>
                    <option> Vegetarisch </option>
                </select>
            </div>
        </div>

        <button class="orderpage-button" type="submit">zur Bestellung hinzufügen</button><br>
        <button class="orderpage-button" type="button">Meine Bestellung</button><br>
        <button class="orderpage-button" type="button">Bestellen</button>
    </div>


</body>

</html>