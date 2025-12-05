<?php
include_once "./includes/connect.php";
include_once "./modules/classes.php";

$object = new bincom_test($connect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total of all polling unit in LGA | Bincom Test</title>
</head>

<body>
    <main>
        <section>
            <a href="./index.php">Back to home</a>
            <h1>Sum total of all P.U result in Local Government Area</h1>
            <form action="" method="get">
                <label for="lga">LGA: </label>
                <select name="lga_id" id="lga">
                    <?php
                    $sql = $object->select_lga();
                    while ($result = $sql->fetch_assoc()) {
                        $uniqueid = $result["uniqueid"];
                        $lga_id = $_GET["lga_id"] || null;
                    ?>
                        <option value="<?php echo $uniqueid ?>" <?php echo $uniqueid === $lga_id ? "selected" : "" ?>>
                            <?php echo $result["lga_name"] ?>
                        </option>
                    <?php } ?>
                </select>
                <input type="submit" value="Get Results">
            </form>
        </section>
        <section>
            <?php
            if (isset($_GET["lga_id"])) {
                $lga_id = $_GET["lga_id"];
                $pu_results = $object->get_pu_result_by_lga($lga_id)
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>POLLING UNIT</th>
                            <th>LGA</th>
                            <th>PARTY</th>
                            <th>PARTY SCORE</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (is_string($pu_results)) {
                        ?>
                            <tr>
                                <td colspan="4" align="center">
                                    <?php echo $pu_results; ?>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($pu_results as $key => $value) {
                            ?>
                                <tr>
                                    <td><?php echo $value["polling_unit_name"] ?></td>
                                    <td><?php echo $value["lga_name"] ?></td>
                                    <td><?php echo $value["party_abbreviation"] ?></td>
                                    <td><?php echo $value["party_score"] ?></td>
                                </tr>

                            <?php } ?>
                            <tr>
                                <td colspan="5" align="center">
                                    Sum Total: <?php echo $object->get_pu_sum_by_lga($lga_id) ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }  ?>
        </section>
    </main>

</body>

</html>