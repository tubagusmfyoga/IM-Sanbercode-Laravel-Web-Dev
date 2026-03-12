<?php
require_once ('animal.php');
require_once ('ape.php');
require_once ('frog.php');

$sheep = new Animal("shaun");

echo "Latihan OOP Animal Class<br>";
echo "--------------------------------------------------------<br><br>";
echo "Name : " . $sheep->name . "<br>"; // "shaun"
echo "legs : " . $sheep->legs . "<br>"; // 4
echo "cold blooded : " . $sheep->cold_blooded . "<br><br>"; // "no"
echo "--------------------------------------------------------<br><br>";
$kodok = new Frog("buduk");
echo "Name : " . $kodok->name . "<br>"; // "buduk"
echo "legs : " . $kodok->legs . "<br>"; // 4
echo "cold blooded : " . $kodok->cold_blooded . "<br>"; // "no"
echo "Jump : " . $kodok->jump() . "<br><br>"; // "Hop hop"
echo "--------------------------------------------------------<br><br>";
$sungokong = new Ape("kera sakti");
echo "Name : " . $sungokong->name . "<br>"; // "kera sakti"
echo "legs : " . $sungokong->legs . "<br>"; // 2
echo "cold blooded : " . $sungokong->cold_blooded . "<br>"; // "no"
echo "Yell : " . $sungokong->yell() . "<br><br>"; // "Auooo"
echo "--------------------------------------------------------<br><br>";
?>