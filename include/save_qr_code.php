<?php
/**
 * Save QR Code Handler
 * Saves a user's QR code to the database for future retrieval
 * 
 * POST Parameters:
 * - qr_data: The QR code data (e.g., "LRN:12345,Name:John Doe,Grade:10,Section:A")
 * - qr_image_url: The URL to the QR code image
 * - full_name: User's full name
 * - lrn_or_employee_number: Student LRN or Employee number
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_qr') {
    session_start();
    require_once 'db_conn.php';

    try {
        // Check if user is logged in
        if (!isset($_SESSION['lrn']) && !isset($_SESSION['employee_id'])) {
            echo json_encode(['success' => false, 'message' => 'User not authenticated']);
            exit();
        }

        // Determine user type and ID
        $user_type = isset($_SESSION['lrn']) ? 'student' : 'employee';
        $user_id = $user_type === 'student' ? $_SESSION['lrn'] : $_SESSION['employee_id'];
        
        // Validate input
        $qr_data = isset($_POST['qr_data']) ? trim($_POST['qr_data']) : '';
        $qr_image_url = isset($_POST['qr_image_url']) ? trim($_POST['qr_image_url']) : '';
        $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
        $lrn_or_employee_number = isset($_POST['lrn_or_employee_number']) ? trim($_POST['lrn_or_employee_number']) : '';

        if (empty($qr_data) || empty($qr_image_url) || empty($full_name) || empty($lrn_or_employee_number)) {
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit();
        }

        // Prepare statement to insert or update QR code
        $query = "INSERT INTO saved_qr_codes (user_id, user_type, lrn_or_employee_number, full_name, qr_data, qr_image_url) 
                  VALUES (?, ?, ?, ?, ?, ?)
                  ON DUPLICATE KEY UPDATE 
                  qr_data = VALUES(qr_data),
                  qr_image_url = VALUES(qr_image_url),
                  full_name = VALUES(full_name),
                  updated_at = CURRENT_TIMESTAMP";

        $stmt = mysqli_prepare($conn, $query);
        if (!$stmt) {
            throw new Exception("Database error: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "ssssss", $user_id, $user_type, $lrn_or_employee_number, $full_name, $qr_data, $qr_image_url);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode([
                'success' => true, 
                'message' => 'QR code saved successfully! You can retrieve it anytime from your account.'
            ]);
        } else {
            throw new Exception("Execute failed: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit();
}
?>
