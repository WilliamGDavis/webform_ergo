<?php

//function get_rfqs() {
//    try {
//        include '../mysql_login_pdo.php';
//        $db->beginTransaction();
//        $query = "SELECT `UserCompanyName`"
//                . "FROM `form_values`";
//
//        $stmt = $db->prepare($query);
//        $stmt->execute();
//        $db->commit();
//        while ($row = $stmt->fetchObject()) {
//            $UserCompanyName = $row->UserCompanyName;
//        }
//    } catch (Exception $e) {
////        db_errorHandler($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
//        $db->rollback();
//    }
//    $db = null;
//    return $UserCompanyName;
//}

function rfq_table_builder() {
    include './mysql_login_pdo.php';
    $query = "SELECT UserCompanyName "
            . "FROM form_values";

    $statement = $db->prepare($query);

    $statement->execute();

    $rfq_table = '';
    $rfq_table .= '<table border="1">';
    $rfq_table .= '<tr><td>UserCompanyName</td></tr>';

    while ($row = $statement->fetchObject()) {
        $UserCompanyName = $row->UserCompanyName;

        $rfq_table .= '<tr>';
        $rfq_table .= '<td>';
        $rfq_table .= $UserCompanyName;
        $rfq_table .= '</td>';
        $rfq_table .= '</tr>';
    }

    $rfq_table .= '</table>';
    $db = null;
    return $rfq_table;
}
$x = rfq_table_builder();
echo $x;