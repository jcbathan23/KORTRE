<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: loginDefault.php");
    exit();
}

// Define variables for filter persistence
$start_date = $_GET['start_date'] ?? date('Y-m-01');
$end_date = $_GET['end_date'] ?? date('Y-m-t');
$report_type = $_GET['report_type'] ?? 'financial';
$department = $_GET['department'] ?? 'all';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMIS Reports</title>
    <link rel="icon" href="logo.png">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.min.css">
    <link href='assets/vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../components/tm.css">
    <style>
        .main-content {
            margin-left: 300px;
            transition: margin-left 0.3s;
            padding: 20px;
            width: calc(100% - 300px);
        }
        
        #sidebar.collapsed ~ .main-content {
            margin-left: 0;
            width: 100%;
        }

        .container-fluid {
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .card {
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include_once 'index.php'; ?>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">HOMIS Reports</h5>
                        </div>
                        <div class="card-body">
                            <!-- Report Filters -->
                            <form method="GET" action="" class="mb-4">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" value="<?php echo htmlspecialchars($start_date); ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control" value="<?php echo htmlspecialchars($end_date); ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Report Type</label>
                                        <select name="report_type" class="form-select">
                                            <option value="financial" <?php echo ($report_type === 'financial') ? 'selected' : ''; ?>>Financial Report</option>
                                            <option value="inventory" <?php echo ($report_type === 'inventory') ? 'selected' : ''; ?>>Inventory Report</option>
                                            <option value="patient" <?php echo ($report_type === 'patient') ? 'selected' : ''; ?>>Patient Report</option>
                                            <option value="service" <?php echo ($report_type === 'service') ? 'selected' : ''; ?>>Service Report</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Department</label>
                                        <select name="department" class="form-select">
                                            <option value="all" <?php echo ($department === 'all') ? 'selected' : ''; ?>>All Departments</option>
                                            <option value="inpatient" <?php echo ($department === 'inpatient') ? 'selected' : ''; ?>>Inpatient</option>
                                            <option value="outpatient" <?php echo ($department === 'outpatient') ? 'selected' : ''; ?>>Outpatient</option>
                                            <option value="emergency" <?php echo ($department === 'emergency') ? 'selected' : ''; ?>>Emergency</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                            </form>

                            <!-- Financial Overview -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">Total Revenue</h6>
                                            <h3 class="mb-0">₱1,500,000</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">Total Expenses</h6>
                                            <h3 class="mb-0">₱800,000</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">Net Income</h6>
                                            <h3 class="mb-0">₱700,000</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-warning text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">Pending Payments</h6>
                                            <h3 class="mb-0">₱200,000</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Financial Report Table -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Financial Summary</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Revenue</th>
                                                    <th>Expenses</th>
                                                    <th>Net</th>
                                                    <th>% of Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Inpatient Services</td>
                                                    <td>₱800,000</td>
                                                    <td>₱400,000</td>
                                                    <td>₱400,000</td>
                                                    <td>57.1%</td>
                                                </tr>
                                                <tr>
                                                    <td>Outpatient Services</td>
                                                    <td>₱500,000</td>
                                                    <td>₱250,000</td>
                                                    <td>₱250,000</td>
                                                    <td>35.7%</td>
                                                </tr>
                                                <tr>
                                                    <td>Emergency Services</td>
                                                    <td>₱200,000</td>
                                                    <td>₱150,000</td>
                                                    <td>₱50,000</td>
                                                    <td>7.2%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Statistics -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Service Statistics</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Service Type</th>
                                                    <th>Total Cases</th>
                                                    <th>Average Cost</th>
                                                    <th>Total Revenue</th>
                                                    <th>Success Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>General Consultation</td>
                                                    <td>1,200</td>
                                                    <td>₱500</td>
                                                    <td>₱600,000</td>
                                                    <td>98%</td>
                                                </tr>
                                                <tr>
                                                    <td>Specialized Treatment</td>
                                                    <td>500</td>
                                                    <td>₱2,000</td>
                                                    <td>₱1,000,000</td>
                                                    <td>95%</td>
                                                </tr>
                                                <tr>
                                                    <td>Emergency Care</td>
                                                    <td>300</td>
                                                    <td>₱1,500</td>
                                                    <td>₱450,000</td>
                                                    <td>92%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Export Options -->
                            <div class="text-end">
                                <button class="btn btn-success me-2" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel me-2"></i>Export to Excel
                                </button>
                                <button class="btn btn-danger" onclick="exportToPDF()">
                                    <i class="fas fa-file-pdf me-2"></i>Export to PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function getFilterValues() {
            const startDate = document.querySelector('input[name="start_date"]').value;
            const endDate = document.querySelector('input[name="end_date"]').value;
            const reportType = document.querySelector('select[name="report_type"]').value;
            const department = document.querySelector('select[name="department"]').value;
            return `start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}&report_type=${encodeURIComponent(reportType)}&department=${encodeURIComponent(department)}`;
        }

        function exportToExcel() {
            const filters = getFilterValues();
            window.location.href = `export_handler.php?format=excel&${filters}`;
        }

        function exportToPDF() {
            const filters = getFilterValues();
            window.location.href = `export_handler.php?format=pdf&${filters}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.getElementById('sidebar');
            var sidebarToggle = document.getElementById('sidebarToggle');
            var backdrop = document.getElementById('sidebar-backdrop');
            function closeSidebar() {
                sidebar.classList.add('collapsed');
                sidebar.classList.remove('show-backdrop');
                backdrop.style.display = 'none';
            }
            function openSidebar() {
                sidebar.classList.remove('collapsed');
                sidebar.classList.add('show-backdrop');
                backdrop.style.display = 'block';
            }
            sidebarToggle.addEventListener('click', function() {
                if (sidebar.classList.contains('collapsed')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });
            backdrop.addEventListener('click', function() {
                closeSidebar();
            });
            // Sidebar starts open on page load
            sidebar.classList.remove('collapsed');
            sidebar.classList.remove('show-backdrop');
            backdrop.style.display = 'none';
        });
    </script>
</body>
</html> 