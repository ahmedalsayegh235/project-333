<?php
require('../inc/db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'fetch') {
        $stmt = $pdo->query("
            SELECT b.id, u.name AS user_name, r.name AS room_name, b.selected_date, b.status 
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            JOIN rooms r ON b.room_id = r.id
        ");
        $output = "";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['user_name']}</td>
                    <td>{$row['room_name']}</td>
                    <td>{$row['selected_date']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <button class='btn btn-sm btn-warning edit-booking' data-id='{$row['id']}'>Edit</button>
                        <button class='btn btn-sm btn-danger delete-booking' data-id='1'>Delete</button>

                    </td>
                </tr>
            ";
        }
        echo $output;

    } elseif ($action === 'add') {
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, room_id, selected_date) VALUES (?, ?, ?)");
        $res = $stmt->execute([$_POST['user_id'], $_POST['room_id'], $_POST['selected_date']]);
        echo json_encode(['status' => $res ? 'success' : 'failed']);

    } elseif ($action === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
        $res = $stmt->execute([$_POST['id']]);
        echo json_encode(['status' => $res ? 'success' : 'failed']);
    }
    elseif ($action === 'edit-fetch') {
        $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($booking) {
            echo json_encode($booking);
        } else {
            echo json_encode(['error' => 'Booking not found']);
        }
    }
    if ($action === 'update') {
        $stmt = $pdo->prepare("
            UPDATE bookings 
            SET user_id = ?, room_id = ?, selected_date = ?, status = ? 
            WHERE id = ?
        ");
        $res = $stmt->execute([
            $_POST['user_id'], 
            $_POST['room_id'], 
            $_POST['selected_date'], 
            $_POST['status'], 
            $_POST['id']
        ]);
    
        echo json_encode(['status' => $res ? 'success' : 'failed']);
    }
    
}
