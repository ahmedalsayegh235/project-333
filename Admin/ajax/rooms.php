<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'fetch') {
            // get all the rooms
            $stmt = $pdo->query("SELECT * FROM rooms");
            $output = "";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $status = $row['status'] == 1 ? "Active" : "Inactive";
                $output .= "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['department']}</td>
                        <td>{$status}</td>
                        <td>
                            <button class='btn btn-sm btn-warning edit-room' data-id='{$row['id']}'>Edit</button>
                            <button class='btn btn-sm btn-danger delete-room' data-id='{$row['id']}'>Delete</button>
                        </td>
                    </tr>
                ";
            }
            echo $output;

        } elseif ($action === 'add') {
            // Add a new room
            $name = $_POST['name'];
            $department = $_POST['department'];
            $description = $_POST['desc'];

            $stmt = $pdo->prepare("INSERT INTO rooms (name, department, description, status) VALUES (?, ?, ?, 1)");
            $res = $stmt->execute([$name, $department, $description]);

            echo json_encode(['status' => $res ? 'success' : 'failed']);

        } elseif ($action === 'edit-fetch') {
            // get the room's data for editing
            $id = $_POST['id'];

            $stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
            $stmt->execute([$id]);
            $room = $stmt->fetch(PDO::FETCH_ASSOC);

            echo json_encode($room);

        } elseif ($action === 'update') {
            // Update a room's data
            $id = $_POST['id'];
            $name = $_POST['name'];
            $department = $_POST['department'];
            $description = $_POST['desc'];
            $status = $_POST['status'];

            $stmt = $pdo->prepare("UPDATE rooms SET name = ?, department = ?, description = ?, status = ? WHERE id = ?");
            $res = $stmt->execute([$name, $department, $description, $status, $id]);

            echo json_encode(['status' => $res ? 'success' : 'failed']);
        }elseif ($action === 'delete') {
            $id = $_POST['id'];
        
            if (!empty($id)) {
                $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = ?");
                $res = $stmt->execute([$id]);
        
                echo json_encode(['status' => $res ? 'success' : 'failed']);
            } else {
                echo json_encode(['status' => 'failed', 'message' => 'Invalid Room ID']);
            }
        }
        
    }
}

?>
