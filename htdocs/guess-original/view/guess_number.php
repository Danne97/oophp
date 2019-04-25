<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>

<?php if ($res == "CORRECT") : ?>
    <form method="post">
        <input type="submit" name="doInit" value="Start from the beginning">
    </form>
<?php endif; ?>
<?php if ($res != "CORRECT") : ?>
    <form method="post">
        <input type="text" name="userGuess">
        <input type="submit" name="doGuess" value="make a guess">
        <input type="submit" name="doInit" value="Start from the beginning">
        <input type="submit" name="doCheat" value="cheat">
    </form>
<?php endif; ?>

<?php if ($doGuess) : ?>
    <p>Your guess is <?= $userGuess ?>. <b><?= $res ?>!</b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: current number is <?= $number ?>.</p>
<?php endif; ?>


<!-- <hr>
<pre>
SESSION
<?= var_dump($_SESSION) ?>
POST
<?= var_dump($_POST) ?>
GET
<?= var_dump($_GET) ?> -->
