<?php
include_once "include/connect.php";
include_once "modules/classes.php";

$object = new bincom_test($connect);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling Unit Results | Bincom Test</title>
</head>

<body>
    <main>
        <section>
            <a href="./index.php">Back to home</a>
            <h2>Results for any individual polling unit</h2>
            <table>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Polling Unit</th>
                        <th>Party</th>
                        <th>Party Score</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = $object->select_pol_unit_result();
                    $number = 0;
                    while ($result = $sql->fetch_assoc()) {
                        $number++;
                    ?>
                        <tr>
                            <td>
                                <?php echo $number; ?>
                            </td>
                            <td class="nav-item nav-link">
                                <?php echo $result['polling_unit_name'] ?>
                            </td>
                            <td class="nav-item nav-link">
                                <?php echo $result['party_abbreviation'] ?>
                            </td>
                            <td class="nav-item nav-link">
                                <?php echo $result['party_score'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>