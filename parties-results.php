<?php
include_once "./include/connect.php";
include_once "./modules/classes.php";

$object = new bincom_test($connect);
$selected_state = isset($_GET["state_id"]) ? $_GET["state_id"] : null;
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
            <form action="" method="get">
                <div>
                    <label for="state">STATE: </label>
                    <select name="state_id" id="state" required onchange="this.form.submit()">
                        <?php $states = $object->get_states();
                        if (is_string($states)) {
                        ?>
                            <option value=""><?php echo $states ?></option>
                        <?php } else if (is_array($states)) { ?>
                            <?php foreach ($states as $key => $value) {
                            ?>
                                <option value="<?php echo $states[$key]["state_id"] ?>">
                                    <?php echo $states[$key]["state_name"] ?>
                                </option>
                            <?php } ?>

                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="lga">LGA: </label>
                    <select name="lga" id="lga"></select>
                </div>
                <div>
                    <label for="ward">WARD: </label>
                    <select name="ward" id="ward"></select>
                </div>
                <div>
                    <label for="pu">POLLING UNIT: </label>
                    <select name="pu" id="pu"></select>
                </div>
            </form>
        </section>
    </main>

</body>

</html>