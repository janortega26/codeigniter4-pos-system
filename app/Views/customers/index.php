<!DOCTYPE html>
<html>
<head>
    <title>Customer Accounts</title>
</head>
<body>

<h2>Customer Accounts</h2>

<table border="1">
    <p>
        Logged in as:
        <strong><?= esc(session()->get('fullName')) ?></strong>
    </p>

    <p>
        <?= anchor('customers', 'Customer Accounts') ?>
        |
        <?= anchor('users', 'User Accounts') ?>
        |
        <?= anchor('logout', 'Logout') ?>
    </p>

    <hr>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>

    <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?= esc($customer['id']) ?></td>
            <td><?= esc($customer['full_name']) ?></td>
            <td><?= esc($customer['email']) ?></td>
            <td><?= esc($customer['phone']) ?></td>
            <td>
                <?= anchor(
                    'customers/edit/' . $customer['id'],
                    'Edit'
                ) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br><br>

<?= anchor('customers/new', 'Add New Customer') ?>

</body>
</html>
