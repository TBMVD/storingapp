<?php
//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie))
{
    $errors[]="Vul de attractie-naam in.";
}
$type = $_POST['type'];
if(empty($type))
{
    $errors[]="Vul de type in.";
}
$capaciteit = $_POST['capaciteit'];
if(!is_numeric($capaciteit))
{
    $errors[]="Vul voor capaciteit een geldig getal in.";
}
if(isset($_POST['prioriteit'])) 
{
    $prioriteit = 1;
} 
else
{
    $prioriteit = 0;
}
$melder = $_POST['melder'];
if(empty($melder))
{
    $errors[]="Vul de melder in.";
}
$overig = $_POST['overig'];

if(isset($errors))
{
    var_dump($errors);
    die();
}

//1. Verbinding
require_once 'conn.php';
//2. Query
//Merk op: id en gemeld op noemen we niet, want deze hebben een standaardwaarde 
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";
//3. Prepare
$statement = $conn->prepare($query);
//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":type" => $type,
    ":capaciteit" => $capaciteit,
    "prioriteit" => $prioriteit,
    ":melder" => $melder,
    ":overige_info" => $overig,
]);
//Ga terug naar index
header("Location: ../meldingen/index.php?msg-Melding opgeslagen");
