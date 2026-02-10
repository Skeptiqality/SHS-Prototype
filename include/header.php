<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
    <style>
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

        /* Dark mode */
        body.dark {
            --bg: #0b1220;
            --card: #0f1724;
            --muted: #9aa4b2;
            --shadow-sm: 0 6px 18px rgba(2, 6, 23, 0.7);
            --shadow-md: 0 12px 30px rgba(2, 6, 23, 0.75);
            --border: 1px solid rgba(255, 255, 255, 0.03);
            --text: #e6eef8;
        }

        /* Basic reset */
        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }


        header {
            background: linear-gradient(90deg, var(--green-1), var(--green-2));
            color: #fff;
            padding: 18px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand img {
            width: 64px;
            height: 64px;
            border-radius: 999px;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.12);
        }

        .brand h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.6px;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Simple flat scan button */
        .btn-scan {
            background: var(--green-1);
            color: #fff;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* Dark mode */
        .toggle {
            background: rgba(255, 255, 255, 0.08);
            padding: 8px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .toggle i {
            font-size: 14px;
        }

        .nav {
            display: flex;
            gap: 1rem;
        }

        .nav-menu {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            cursor: pointer;
        }

        .dropbtn i {
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            color: black;
            min-width: 200px;
            box-shadow: var(--shadow);
            z-index: 1;
            border-radius: var(--border-radius);
            overflow: hidden;
            transform: translateY(10px);
            opacity: 0;
            transition: var(--transition);
        }

        .dropdown-content a {
            color: var(--text-dark);
            padding: 12px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .dropdown-content a i {
            color: var(--primary-color);
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            color: var(--primary-color);
        }

        .nav-menu:hover .dropdown-content {
            display: block;
            transform: translateY(0);
            opacity: 1;
        }

        .nav-menu:hover .dropbtn {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-menu:hover .dropbtn i {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>
    <header>
        <div class="header-left">
            <div class="brand">
                <img src="../Pics/Logos/Lagro_High_School_logo.png" alt="logo">
                <div>
                    <h1>LAGRO HIGH SCHOOL</h1>
                    <div style="font-size:12px; color:rgba(255,255,255,0.9);">Security Management System</div>
                </div>
            </div>
        </div>
        <div class="header-actions">
            <nav class="nav">
                <div class="nav-menu">
                    <button class="dropbtn">Home <i class="fas fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                        <a href="about-us.php"><i class="fa-solid fa-users-line"></i> About Us</a>
                        <a href="attendance-log.php"><i class="fas fa-clipboard-check"></i> Attendance Log</a>
                    </div>
                </div>

                <div class="nav-menu">
                    <button class="dropbtn">Registration <i class="fas fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                        <a href="student_form.php"><i class="fas fa-user-graduate"></i> Student</a>
                        <a href="personnel_form.php"><i class="fas fa-user-tie"></i> School Personnel</a>
                    </div>
                </div>

                <div class="nav-menu">
                    <button class="dropbtn">QR Tools <i class="fas fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                        <a href="scanner.php"><i class="fas fa-qrcode"></i> QR Scanner</a>
                    </div>
                </div>

                <div class="nav-menu">
                    <button class="dropbtn">[Account_Name] <i class="fas fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#"><i class="fa-solid fa-user"></i> Profile</a>
                        <a href="saved-qr-codes.php"><i class="fa-solid fa-floppy-disk"></i> Saved QR Code</a>
                        <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </div>
                </div>
            </nav>

            <!-- Dark mode toggle -->
            <div id="darkToggle" class="toggle" title="Toggle dark mode">
                <i id="darkIcon" class="fa-solid fa-moon"></i>
            </div>
        </div>
    </header>
    <script>
        (function() {
            const body = document.body;
            const toggle = document.getElementById('darkToggle');
            const icon = document.getElementById('darkIcon');
            // Load saved preference
            const saved = localStorage.getItem('lagro_dark_mode');
            if (saved === '1') {
                body.classList.add('dark');
                icon.className = 'fa-solid fa-sun';
            }

            toggle.addEventListener('click', function() {
                const isDark = body.classList.toggle('dark');
                icon.className = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
                // Save preference
                localStorage.setItem('lagro_dark_mode', isDark ? '1' : '0');
            });
        })();
     
        // Simple animation for stats on load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.stat').forEach((el, i) => {
                el.style.opacity = 0;
                el.style.transform = 'translateY(8px)';
                setTimeout(() => {
                    el.style.transition = 'all 300ms ease';
                    el.style.opacity = 1;
                    el.style.transform = 'translateY(0)';
                }, i * 90);
            });
        });
    </script>
</body>

</html>