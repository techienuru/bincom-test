<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bincom Test | Ibrahim Nurudeen Shehu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        main {
            width: 100%;
            max-width: 600px;
        }

        section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
            padding: 50px 40px;
            text-align: center;
        }

        section p {
            margin-bottom: 25px;
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        section p:last-child {
            margin-bottom: 0;
        }

        a {
            display: inline-block;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            margin-top: 8px;
        }

        a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        a:active {
            transform: translateY(-1px);
        }

        h2 {
            color: #333;
            margin-bottom: 35px;
            font-size: 32px;
            font-weight: 700;
        }

        @media (max-width: 500px) {
            section {
                padding: 30px 20px;
            }

            section p {
                font-size: 14px;
                margin-bottom: 18px;
            }

            a {
                padding: 10px 20px;
                font-size: 14px;
            }

            h2 {
                font-size: 26px;
                margin-bottom: 25px;
            }
        }
    </style>
</head>

<body>
    <main>
        <section>
            <p>
                Answer 1: <a href="./polling-unit-results.php">Results for individual polling units</a>
            </p>
            <p>
                Answer 2: <a href="./lga-results.php">Total results for polling units by L.G.A</a>
            </p>
            <p>
                Answer 3: <a href="./parties-results.php">Add results for all parties (new polling units)</a>
            </p>
        </section>
    </main>
</body>

</html>