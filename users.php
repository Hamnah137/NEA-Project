<!-- Code to see users registered in the website -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Users</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            width: 90%;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #FFD700;
        }

        a {
            color: #4ABDAC;
            text-decoration: none;
            font-size: 1.1em;
        }

        a:hover {
            color: #0078ff;
            text-decoration: underline;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            color: black;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #444;
        }

        table th {
            background-color: #333;
            color: #FFD700;
        }

        table td {
            background-color: #fff;
        }

        table tr:hover {
            background-color: #444;
        }

        .text-right {
            text-align: right;
            margin-top: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registered Users</h1>
        <a href="admin_dashboard.php">Back to Dashboard</a>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                require('db.php');

                if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
                    header('Location: login.php');
                    exit();
                }

                $user_query = $conn->query("SELECT user_id, username, email FROM users ORDER BY user_id ASC");
                while ($user = $user_query->fetch_assoc()) : ?>
                <tr>
                    <td><?= $user['user_id']; ?></td>
                    <td><?= htmlspecialchars($user['username']); ?></td>
                    <td><?= htmlspecialchars($user['email']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
