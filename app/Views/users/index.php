<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Full Name</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id']; ?></td>
        <td><?= $user['username']; ?></td>
        <td><?= $user['full_name']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>