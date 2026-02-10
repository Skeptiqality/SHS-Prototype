<?php
session_start();
include_once "../include/db_conn.php";

if (!isset($_SESSION['lrn']) && !isset($_SESSION['employee_id'])) {
    header("Location: ../login.php");
    exit();
}

$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;


$date_filter = isset($_GET['date']) ? $_GET['date'] : '';
$where_clause = '';
if (!empty($date_filter)) {
    $where_clause = " WHERE DATE(timestamp) = '$date_filter'";
}


$count_sql = "SELECT COUNT(*) as total FROM attendance" . $where_clause;
$count_result = $conn->query($count_sql);
$total_records = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);


$sql = "SELECT a.id, a.student_lrn, a.timestamp, 
        s.first_name, s.last_name, s.grade_level, s.section, s.profile_picture
        FROM attendance a
        LEFT JOIN student_info s ON a.student_lrn = s.lrn
        $where_clause
        ORDER BY a.timestamp DESC
        LIMIT $offset, $records_per_page";

$result = $conn->query($sql);


$dates_sql = "SELECT DISTINCT DATE(timestamp) as date FROM attendance ORDER BY date DESC";
$dates_result = $conn->query($dates_sql);
$dates = [];
while ($date_row = $dates_result->fetch_assoc()) {
    $dates[] = $date_row['date'];
}


$today = date('Y-m-d');
$stats_sql = "SELECT 
    (SELECT COUNT(*) FROM attendance WHERE DATE(timestamp) = '$today') as today_count,
    (SELECT COUNT(*) FROM attendance WHERE DATE(timestamp) = DATE_SUB('$today', INTERVAL 1 DAY)) as yesterday_count,
    (SELECT COUNT(*) FROM attendance WHERE DATE(timestamp) BETWEEN DATE_SUB('$today', INTERVAL 7 DAY) AND '$today') as week_count,
    (SELECT COUNT(*) FROM attendance) as total_count";
$stats_result = $conn->query($stats_sql);
$stats = $stats_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Log - Lagro High School</title>
    <link rel="icon" type="image/x-icon" href="../pics/logos/Lagro_High_School_logo.png">

    <style>
        /* ========================
           MAIN LAYOUT: two columns
           ======================== */
        .container {
            max-width: 1200px;
            margin: 28px auto;
            padding: 0 20px 40px;
            gap: 24px;
        }

        /* Page title block (subtle) */
        .page-title {
            grid-column: 1 / -1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }

        .page-title h2 {
            font-size: 20px;
            margin: 0;
        }

        .page-title p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        /* ========================
           STATS CARDS (4) — modern look
           ======================== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 18px;
        }

        .stat {
            background: var(--card);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: var(--shadow-sm);
            border: var(--border);
        }

        .stat .icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            flex: 0 0 56px;
        }

        .stat .info h3 {
            margin: 0;
            font-size: 20px;
        }

        .stat .info p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        /* Individual icon colors */
        .icon.today {
            background: linear-gradient(180deg, #2ea14a, #1e8f3f);
        }

        .icon.yesterday {
            background: linear-gradient(180deg, #28b37c, #1fa25a);
        }

        .icon.week {
            background: linear-gradient(180deg, #f6b64c, #f39c12);
        }

        .icon.total {
            background: linear-gradient(180deg, #1b6b3a, #154f2b);
        }

        /* ========================
           FILTER + TABLE
           ======================== */
        .panel {
            background: var(--card);
            border-radius: 12px;
            padding: 18px;
            box-shadow: var(--shadow-md);
            border: var(--border);
        }

        .filter-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .filter-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-label {
            color: var(--muted);
            font-weight: 600;
        }

        select#date {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            background: transparent;
            color: var(--muted);
        }

        /* Table styling — card look */
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .attendance-table thead th {
            text-align: left;
            padding: 14px;
            color: var(--muted);
            font-weight: 600;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .attendance-table tbody tr {
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .attendance-table td {
            padding: 18px 14px;
            vertical-align: middle;
        }

        /* Student info */
        .student-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            border: 1px solid rgba(15, 23, 42, 0.03);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-name {
            font-weight: 600;
        }

        .student-meta {
            font-size: 13px;
            color: var(--muted);
        }

        .lrn-badge {
            background: none;
            padding: 6px 0px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 17px;
            color: var(--muted);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 12px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 10px;
            background: var(--card);
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            border: var(--border);
            text-decoration: none;
            color: var(--text);
        }

        .pagination .active {
            background: linear-gradient(90deg, #1fa25a, #11924a);
            color: white;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 36px;
            color: var(--muted);
        }

        /* Responsive adjustments */
        @media (max-width: 1040px) {
            .container {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 12px 14px;
            }

            .brand h1 {
                font-size: 16px;
            }
        }

        /* small helper classes */
        .muted {
            color: var(--muted);
        }

        a.btn {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    include "../include/header.php";
    ?>
    <!-- ====================
         MAIN DASHBOARD LAYOUT
         ==================== -->
    <main class="container">

        <div class="page-title">
            <div>
                <h2>Attendance Log</h2>
                <p>View and manage attendance records for students, teachers, and personnel.</p>
            </div>
            <div class="muted">Showing latest attendance records</div>
        </div>

        <!-- LEFT COLUMN: stats + table -->
        <section>
            <!-- Stats cards (kept PHP values intact) -->
            <div class="stats-grid">
                <div class="stat">
                    <div class="icon today"><i class="fas fa-calendar-day"></i></div>
                    <div class="info">
                        <h3><?php echo $stats['today_count']; ?></h3>
                        <p>Today's Attendance</p>
                    </div>
                </div>

                <div class="stat">
                    <div class="icon yesterday"><i class="fas fa-calendar-minus"></i></div>
                    <div class="info">
                        <h3><?php echo $stats['yesterday_count']; ?></h3>
                        <p>Yesterday's Attendance</p>
                    </div>
                </div>

                <div class="stat">
                    <div class="icon week"><i class="fas fa-calendar-week"></i></div>
                    <div class="info">
                        <h3><?php echo $stats['week_count']; ?></h3>
                        <p>This Week's Attendance</p>
                    </div>
                </div>

                <div class="stat">
                    <div class="icon total"><i class="fas fa-calendar-alt"></i></div>
                    <div class="info">
                        <h3><?php echo $stats['total_count']; ?></h3>
                        <p>Total Attendance Records</p>
                    </div>
                </div>
            </div>

            <!-- FILTER + TABLE PANEL -->
            <div class="panel">
                <div class="filter-row">
                    <div class="filter-left">
                        <label class="filter-label">Filter by Date:</label>
                        <form method="GET" action="" id="filterForm">
                            <select id="date" name="date" onchange="document.getElementById('filterForm').submit();">
                                <option value="">All Dates</option>
                                <?php foreach ($dates as $date): ?>
                                    <option value="<?php echo $date; ?>" <?php echo ($date_filter == $date) ? 'selected' : ''; ?>>
                                        <?php echo date('F j, Y', strtotime($date)); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                        <?php if (!empty($date_filter)): ?>
                            <a href="attendance-log.php" class="btn muted" style="margin-left:8px;">Clear Filter</a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <!-- kept simple flat style for scan button -->
                        <a class="btn-scan" href="scanner.php"><i class="fa-solid fa-qrcode"></i> Scan Attendance</a>
                    </div>
                </div>

                <!-- Attendance table (PHP loop preserved) -->
                <?php if ($result && $result->num_rows > 0): ?>
                    <div style="overflow:hidden; border-radius:10px;">
                        <table class="attendance-table">
                            <thead>
                                <tr>
                                    <th style="width:70px;">ID</th>
                                    <th>Student</th>
                                    <th style="width:180px;">LRN</th>
                                    <th style="width:260px;">Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td>
                                            <div class="student-info">
                                                <div class="avatar">
                                                    <?php if (!empty($row['profile_picture']) && file_exists($row['profile_picture'])): ?>
                                                        <img src="<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="Student Photo">
                                                    <?php else: ?>
                                                        <i class="fas fa-user" style="color:var(--muted);"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <div class="student-name">
                                                        <?php
                                                        if (!empty($row['first_name']) && !empty($row['last_name'])) {
                                                            echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                                                        } else {
                                                            echo '<span style="color: var(--muted);">Unknown Student</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php if (!empty($row['grade_level']) && !empty($row['section'])): ?>
                                                        <div class="student-meta">Grade <?php echo htmlspecialchars($row['grade_level']); ?> - <?php echo htmlspecialchars($row['section']); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="lrn-badge"><?php echo htmlspecialchars($row['student_lrn']); ?></div>
                                        </td>
                                        <td class="muted"><?php echo date('F j, Y, g:i a', strtotime($row['timestamp'])); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (kept logic intact) -->
                    <?php if ($total_pages > 1): ?>
                        <div class="pagination">
                            <?php if ($page > 1): ?>
                                <a href="?page=1<?php echo !empty($date_filter) ? '&date=' . $date_filter : ''; ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                                <a href="?page=<?php echo $page - 1; ?><?php echo !empty($date_filter) ? '&date=' . $date_filter : ''; ?>">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            <?php else: ?>
                                <span class="disabled"><i class="fas fa-angle-double-left"></i></span>
                                <span class="disabled"><i class="fas fa-angle-left"></i></span>
                            <?php endif; ?>

                            <?php
                            $range = 2;
                            $start_page = max(1, $page - $range);
                            $end_page = min($total_pages, $page + $range);

                            if ($start_page > 1) {
                                echo '<a href="?page=1' . (!empty($date_filter) ? '&date=' . $date_filter : '') . '">1</a>';
                                if ($start_page > 2) {
                                    echo '<span class="disabled">...</span>';
                                }
                            }

                            for ($i = $start_page; $i <= $end_page; $i++) {
                                if ($i == $page) {
                                    echo '<span class="active">' . $i . '</span>';
                                } else {
                                    echo '<a href="?page=' . $i . (!empty($date_filter) ? '&date=' . $date_filter : '') . '">' . $i . '</a>';
                                }
                            }

                            if ($end_page < $total_pages) {
                                if ($end_page < $total_pages - 1) {
                                    echo '<span class="disabled">...</span>';
                                }
                                echo '<a href="?page=' . $total_pages . (!empty($date_filter) ? '&date=' . $date_filter : '') . '">' . $total_pages . '</a>';
                            }
                            ?>

                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?><?php echo !empty($date_filter) ? '&date=' . $date_filter : ''; ?>">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                                <a href="?page=<?php echo $total_pages; ?><?php echo !empty($date_filter) ? '&date=' . $date_filter : ''; ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            <?php else: ?>
                                <span class="disabled"><i class="fas fa-angle-right"></i></span>
                                <span class="disabled"><i class="fas fa-angle-double-right"></i></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-clipboard" style="font-size:36px;"></i>
                        <h3>No Attendance Records Found</h3>
                        <p>
                            <?php if (!empty($date_filter)): ?>
                                No attendance records were found for the selected date. Try selecting a different date or clearing the filter.
                            <?php else: ?>
                                There are no attendance records in the system yet. Use the QR scanner to record attendance.
                            <?php endif; ?>
                        </p>
                        <div style="margin-top: 1.5rem;">
                            <?php if (!empty($date_filter)): ?>
                                <a href="attendance-log.php" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Clear Filter
                                </a>
                            <?php else: ?>
                                <a href="scanner.php" class="btn-scan">
                                    <i class="fas fa-qrcode"></i> Go to Scanner
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
    <?php include '../include/footer.php'; ?>
</body>
    <script>

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
</html>