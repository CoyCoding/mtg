<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>MTG</title>
      <link rel="stylesheet" type="text/css" href="/css/app.css">
      <link rel="stylesheet" type="text/css" href="/semantic/semantic.min.css">
      <link rel="shortcut icon" type="image/x-icon" href="img/C.png" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
        const {type, colors, rarity, subtype, supertype} = @json($data);
        const renderedProjectsCount = 3;
    </script>
    </head>
    <body class="antialiased no-fouc">
      <div class="main">
        @include('home/comps/formsidebar')
        <div class="body">
          <div class="fixed-card-display noise">
            <div class="flex-overflow-fix">
              <div class="magic-card" key="17033">
                <div class="magic-card-inner">
                  <div class="magic-card-back">
                    <img src="/img/mtg-back-sm.jpg" alt="card back">
                  </div>
                  <div class="magic-card-front">
                    <img src="/img/mtg-back-sm.jpg" alt="card back">
                  </div>
                </div>
              </div>
              <div id="card-info"></div>
            </div>
            <div class="bot-tri">
              <div class="card-open-btn">
                <div class="wrap">
                  <i class="angle double right icon"></i>
                </div>
                <div class="wrap">
                  <i class="angle double right icon"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="card-display">
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
