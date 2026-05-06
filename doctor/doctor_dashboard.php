<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointments - Medical Sign</title>
    <style>
        :root {
            --primary-blue: #2980b9;
            --hover-blue: #1a5276;
            --page-bg: #eef2f7;
            --text-main: #2c3e50;
            --text-sub: #7f8c8d;
            --success-bg: #ebf5fb;
            --border-light: #ecf0f1;
            --shadow-blue: rgba(41, 128, 185, 0.1);
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--page-bg);
            color: var(--text-main);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            animation: fadeUp 0.8s ease;
        }

        .top-brand {
            text-align: center;
            margin-bottom: 35px;
        }

        .top-brand img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .top-brand h1 {
            color: var(--primary-blue);
            font-size: 34px;
            margin-bottom: 8px;
        }

        .top-brand p {
            color: var(--text-sub);
            font-size: 16px;
        }

        .page-header {
            background-color: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px var(--shadow-blue);
            border-top: 5px solid var(--primary-blue);
            margin-bottom: 25px;
        }

        .page-header h2 {
            color: var(--primary-blue);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .page-header p {
            color: var(--text-sub);
            font-size: 15px;
        }

        .table-card {
            background-color: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px var(--shadow-blue);
            border-top: 5px solid var(--primary-blue);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 14px;
            text-align: left;
            font-size: 15px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid var(--border-light);
            font-size: 14px;
            color: var(--text-main);
        }

        tr:hover {
            background-color: #f8fbfd;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 10px;
            font-size: 13px;
        }

        .confirmed {
            background-color: var(--success-bg);
            color: var(--primary-blue);
        }

        .pending {
            background-color: #fdf2e9;
            color: #c27c0e;
        }

        .completed {
            background-color: #eafaf1;
            color: #239b56;
        }

        .action-btn {
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            padding: 8px 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s ease;
            font-size: 13px;
            margin-right: 6px;
        }

        .action-btn:hover {
            background-color: var(--hover-blue);
            transform: scale(1.05);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 12px 18px;
            border-radius: 10px;
            transition: 0.3s ease;
        }

        .back-link:hover {
            background-color: var(--hover-blue);
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .top-brand h1 {
                font-size: 28px;
            }

            .page-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="top-brand">
            <a href="index.php">
        <img src="../images/logo.png" alt="MedicalSign">
    </a>
            <h1>Medical Sign</h1>
            <p>Doctor Appointments</p>
        </div>

        <div class="page-header">
            <h2>Appointments List</h2>
            <p>View all current and upcoming appointments assigned to the doctor.</p>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Aisha Mohammed</td>
                        <td>2026-04-12</td>
                        <td>10:00 AM</td>
                        <td>Medical Sign Consultation</td>
                        <td><span class="status confirmed">Confirmed</span></td>
                        <td>
                            <button class="action-btn">View</button>
                            <button class="action-btn">Complete</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Khalid Salem</td>
                        <td>2026-04-12</td>
                        <td>11:30 AM</td>
                        <td>Translation Assistance</td>
                        <td><span class="status pending">Pending</span></td>
                        <td>
                            <button class="action-btn">View</button>
                            <button class="action-btn">Confirm</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Nora Ali</td>
                        <td>2026-04-12</td>
                        <td>01:00 PM</td>
                        <td>Follow-up Session</td>
                        <td><span class="status confirmed">Confirmed</span></td>
                        <td>
                            <button class="action-btn">View</button>
                            <button class="action-btn">Complete</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Faisal Ahmed</td>
                        <td>2026-04-13</td>
                        <td>09:30 AM</td>
                        <td>Initial Consultation</td>
                        <td><span class="status completed">Completed</span></td>
                        <td>
                            <button class="action-btn">View</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Maha Saad</td>
                        <td>2026-04-13</td>
                        <td>12:00 PM</td>
                        <td>Medical Communication Support</td>
                        <td><span class="status pending">Pending</span></td>
                        <td>
                            <button class="action-btn">View</button>
                            <button class="action-btn">Confirm</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="doctor_dashboard.html" class="back-link">Back to Dashboard</a>
        </div>

    </div>

</body>
</html>