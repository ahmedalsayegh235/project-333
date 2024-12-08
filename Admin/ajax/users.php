<?php
require('../inc/db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'fetch') {
            $stmt = $pdo->query("SELECT * FROM users");
            $output = "";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $status = $row['status'] == 1 ? "Active" : "Inactive";
                $output .= "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$status}</td>
                        <td>
                            <button class='btn btn-sm btn-warning edit-user' data-id='{$row['id']}'>Edit</button>
                            <button class='btn btn-sm btn-danger delete-user' data-id='{$row['id']}'>Delete</button>
                        </td>
                    </tr>
                ";
            }
            echo $output;

        } elseif ($action === 'add') {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, status) VALUES (?, ?, ?, ?)");
            $res = $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['status']]);
            echo json_encode(['status' => $res ? 'success' : 'failed']);

        } elseif ($action === 'edit-fetch') {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));

        } elseif ($action === 'update') {
            $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, phone = ?, status = ? WHERE id = ?");
            $res = $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['status'], $_POST['id']]);
            echo json_encode(['status' => $res ? 'success' : 'failed']);

        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $res = $stmt->execute([$_POST['id']]);
            echo json_encode(['status' => $res ? 'success' : 'failed']);
        }
    }
}
