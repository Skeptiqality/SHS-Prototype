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

        :root {
            --bg: #f4f6f8;
            --card: #ffffff;
            --muted: #6b7280;
            --green-1: #095d2fff; /* gradient start */
            
            --green-2: #1fa25a; /* gradient end */
            
            --radius: 12px;
            --shadow-sm: 0 6px 18px rgba(19, 42, 34, 0.06);
            --shadow-md: 0 12px 30px rgba(19, 42, 34, 0.08);
            --border: 1px solid rgba(15, 23, 42, 0.06);
            --text: #0f172a;

            --primary-color: #229221;
            --primary-dark: #105a0f;
            --secondary-color: #24a85b;
            --secondary-dark: #27ae60;
            --accent-color: #f39c12;
            --dark-color: #306e3a;
            --light-color: #ecf0f1;
            --danger-color: #e74c3c;
            --grey-100: #f8f9fa;
            --grey-200: #e9ecef;
            --grey-300: #dee2e6;
            --grey-400: #ced4da;
            --grey-500: #adb5bd;
            --grey-600: #6c757d;
            --grey-700: #495057;
            --grey-800: #343a40;
            --grey-900: #212529;
            --white: #ffffff;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.1);
            --border-radius-sm: 4px;
            --border-radius-md: 8px;
            --border-radius-lg: 16px;
            --transition-fast: 150ms ease;
            --transition-normal: 300ms ease;
            --transition-slow: 500ms ease;
            --font-family: 'Montserrat', sans-serif;
            --success-color: #52b788; /* Added success color */
            --danger-color: #e63946; /* Added danger color */
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
            top: 116.5px;
            left: 47px;
            width: 144px;
            height: 144.5px;
            object-fit: cover;
            border-radius: 2px;
        }

        /* TEXT UNDER ID CARD */
        .id-note {
            text-align: center;
            color: #2d572c;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        /* id info */
        .id-lrn {
            position: absolute;
            top: 135px;
            left: 285px;
            font-size: 1.2rem;
            font-weight: 600;
            color: #5e1515;
        } 

        .id-name {
            position: absolute;
            top: 195px;
            left: 290px;
            font-size: 1.2rem;
            font-weight: 700;
            color: #000000;
        }

        .id-grade-section {
            position: absolute;
            top: 250px;
            left: 300px;
            font-size: 1.2rem;
            font-weight: 600;
            color: #5e1515;
        }

        .back img {
            position: absolute;
            top: 113px;
            left: 60px;
            width: 160px;
            height: 160px;
            object-fit: cover;
        }

        .id-parent {
            position: absolute;
            top: 80px;
            left: 365px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff;
        }

        .id-parent-contact {
            position: absolute;
            top: 135px;
            left: 335px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff;
        }

        .id-address {
            position: absolute;
            top: 195px;
            left: 335px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff;
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

                <p class="id-lrn"><?php echo $user['lrn']; ?></p>
                <p class="id-name"><?php echo $user['first_name'] . " " . $user['middle_name'] . " " . $user['last_name']; ?></p>
                <p class="id-grade-section"><?php echo $user['grade_level'] . " - " . $user['section']; ?></p>

            </div>

            <div class="id-card back">
                <img src="<?php echo htmlspecialchars($qr_code_url); ?>" alt="QRCODE">

                <p class="id-parent"><?php echo $user['parent_guardian']; ?></p>
                <p class="id-parent-contact"><?php echo $user['parent_guardian_contact']; ?></p>
                <p class="id-address"><?php echo $user['student_address']; ?></p>
                <p class="adviser"></p>
            </div>
        </div>
    </main>

</body>
</html>
