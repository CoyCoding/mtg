<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>MTG</title>
      <link rel="stylesheet" type="text/css" href="/css/app.css">
      <link rel="stylesheet" type="text/css" href="/semantic/semantic.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body class="antialiased no-fouc">
      <div>
        <form>
          <div id="colors">
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
          </div>
          <div id="conditionals">
            <input type="radio" id="only" name="conditional" value="only" checked>
            <label for="only">only</label><br>

            <input type="radio" id="and" name="conditional" value="and">
            <label for="and">and</label><br>

            <input type="radio" id="or" name="conditional" value="or">
            <label for="or">or</label><br>
          </div>
          <div id="types">
            <select class="ui search dropdown">
              <option value="">State</option>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District Of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
            </select>
          </div>
          <input id="submit" type="Submit">submit</input>
        </form>
        <div id ="cards">

        </div>
      </div>
    </body>
    <script src="/js/app.js"></script>
    <script src="/semantic/semantic.min.js"></script>
</html>
