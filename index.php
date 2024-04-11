<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&family=Shadows+Into+Light&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Welcome to Hangman!</h1>
        <p>Enter your username and select a mode to start the game.</p>
        
        <div class="form">
            <form action="game.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="mode">Select Mode:</label>
                <select id="mode" name="mode">
                    <option value="easy">Easy</option>
                    <option value="hard">Hard</option>
                </select>
                
                <input type="submit" value="Start Game">
            </form>
        </div>
    </div>
</body>
</html>
