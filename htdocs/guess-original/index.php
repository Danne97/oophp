<?php
include(__DIR__."/src/config.php");
include(__DIR__."/src/autoload.php");
include(__DIR__ . "/src/Guess.php");
include(__DIR__ . "/src/GuessException.php");

session_name("dahg17");
session_start();
// session_destroy();

if (!isset($_SESSION["guess"])) {
    $_SESSION["guess"] = new Guess();
}

$number = $_SESSION["guess"]->number();
$tries = $_SESSION["guess"]->tries();
$res = null;
$userGuess = $_POST["userGuess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

if ($doInit) {
    $_SESSION["guess"] = new Guess();
    header("Location: index.php");
} elseif ($doGuess) {
    if ($userGuess > 100 || $userGuess < 1) {
        throw new GuessException("You can only guess between 1 and 100!");
    } else {
        $res = $_SESSION["guess"]->makeGuess($userGuess);
        $tries = $_SESSION["guess"]->tries();
    }
}

require __DIR__."/view/guess_number.php";
