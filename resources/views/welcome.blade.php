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
      <div>nav bar</div>
      <div class="main">
        @include('home/comps/formsidebar')
        <div class="open-btn">
          open
        </div>
        <div class="body">
          <div class="fixed-card-display">

          </div>
          <div class="card-display" onscroll="(e)=>console.log(e)">
            <div class="card-wrap">
              <div id="cards">

              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
    <script src="/js/app.js"></script>
    <script src="/semantic/semantic.min.js"></script>
</html>
