<?php
include_once "./include/connect.php";
include_once "./modules/classes.php";

$object = new bincom_test($connect);
$selected_state = isset($_GET["state_id"]) ? $_GET["state_id"] : null;
$selected_lga = isset($_GET["lga_id"]) ? $_GET["lga_id"] : null;
$selected_ward = isset($_GET["ward_id"]) ? $_GET["ward_id"] : null;
$selected_p_u = isset($_GET["p_u_id"]) ? $_GET["p_u_id"] : null;

if (isset($_GET["submit"])) {
    # code...
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
                    <select name="state_id" id="state" required onchange="this.form.submit()">
                        <option value="">--- Select State ---</option>
                        <?php $states = $object->get_states();
                        if (is_string($states)) {
                        ?>
                            <option value=""><?php echo $states ?></option>
                        <?php } else if (is_array($states)) { ?>
                            <?php foreach ($states as $key => $value) {
                            ?>
                                <option value="<?php echo $states[$key]["state_id"] ?>" <?php echo $selected_state === $states[$key]["state_id"] ? "selected" : "" ?>>
                                    <?php echo $states[$key]["state_name"]; ?>
                                </option>
                            <?php } ?>

                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="lga">LGA: </label>
                    <select name="lga_id" id="lga" required onchange="this.form.submit()">
                        <option value="">--- Select LGA ---</option>
                        <?php $lga = $object->get_lga_by_state($selected_state);
                        if (is_string($lga)) {
                        ?>
                            <option value=""><?php echo $lga ?></option>
                        <?php } else if (is_array($lga)) { ?>
                            <?php foreach ($lga as $key => $value) {
                            ?>
                                <option value="<?php echo $lga[$key]["uniqueid"] ?>" <?php echo $selected_lga === $lga[$key]["uniqueid"] ? "selected" : "" ?>>
                                    <?php echo $lga[$key]["lga_name"] ?>
                                </option>
                            <?php } ?>

                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="ward">WARD: </label>
                    <select name="ward_id" id="ward" required onchange="this.form.submit()">
                        <option value="">--- Select Ward ---</option>
                        <?php $ward = $object->get_ward_by_lga($selected_lga);
                        if (is_string($ward)) {
                        ?>
                            <option value=""><?php echo $ward ?></option>
                        <?php } else if (is_array($ward)) { ?>
                            <?php foreach ($ward as $key => $value) {
                            ?>
                                <option value="<?php echo $ward[$key]["uniqueid"] ?>" <?php echo $selected_ward === $ward[$key]["uniqueid"] ? "selected" : "" ?>>
                                    <?php echo $ward[$key]["ward_name"]; ?>
                                </option>
                            <?php } ?>

                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="pu">POLLING UNIT: </label>
                    <select name="p_u_id" id="pu" required>
                        <option value="">--- Select Polling Unit ---</option>
                        <?php $p_u = $object->get_p_u_by_ward($selected_ward);
                        if (is_string($p_u)) {
                        ?>
                            <option value=""><?php echo $p_u ?></option>
                        <?php } else if (is_array($p_u)) { ?>
                            <?php foreach ($p_u as $key => $value) {
                            ?>
                                <option value="<?php echo $p_u[$key]["uniqueid"] ?>" <?php echo $selected_ward === $p_u[$key]["uniqueid"] ? "selected" : "" ?>>
                                    <?php echo $p_u[$key]["polling_unit_name"]; ?>
                                </option>
                            <?php } ?>

                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="party">PARTY: </label>
                    <select name="p_u_id" id="pu" required>
                        <option value="">--- Select Party ---</option>
                        <?php $parties = $object->get_parties();
                        if (is_string($parties)) {
                        ?>
                            <p><?php echo $parties ?></p>
                        <?php } else if (is_array($parties)) { ?>
                            <?php foreach ($parties as $key => $value) {
                            ?>
                                <option id="party" name="party" readonly value="<?php echo $parties[$key]["id"] ?>" required>
                                    <?php echo $parties[$key]["partyname"] ?>
                                </option>
                            <?php } ?>

                        <?php } ?>

                    </select>
                </div>

                <div>
                    <label for="party-score">PARTY SCORE: </label>
                    <input type="number" name="party_score" id="party-score">
                </div>

                <div>
                    <button type="submit" name="submit"> Submit Result </button>
                </div>
            </form>
        </section>
    </main>

</body>

</html>