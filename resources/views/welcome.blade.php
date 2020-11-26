<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>MTG</title>
      <link rel="stylesheet" type="text/css" href="/css/app.css">
      <link rel="stylesheet" type="text/css" href="/semantic/semantic.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
        const {type, colors, rarity, subtype, supertype} = @json($data);
        const renderedProjectsCount = 3;
    </script>
    </head>
    <body class="antialiased no-fouc">
      <div>
        <form>
          <div id="colors">
            @foreach($data['colors'] as $color)
              <input type="checkbox" id="{{$color->name}}" name="colors" value="{{$color->name}}">
              <label for="{{$color->name}}">{{$color->name}}</label><br>
            @endforeach
          </div>
          <div id="conditionals">
            <label for="conditionals">Conditional</label><br>
            <input type="radio" id="only" name="conditional" value="only" checked>
            <label for="only">only</label><br>

            <input type="radio" id="and" name="conditional" value="and">
            <label for="and">and</label><br>

            <input type="radio" id="or" name="conditional" value="or">
            <label for="or">or</label><br>
          </div>
          <div id="types">
            <label for="type">Types</label><br>
            <select class="ui selection search dropdown">
              <option name="type" value=""></option>
              @foreach($data['types'] as $type)
                <option name="type" value="{{$type->id}}">{{$type->name}}</option>
              @endforeach
            </select>
          </div>
          <div id="subtypes">
            <label for="Subtypes">Subtypes</label><br>
            <select class="ui selection dropdown">
              <option value=""></option>
              @foreach($data['subtypes'] as $subtype)
                <option name="subtype" value="{{$subtype->id}}">{{$subtype->name}}</option>
              @endforeach
            </select>
          </div>
          <div id="supertypes">
            <label for="supertypes">Supertypes</label><br>
            <select class="ui selection dropdown">
              <option value=""></option>
              @foreach($data['supertypes'] as $supertype)
                <option name="supertype" value="{{$supertype->id}}">{{$supertype->name}}</option>
              @endforeach
            </select>
          </div>
          <div id="rarity">
            <label for="rarity">Rarity</label><br>
            <select class="ui selection dropdown">
              <option value=""></option>
              @foreach($data['rarities'] as $rarity)
                <option name="supertype" value="{{$rarity->id}}">{{$rarity->name}}</option>
              @endforeach
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
