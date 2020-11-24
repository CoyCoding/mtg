<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MTG</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
      <div>
        <form>
          <fieldset>

            <input type="checkbox" id="white" name="white" value="1">
            <label for="white">white</label><br>


            <input type="checkbox" id="black" name="black" value="2">
            <label for="black">black</label><br>


            <input type="checkbox" id="red" name="red" value="3">
            <label for="red">red</label><br>

            <input type="checkbox" id="green" name="green" value="4">
            <label for="green"> I have a bike</label><br>


            <input type="checkbox" id="blue" name="blue" value="5">
            <label for="blue"> I have a car</label><br>
          </fieldset>
          <input id="submit" type="Submit">submit</input>
        </form>
        <div id ="cards">

        </div>
      </div>
    </body>
    <script src="/js/app.js"></script>
</html>
