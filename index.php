<meta charset="utf-8">
<?php

abstract class Player{
    public $health = 100;
    public $armor, //броня

        $damage, // урон
        $speed; //скорость

    function hit($victim_number, $victim_team){
//        $victim->health -= $victim->armor - $this->damage * $this->speed / 100;
        // $victim->health -=  $this->damage;

        // $victim =  $teams[$victim_team]->players[$victim_number];

        $teams[$victim_team]->players[$victim_number]->health -=  $this->damage;
        var_dump($teams[$victim_team]->players[$victim_number]);


        if ($teams[$victim_team]->players[$victim_number]->health <= 0){
            unset($teams[$victim_team]->players[$victim_number]);
            sort($teams[$victim_team]->players);
            $teams[$victim_team]->playerCount--;

        }
    }
}

// trait Archer {
//     public $arrows,
//         $accuracy; // меткость

//     function hit($victim_number, $victim_team){
//         parent::hit($victim_number, $victim_team);
//         $this->arrows-=1;
//     }

// }

class Human extends Player {

}

class Human_Archer extends Human {
    // use Archer;

    function __construct()
    {
        $this->armor = 5; //броня
        $this->accuracy = 10; // меткость
        $this->arrows = 30; //стрелы
        $this->damage = 5; // урон
        $this->speed = 5; //скорость
    }

}

class Human_Warrior extends Human {

    function __construct()
    {
        $this->armor = 10; //броня
        $this->damage = 5; // урон
        $this->speed = 7; //скорость
    }


}

class Human_Rider extends Human {
    function __construct()
    {
        $this->armor = 5; //броня
        $this->damage = 12; // урон
        $this->speed = 15; //скорость
    }
}


class Orc extends Player {

}

class Big_Orc extends Orc{
    function __construct()
    {
        $this->armor = 0; //броня
        $this->damage = 20; // урон
        $this->speed = 5; //скорость
    }
}
class Lit_Orc extends Orc{
    function __construct()
    {
        $this->armor = 5; //броня
        $this->damage = 7; // урон
        $this->speed = 8; //скорость
    }
}

class Elf extends Player {

}
class Elf_Archer extends Elf {

    //   use Archer;

    function __construct()
    {
        $this->armor = 0; //броня
        $this->damage = 15; // урон
        $this->speed = 12; //скорость
        $this->arrows=40;
    }
}

class Elf_Warrior extends Elf {
    function __construct()
    {
        $this->armor = 0; //броня
        $this->damage = 15; // урон
        $this->speed = 10; //скорость
    }
}
class Indep_Orc extends Player {
    function __construct()
    {
        $this->armor = 5; //броня
        $this->damage = 15; // урон
        $this->speed = 10; //скорость
    }
}
class Gnome extends Player {
    function __construct()
    {
        $this->armor = 15; //броня
        $this->damage = 15; // урон
        $this->speed = 3; //скорость
    }
}
class Wizard extends Player {}

class Team{
    public $playerCount,
        $players;

    function isAlive(){

        if($this->playerCount>0) {return false;}
        return true;

    }

}

/* СОЗДАНИЕ ДВУХ КОМАНД */

for ($j = 0; $j<2; $j++){
//    echo "Команда #".$j."<br /><br />";
    $teams[$j] = new Team();
    $races = ['Human_Warrior','Human_Archer','Human_Rider','Big_Orc','Lit_Orc','Elf_Archer','Elf_Warrior','Indep_Orc','Gnome'];
    for($i=0; $i<10; $i++){
        $k = rand(1, 8);
        $teams[$j]->players[$i] = new $races[$k]();
        echo $teams[$j]->players[$i]; //aaaaaaaaa
//        echo "<br />";
        $teams[$j]->playerCount++;
        echo  $teams[$j]->playerCount;
//        echo get_class($team[$j]->players[$i]);
//        echo "<br />";
    }
    echo "<br />";
}

/* Конец СОЗДАНИЕ ДВУХ КОМАНД */

for ($i = 0; $i < 10; $i++){ //номер хода
    for($j = 0; $j < 2; $j++){ // номер команды
        $k = $j ? 0 : 1;
        $victim_number = rand(0, $teams[$k]->playerCount-1);
        $teams[$j]->players[rand(0, $teams[$j]->playerCount-1)]->hit($victim_number, $k);
        echo "<br />";
    }

}

