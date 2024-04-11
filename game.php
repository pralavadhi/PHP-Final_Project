<?php

// Function to get a random word from an array
function getRandomWord($mode) {
    $easyWords = array("apple", "banana", "orange", "mango", "grape", "peach", "dog", "human");
    $hardWords = array("dictionary", "eclipse", "rhinoceros", "programming", "javascript", "ostrich", "apocalypse");
    
    if ($mode == "easy") {
        return $easyWords[array_rand($easyWords)];
    } elseif ($mode == "hard") {
        return $hardWords[array_rand($hardWords)];
    } else {
        return "Invalid mode";
    }
}

// Main game logic
$username = isset($_POST['username']) ? $_POST['username'] : '';
$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$attempts = isset($_POST['attempts']) ? $_POST['attempts'] : 6;
$score = isset($_POST['score']) ? $_POST['score'] : 0;

if (isset($_POST['word'])) {
    $word = $_POST['word'];
    $hiddenWord = $_POST['hiddenWord'];
} else {
    $word = getRandomWord($mode);
    $hiddenWord = str_repeat("_", strlen($word));
}

if (isset($_POST['guess'])) {
    $guess = strtolower($_POST['guess']);
    
    if (strpos($word, $guess) === false) {
        $attempts--;
    } else {
        for ($i = 0; $i < strlen($word); $i++) {
            if ($word[$i] == $guess) {
                $hiddenWord[$i] = $guess;
            }
        }
        $score += 2; // Increment score by 2 for each correct guess
    }
}

// Check if game is over
$gameOver = $attempts == 0 || $hiddenWord == $word;
$guessedCorrectly = $hiddenWord == $word;

// Function to display the hangman image based on attempts
function displayHangman($attempts) {
    $hangmanImages = array(
        7 => "initial.png",
        6 => "head.png",
        5 => "body.png",
        4 => "leg1.png",
        3 => "leg2.png",
        2 => "hand1.png",
        1 => "hand2.png",
        0 => "gameover.png"
    );

    echo '<img src="images/' . $hangmanImages[$attempts] . '" alt="Hangman">';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hangman Game</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&family=Shadows+Into+Light&display=swap" rel="stylesheet">
</head> 
<body>
    <div class="container">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        
        <div class="game-area">
            <div class="score">
                Score: <?php echo $score; ?>
            </div>
            
            <div class="attempts">
                Attempts left: <?php echo $attempts; ?>
            </div>
            
            <div class="hangman-image">
                <?php displayHangman($attempts); ?>
            </div>
            
            <div class="word">
                <?php echo $hiddenWord; ?>
            </div>
            
            <div class="input-form">
                <?php if (!$gameOver): ?>
                <form action="game.php" method="post">
                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                    <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                    <input type="hidden" name="word" value="<?php echo $word; ?>">
                    <input type="hidden" name="hiddenWord" value="<?php echo $hiddenWord; ?>">
                    <input type="hidden" name="attempts" value="<?php echo $attempts; ?>">
                    <input type="hidden" name="score" value="<?php echo $score; ?>">
                    
                    <label for="guess">Enter a letter:</label>
                    <input type="text" id="guess" name="guess" maxlength="1" required>
                    <input type="submit" value="Guess">
                </form>
                <?php else: ?>
                <?php if ($guessedCorrectly): ?>
                <p>Congratulations, You guessed it right!</p>
                <form action="game.php" method="post">
                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                    <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                    <input type="hidden" name="score" value="<?php echo $score; ?>">
                    <input type="submit" value="Next Word">
                </form>
                <?php else: ?>
                <p>Game Over!</p>
                <p>The word was: <?php echo $word; ?></p>
                <form action="index.php" method="post">
                    <input type="submit" value="Retry">
                </form>
                <?php endif; ?>
                <form action="index.php" method="post">
                    <input type="submit" value="Exit">
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
