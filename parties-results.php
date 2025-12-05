<?php
include_once "./includes/connect.php";
include_once "./modules/classes.php";

$object = new bincom_test($connect);
$selected_state = isset($_POST["state_id"]) ? $_POST["state_id"] : null;
$selected_lga = isset($_POST["lga_id"]) ? $_POST["lga_id"] : null;
$selected_ward = isset($_POST["ward_id"]) ? $_POST["ward_id"] : null;
$selected_p_u = isset($_POST["p_u_id"]) ? $_POST["p_u_id"] : null;

if (isset($_POST["submit"])) {

    try {
        $state_id = trim($_POST["state_id"]);
        $lga_id = trim($_POST["lga_id"]);
        $ward_id = trim($_POST["ward_id"]);
        $p_u_id = trim($_POST["p_u_id"]);
        $p_u_id = trim($_POST["p_u_id"]);
        $party = trim($_POST["party"]);
        $party_score = (int) trim($_POST["party_score"]);
        $entered_by = trim($_POST["entered_by"]);

        date_default_timezone_set("AFRICA/LAGOS");
        $strtotime = strtotime("now");
        $curr_date = date("Y-m-d h:i:s", $strtotime);

        $user_ip = $_SERVER["REMOTE_ADDR"];

        $sql = "INSERT INTO `announced_pu_results`(`polling_unit_uniqueid`, `party_abbreviation`, `party_score`, `entered_by_user`, `date_entered`, `user_ip_address`) VALUES (?,?,?,?,?,?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sisss", $p_u_id, $party, $party_score, $entered_by, $curr_date, $user_ip);
        $result = $stmt->execute();

        if (!$result) throw new Error($stmt->error);

        echo "<script>alert('Success');</script>";

        $stmt->close();
    } catch (Exception $e) {
        // Validation or other application exceptions
        echo 'alert(`<script>' . $e->getMessage() . '</script>`)';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Party Results | Bincom Test</title>
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
            padding: 20px;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #764ba2;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            text-align: center;
        }

        form div {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            color: #555;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input,
        select {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        select {
            background-color: white;
            cursor: pointer;
        }

        button {
            padding: 14px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        @media (max-width: 600px) {
            section {
                padding: 25px;
            }

            h1 {
                font-size: 22px;
            }

            input,
            select {
                padding: 10px 12px;
                font-size: 14px;
            }

            button {
                padding: 12px 25px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <main>
        <section>
            <a href="./index.php">Back to home</a>
            <h1>Select Polling Unit & Enter Parties Results</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method="post">
                <div>
                    <label for="state">STATE: </label>
                    <select name="state_id" id="state" required>
                    </select>
                </div>
                <div>
                    <label for="lga">LGA: </label>
                    <select name="lga_id" id="lga" required>
                        <option value=''>Please select a state</option>
                        <!-- Appeard dynamically from JS -->
                    </select>
                </div>
                <div>
                    <label for="ward">WARD: </label>
                    <select name="ward_id" id="ward" required>
                        <option value=''>Please select a LGA</option>
                        <!-- Appeard dynamically from JS -->
                    </select>
                </div>
                <div>
                    <label for="pu">POLLING UNIT: </label>
                    <select name="p_u_id" id="pu" required>
                        <option value=''>Please select a ward</option>
                        <!-- Appeard dynamically from JS -->
                    </select>
                </div>
                <div>
                    <label for="party">PARTY: </label>
                    <select name="party" id="party" required>
                        <!-- Appeard dynamically from JS -->
                    </select>
                </div>

                <div>
                    <label for="party-score">PARTY SCORE: </label>
                    <input type="number" name="party_score" id="party-score" required>
                </div>

                <div>
                    <label for="entered-by">ENTERED BY: </label>
                    <input type="text" name="entered_by" id="entered-by" placeholder="Enter your name..." required>
                </div>

                <div>
                    <button type="submit" name="submit"> Submit Result </button>
                </div>
            </form>
        </section>
    </main>
    <script src="./js/partiesResults.js"></script>
</body>

</html>