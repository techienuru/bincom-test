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
            padding: 30px 20px;
        }

        main {
            max-width: 1000px;
            margin: 0 auto;
        }

        section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            margin-bottom: 30px;
        }

        section:last-child {
            margin-bottom: 0;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 8px 15px;
            border-radius: 6px;
        }

        a:hover {
            color: #764ba2;
            background-color: rgba(102, 126, 234, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 26px;
            text-align: center;
        }

        form {
            display: flex;
            gap: 15px;
            align-items: flex-end;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        form>div {
            flex: 1;
            min-width: 200px;
        }

        label {
            display: block;
            color: #555;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        select,
        input[type="submit"] {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        select {
            width: 100%;
            background-color: white;
            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input[type="submit"] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            min-width: 150px;
        }

        input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        th {
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
            color: #555;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
            transition: background-color 0.2s ease;
        }

        tbody tr:last-child {
            background-color: #f5f5f5;
            font-weight: 600;
            color: #333;
        }

        tbody tr:last-child td {
            border-bottom: none;
            padding: 15px;
        }

        @media (max-width: 768px) {
            section {
                padding: 25px;
            }

            h1 {
                font-size: 22px;
            }

            form {
                flex-direction: column;
            }

            form>div {
                width: 100%;
            }

            input[type="submit"] {
                width: 100%;
            }

            th,
            td {
                padding: 10px 8px;
                font-size: 14px;
            }

            table {
                font-size: 13px;
            }
        }
    </style>
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