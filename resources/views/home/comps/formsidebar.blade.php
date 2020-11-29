<div class="sidebar">
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
          <option name="type" value="{{$type->name}}">{{$type->name}}</option>
        @endforeach
      </select>
    </div>
    <div id="subtypes">
      <label for="Subtypes">Subtypes</label><br>
      <select class="ui selection dropdown">
        <option value=""></option>
        @foreach($data['subtypes'] as $subtype)
          <option name="subtype" value="{{$subtype->name}}">{{$subtype->name}}</option>
        @endforeach
      </select>
    </div>
    <div id="supertypes">
      <label for="supertypes">Supertypes</label><br>
      <select class="ui selection dropdown">
        <option value=""></option>
        @foreach($data['supertypes'] as $supertype)
          <option name="supertype" value="{{$supertype->name}}">{{$supertype->name}}</option>
        @endforeach
      </select>
    </div>
    <div id="rarity">
      <label for="rarity">Rarity</label><br>
      <select class="ui selection dropdown">
        <option value=""></option>
        @foreach($data['rarities'] as $rarity)
          <option name="supertype" value="{{$rarity->name}}">{{$rarity->name}}</option>
        @endforeach
      </select>
    </div>
    <input id="submit" type="Submit">submit</input>
  </form>
  <div class="top-tri">
    <div class="open-btn">open</div>
  </div>
  <div class="bot-tri">
    open
  </div>
</div>