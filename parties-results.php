<?php
include_once "./includes/connect.php";
include_once "./modules/classes.php";

$object = new bincom_test($connect);
$selected_state = isset($_GET["state_id"]) ? $_GET["state_id"] : null;
$selected_lga = isset($_GET["lga_id"]) ? $_GET["lga_id"] : null;
$selected_ward = isset($_GET["ward_id"]) ? $_GET["ward_id"] : null;
$selected_p_u = isset($_GET["p_u_id"]) ? $_GET["p_u_id"] : null;

if (isset($_GET["submit"])) {
    $state_id = trim($_GET["state_id"]);
    $lga_id = trim($_GET["lga_id"]);
    $ward_id = trim($_GET["ward_id"]);
    $p_u_id = trim($_GET["p_u_id"]);
    $p_u_id = trim($_GET["p_u_id"]);
    $party = trim($_GET["party"]);
    $party_score = trim($_GET["party_score"]);
    $entered_by = trim($_GET["entered_by"]);

    date_default_timezone_set("AFRICA/LAGOS");
    $strtotime = strtotime("now");
    $curr_date = date("Y-m-d h:i:s", $strtotime);

    $user_ip = $_SERVER["REMOTE_ADDR"];

    $sql = "INSERT INTO `announced_pu_results`(`polling_unit_uniqueid`, `party_abbreviation`, `party_score`, `entered_by_user`, `date_entered`, `user_ip_address`) VALUES ('$p_u_id','$party',$party_score,'$entered_by','$curr_date','$user_ip')";
    // $query = $connect->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Party Results | Bincom Test</title>
</head>

<body>
    <main>
        <section>
            <a href="./index.php">Back to home</a>
            <h1>Select Polling Unit & Enter Parties Results</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method="get">
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