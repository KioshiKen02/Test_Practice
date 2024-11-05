<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Sea Beginner Trio / Dou Server</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('/photo/main.jpg'); /* Update with your image path */
            background-size: cover; /* Ensures the image covers the area */
            background-position: left; /* Aligns the image to the left */
            background-repeat: no-repeat; /* Prevents the image from repeating */
        }
        
       

        .content {
            position: relative; /* To ensure other elements can be positioned above the background */
            z-index: 1; /* Places content above the background */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white; /* Text color for contrast against background */
            text-align: center; /* Center text alignment */
        }

        .title {
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
            padding: 20px; /* Padding around the title */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5); /* Shadow for depth */
            font-size: 36px; /* Font size for the title */
            font-weight: bold; /* Bold text */
            text-transform: uppercase; /* Uppercase text */
            margin-bottom: 20px; /* Spacing below the title */
        }

        .nav {
            position: absolute; /* Positioning in the top right */
            top: 20px; /* Adjust for spacing from the top */
            right: 20px; /* Adjust for spacing from the right */
            z-index: 1; /* Ensures nav is above the background */
        }

        .nav a {
            color: white; /* Text color */
            text-decoration: none; /* No underline */
            margin: 0 10px; /* Spacing between links */
            padding: 10px 15px; /* Padding for buttons */
            border: 1px solid white; /* Button border */
            border-radius: 5px; /* Rounded corners */
            transition: background 0.3s; /* Smooth transition */
        }

        .nav a:hover {
            background: rgba(255, 255, 255, 0.2); /* Light background on hover */
        }

        .welcome-message {
            cursor: pointer; /* Makes the welcome message clickable */
            text-align: center;
            margin-bottom: 20px; /* Spacing below the welcome message */
        }

        .countdown {
            font-size: 24px; /* Font size for countdown */
            margin-top: 20px; /* Spacing above countdown */
            color: yellow; /* Color for better visibility */
            font-weight: bold; /* Bold text */
        }

        .check-update, .check-twitch-drop {
            cursor: pointer; /* Makes the text clickable */
            color: white; /* Text color */
            text-decoration: underline; /* Underline for emphasis */
            margin: 5px 0; /* Spacing between the texts */
        }

        .wipe-info {
            margin-top: 20px; /* Spacing above wipe info */
        }
    </style>
</head>
<body>
    <div class="half-background"></div> <!-- Half background -->

    <div class="content"> <!-- Main content -->
        <div class="title"> <!-- Title with design -->
            Welcome to Sea Beginner Trio / Dou Server
        </div>
        <div id="countdown" class="countdown" style="display: none;"></div> <!-- Countdown Timer -->
        <div class="wipe-info">
            <div id="weekly-wipe" class="countdown" style="display: none;"></div> <!-- Weekly Wipe Countdown -->
            <div id="monthly-wipe" class="countdown" style="display: none;"></div> <!-- Monthly Wipe Countdown -->
        </div>
        <p class="check-update" onclick="window.location.href='https://rust.facepunch.com/news/'">
            Check Rust News Update
        </p>
        <p class="check-twitch-drop" onclick="window.location.href='https://twitch.facepunch.com/'">
            Check Rust Twitch Drop
        </p>
    </div>

    <div class="nav"> <!-- Navigation -->
        <a href="{{ route('login') }}">Log In</a>
        <a href="{{ route('register') }}">Sign Up</a>
    </div>
</body>
</html>
