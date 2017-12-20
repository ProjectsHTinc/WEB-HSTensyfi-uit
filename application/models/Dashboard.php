<?php

Class Dashboard extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

  function getYear()
  {
      $sqlYear     = "SELECT * FROM edu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month AND status = 'Active'";
      $year_result = $this->db->query($sqlYear);
      $ress_year   = $year_result->result();

      if ($year_result->num_rows() == 1) {
          foreach ($year_result->result() as $rows) {
              $year_id = $rows->year_id;
          }
          return $year_id;
      }
  }

















}
?>
