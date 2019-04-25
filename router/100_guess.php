<?php
/**
 * Redirect to the game
 */
$app->router->get("guess/init", function () use ($app) {
    // init session for the game
    if (!isset($_SESSION["guess"])) {
        $_SESSION["guess"] = new Dahg\Guess\Guess();
    }
    return $app->response->redirect("guess/play");
});



/**
 * init game
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $tries = $_SESSION["guess"]->tries();

    $data = [
        "res" => $res ?? null,
        "userGuess" => $userGuess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "doCheat" => $doCheat ?? null,
        "doGuess" => $doGuess ?? null,
        "doInit" => $doInit ?? null,
    ];

    $app->page->add("guess/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
/**
 * make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game";


    $number = $_SESSION["guess"]->number();
    $tries = $_SESSION["guess"]->tries();
    $res = null;
    $userGuess = $_POST["userGuess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    if ($doInit) {
        $_SESSION["guess"] = new Dahg\Guess\Guess();
        header("Location: index.php");
    } elseif ($doGuess) {
        if ($userGuess > 100 || $userGuess < 1) {
            throw new GuessException("You can only guess between 1 and 100!");
        } else {
            $res = $_SESSION["guess"]->makeGuess($userGuess);
            $tries = $_SESSION["guess"]->tries();
        }
    }
    $data = [
        "res" => $res,
        "userGuess" => $userGuess,
        "tries" => $tries,
        "number" => $number,
        "doCheat" => $doCheat,
        "doGuess" => $doGuess,
        "doInit" => $doInit,
    ];

    $app->page->add("guess/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
