<?php
session_start();
include "../include/db_conn.php";
include "../include/role_access.php";

// Handle logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // Destroy session
    session_unset();
    session_destroy();
    
    // Redirect to login page
    header("Location: ../login.php");
    exit();
}

// Get current user's role
$user_role = getCurrentUserRole();
$qr_code_url = null;

// Fetch user data based on role
    if ($user_role === 'STUDENT') {
    if (isset($_SESSION['lrn'])) {
        $sql = "SELECT * FROM student_info WHERE lrn = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['lrn']);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        
        // Use only the stored QR URL
        if (!empty($user['qr_code_url'])) {
            $qr_code_url = $user['qr_code_url'];
        }
    }
} else {
    // For employees
    if (isset($_SESSION['employee_id'])) {
        $sql = "SELECT * FROM employee_info WHERE employee_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['employee_id']);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        
        // Use only the stored QR URL
        if (!empty($user['qr_code_url'])) {
            $qr_code_url = $user['qr_code_url'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="icon" type="image/x-icon" href="../pics/logos/Lagro_High_School_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f8f3; 
            margin: 0;
            padding: 0;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            padding: 30px;
            justify-content: center;
        }

       .label {
            color: #2d572c;
            font-size: 1.8rem;
            margin-bottom: 20px;
       }

        h3, h5 {
            margin: 5px 0;
        }

        /* PROFILE */
        .info-container {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        .profile-pic {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .profile-pic img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid #2d572c;
            object-fit: cover;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            color: #2d572c;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        /* STUDENT ID SECTION */
        .id-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 600px;
        }

        .id-container h1 {
            text-align: center;
            margin-bottom: 15px;
            color: #2d572c;
        }

        /* FRONT AND BACK OF ID */
        .id-card {
            border: 2px solid #2d572c;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }

        .front, .back {
            width: 100%;
            height: 400px;
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
        }

        .front {
            background-image: url('uploads/front.jpg');
        }

        .back {
            background-image: url('uploads/back.jpg'); 
        }

        /* ID PIC */
        .front img {
            position: absolute;
            top: 120px;
            left: 40px;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 2px solid #5e1515;
            border-radius: 5px;
        }

        /* TEXT UNDER ID CARD */
        .id-note {
            text-align: center;
            color: #2d572c;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        /* for rizzponsive */
        @media (max-width: 900px) {
            main {
                flex-direction: column;
                align-items: center;
            }

            .info-container, .id-container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <?php include "../include/header.php"; ?>

    <main>
        <!-- STUDENT INFO SECTION -->
        <div class="info-container">
            <h1 class="label">Profile Information</h1>

            <div class="profile-pic">
                <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture">
                <div>
                    <h3><?php echo $user['first_name'] . " " . $user['middle_name'] . " " . $user['last_name']; ?></h3>
                    <h5><?php echo $user['email_address']; ?></h5>
                </div>
            </div>

            <!-- input for student info 'to drei >.< -->
            <label>LRN:</label>
            <input type="text" readonly value="<?php echo $user['lrn']; ?>">

            <label>Grade Level:</label>
            <input type="text" readonly value="<?php echo $user['grade_level']; ?>">

            <label>Section:</label>
            <input type="text" readonly value="<?php echo $user['section']; ?>">

            <label>Contact Number:</label>
            <input type="text" readonly value="<?php echo $user['contact_number']; ?>">

            <label>Address:</label>
            <input type="text" readonly value="<?php echo $user['student_address']; ?>">

            <label>Gender:</label>
            <input type="text" readonly value="<?php echo $user['sex']; ?>">

            <label>Age:</label>
            <input type="text" readonly value="<?php echo $user['age']; ?>">

            <label>QR CODE:</label>
            <div class="qr-container" style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                <?php if (!empty($qr_code_url)): ?>
                    <img src="<?php echo htmlspecialchars($qr_code_url); ?>" alt="QR Code" style="max-width: 250px; height: auto; border: 2px solid #2d572c; border-radius: 8px;">
                    <p style="margin-top: 10px; font-size: 0.9rem; color: #666;">Your QR Code - Generated on <?php echo date('F j, Y', strtotime($user['qr_code_generated_at'] ?? 'now')); ?></p>
                <?php else: ?>
                    <p style="color: #999; font-style: italic;">No QR code yet. Please complete your registration to generate a QR code.</p>
                <?php endif; ?>
            </div>
        </div>

        <!--STUDENT ID SECTION -->
        <div class="id-container">
            <h1 class="label">Student ID Preview</h1>
            <div class="id-card front">
                <img src="<?php echo $user['profile_picture']; ?>" alt="Student Photo">
            </div>

            <div class="id-card back"></div>
        </div>
    </main>

</body>
</html>
