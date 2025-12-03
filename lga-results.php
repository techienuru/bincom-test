<?php
include_once "./include/connect.php";
include_once "./modules/classes.php";

$object = new bincom_test($connect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results by LGA | Bincom Test</title>
</head>

<body>
    <main>
        <section>
            <h1>Results by Local Government Area</h1>
            <form action="" method="get">
                <label for="lga">LGA: </label>
                <select name="lga_id" id="lga">
                    <?php
                    $sql = $object->select_lga();
                    while ($result = $sql->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $result["uniqueid"] ?>"><?php echo $result["lga_name"] ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Get Results">
            </form>
        </section>
        <section>
            <?php
            if ($_GET["lga_id"]) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    print_r($object->get_polling_unit_by_lga($_GET["lga_id"]));
                    // $result = $object->get_result_by_lga($_GET["lga_id"]);

                    ?>
                    <?php

                    ?>
                    <tbody></tbody>
                </table>
            <?php } ?>
        </section>
    </main>

</body>

</html>