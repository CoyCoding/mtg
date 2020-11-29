<div class="sidebar">
  <form>
    <div id="colors">
      <div class="color-wrap" value="White">
        <img src="/img/W.png">
      </div>
      <div class="color-wrap" value="Blue">
        <img src="/img/U.png">
      </div>
      <div class="color-wrap" value="Black">
        <img src="/img/B.png">
      </div>
      <div class="color-wrap" value="Red">
        <img src="/img/R.png">
      </div>
      <div class="color-wrap" value="Green">
        <img src="/img/G.png">
      </div>
      <div class="color-wrap" value="Colorless">
        <img src="/img/C.png">
      </div>
    </div>
    <div id="conditionals">
      <p for="conditionals">Conditional</p>
      <div class="radio-wrap active" value="or">
        <span>or</span><div class="radio"></div>
      </div>
      <div class="radio-wrap" value="and">
        <span>and</span><div class="radio"></div>
      </div>
      <div class="radio-wrap" value="only">
        <span>only</span><div class="radio"></div>
      </div>
    </div>
    <div class="dropdown-wraps" id="types">
      <label for="type">Types</label><br>
      <select class="ui selection search dropdown">
        <option name="type" value=""></option>
        @foreach($data['types'] as $type)
          <option name="type" value="{{$type->name}}">{{$type->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="dropdown-wraps" id="subtypes">
      <label for="Subtypes">Subtypes</label><br>
      <select class="ui selection dropdown">
        <option value=""></option>
        @foreach($data['subtypes'] as $subtype)
          <option name="subtype" value="{{$subtype->name}}">{{$subtype->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="dropdown-wraps" id="supertypes">
      <label for="supertypes">Supertypes</label><br>
      <select class="ui selection dropdown">
        <option value=""></option>
        @foreach($data['supertypes'] as $supertype)
          <option name="supertype" value="{{$supertype->name}}">{{$supertype->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="dropdown-wraps" id="rarity">
      <label for="rarity">Rarity</label><br>
      <select class="ui selection dropdown">
        <option value=""></option>
        @foreach($data['rarities'] as $rarity)
          <option name="supertype" value="{{$rarity->name}}">{{$rarity->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="submit-wrap">
      <input id="submit" type="Submit">submit</input>
    </div>
  </form>
  <div class="top-tri">
    <div class="open-btn">open</div>
  </div>
  <div class="bot-tri">
    open
  </div>
</div>