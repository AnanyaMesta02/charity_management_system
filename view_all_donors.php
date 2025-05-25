<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "db.php";

$query = "
    SELECT users.name, users.email, donors.amount, donors.donation_date, donors.status 
    FROM donors 
    JOIN users ON donors.user_id = users.id
    ORDER BY donors.donation_date DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Donors</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>All Donors List</h2>

<?php if (mysqli_num_rows($result) > 0): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Amount Donated</th>
            <th>Donation Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>₹<?= htmlspecialchars($row['amount']) ?></td>
                <td><?= htmlspecialchars($row['donation_date']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                

            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">No donor records found.</p>
<?php endif; ?>

</body>
</html>
