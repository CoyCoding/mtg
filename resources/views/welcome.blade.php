<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MTG</title>
    </head>
    <body class="antialiased">
      <div>
        <form>

          <input type="checkbox" id="white" name="colors" value="white">
          <label for="colors">white</label><br>

          <input type="checkbox" id="black" name="colors" value="black">
          <label for="colors">black</label><br>

          <input type="checkbox" id="red" name="colors" value="red">
          <label for="colors">red</label><br>

          <input type="checkbox" id="green" name="colors" value="green">
          <label for="colors">green</label><br>

          <input type="checkbox" id="blue" name="colors" value="blue">
          <label for="colors">blue</label><br>

          <input type="checkbox" id="colorless" name="colors" value="colorless">
          <label for="colors">colorless</label><br>

          <input type="radio" id="only" name="conditional" value="only" checked>
          <label for="only">only</label><br>

          <input type="radio" id="and" name="conditional" value="and">
          <label for="and">and</label><br>

          <input type="radio" id="or" name="conditional" value="or">
          <label for="or">or</label><br>

          <input id="submit" type="Submit">submit</input>
        </form>
        <div id ="cards">

        </div>
      </div>
    </body>
    <script src="/js/app.js"></script>
</html>
