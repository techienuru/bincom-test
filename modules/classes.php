<?php
class bincom_test
{
    public $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function select_pol_unit_result()
    {
        $sql = $this->connect->query("SELECT * FROM `announced_pu_results` INNER JOIN polling_unit ON `polling_unit`.`uniqueid` = announced_pu_results.polling_unit_uniqueid WHERE `announced_pu_results`.`polling_unit_uniqueid` = 8");
        return $sql;
    }

    public function select_lga()
    {
        $sql = $this->connect->query("SELECT * FROM `lga`");
        return $sql;
    }

    public function get_polling_unit_by_lga($lga_id)
    {
        // Retrieve all polling unit for the given LGA ID
        $sql = $this->connect->query("SELECT * FROM `polling_unit` WHERE `lga_id` = $lga_id");

        // Check if any polling units were found
        if ($sql && $sql->num_rows) {
            return $sql->fetch_all(MYSQLI_ASSOC);
        } else {
            return "No polling unit found";
        }
    }

    public function get_result_by_lga($lga_id)
    {
        // Retrieve all polling unit for the given LGA ID
        $polling_units = $this->get_polling_unit_by_lga($lga_id);
        if (is_string($polling_units)) {
            return $polling_units; // Return error message if no polling units found
        }

        $sql = $this->connect->query("SELECT * FROM `polling_unit` WHERE `lga_id` = $lga_id");
        return $sql;
    }
}
