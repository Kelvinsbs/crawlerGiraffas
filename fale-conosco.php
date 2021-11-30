<?php
require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

$mysqli = new mysqli("localhost", "root", "", "giraffas");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$url = "https://www.giraffas.com.br/sobre-o-giraffas/fale-conosco/ ";
$html = file_get_contents($url);

$crawler = new Crawler($html);

$num = $crawler->filter('h2.c-highlight-box__title')->count();

for ($i=0; $i < $num; $i++) { 
    $cardapio = $crawler->filter('h2.c-highlight-box__title')->eq($i)->text();
    $query = "INSERT INTO `cardapio`(`nome`) VALUES ('$cardapio')";
    // mysqli_query($mysqli, $query);
    echo $cardapio .', ';
}

?>