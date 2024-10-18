<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEPMANIA</title>

    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            margin: 0;
            padding: 0;
            text-align: center;
            color: white;
            background-color: #000;
        }

        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        #background-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            top: 20%;
        }

        .title {
            font-size: 5em;
            color: #00e676;
            text-shadow: 4px 4px 20px rgba(0, 0, 0, 0.7);
            margin-bottom: 50px;
        }

        .menu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu ul li {
            margin: 20px 0;
        }

        .menu ul li a {
            text-decoration: none;
            font-size: 1.5em;
            color: #fff;
            padding: 15px 30px;
            background-color: #FF5733;
            border-radius: 10px;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .menu ul li a:hover {
            background-color: #ff4081;
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>

<body>

    <div class="video-container">
        <video autoplay muted loop id="background-video">
            <source src="video.mp4" type="video/mp4">
        </video>
        <div class="overlay"></div>
    </div>

    <div class="content">
        <h1 class="title">STEPMANIA</h1>
        <nav class="menu">
            <ul>
                <li><a href="començar partida.html">Començar partida</a></li>
                <li><a href="Afegir una nova cançó.html">Afegir una nova cançó</a></li>
                <li><a href="Taula de classificacions.html">Taula de classificacions</a></li>
            </ul>
        </nav>
    </div>

</body>

</html>
