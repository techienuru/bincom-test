<?php
include_once "includes/connect.php";
include_once "modules/classes.php";

$object = new bincom_test($connect);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling Unit Results | Bincom Test</title>
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

        h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 26px;
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

        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tbody tr:nth-child(even):hover {
            background-color: #efefef;
        }

        .nav-item.nav-link {
            color: #555;
        }

        @media (max-width: 768px) {
            section {
                padding: 25px;
            }

            h2 {
                font-size: 22px;
            }

            th,
            td {
                padding: 10px 8px;
                font-size: 14px;
            }

            table {
                font-size: 13px;
            }

            th {
                font-size: 12px;
            }
        }

        @media (max-width: 500px) {
            section {
                padding: 15px;
            }

            h2 {
                font-size: 18px;
                margin-bottom: 20px;
            }

            th,
            td {
                padding: 8px 5px;
                font-size: 12px;
            }
        }
    </style>
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