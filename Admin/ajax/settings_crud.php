<?php
require("../inc/db_config.php");
require("../inc/essentials.php");
adminLogin();

if (isset($_POST['get_general'])) {
    $query = "SELECT site_title, site_about, shutdown FROM settings WHERE sr_no = 1";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('Content-Type: application/json');
            echo json_encode(["error" => "Failed to fetch settings."]);
        }
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(["error" => $e->getMessage()]);
    }
    exit;
}

if (isset($_POST['upd_general'])) {
    // Sanitize input data
    $frm_data = filteration($_POST);

    // Prepare query and values
    $query = "UPDATE settings SET site_title = ?, site_about = ? WHERE sr_no = ?";
    $values = [$frm_data['site_title'], $frm_data['site_about'], 1];

    try {
        // Prepare and execute the query
        $stmt = $pdo->prepare($query);
        $stmt->execute($values);

        // Return a success response
        header('Content-Type: application/json'); // Ensure JSON header
        echo json_encode(["success" => true, "message" => "Settings updated successfully."]);
        exit; // Ensure no extra output is sent
    } catch (PDOException $e) {
        // Handle query errors
        header('Content-Type: application/json'); // Ensure JSON header
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
        exit; // Ensure no extra output is sent
    }
}

if (isset($_POST['upd_shutdown'])) {
    header('Content-Type: application/json');

    // Sanitize and validate the input
    $frm_data = intval(filter_input(INPUT_POST, 'upd_shutdown', FILTER_SANITIZE_NUMBER_INT));

    // make sure that the value is either 0 or 1
    if ($frm_data !== 0 && $frm_data !== 1) {
        echo json_encode(["success" => false, "message" => "Invalid value for shutdown."]);
        exit;
    }

    // query
    $query = "UPDATE settings SET `shutdown` = ? WHERE sr_no = ?";
    $values = [$frm_data, 1];

    try {
        $stmt = $pdo->prepare($query);
        $res = $stmt->execute($values);

        if ($res) {
            echo json_encode(["success" => true, "message" => "Shutdown updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update shutdown."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No data received."]);
}


