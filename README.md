#Building MTG Card Api

Card Object
{  
 "name":"@string",
 "alt_names":[@string], // One To many
 "mana_cost":"{5}{W}{W}", //Special formated string
 "converted_mana_cost": @int,
 "colors":[@string], //Many to Many
 "colorIdentity":[@string], //Many to Many - might drop table
 "type":"@string",
 "supertypes":[@string], //Many to Many
 "types":[@string], //Many to Many
 "subtypes":[@string], //Many to Many
 "rarity": @string,
 "sets": [@string], //Many to Many
 "text": @string,
 "power": @integer,
 "toughness": @integer,
 "layout": @integer,
}

