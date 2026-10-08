<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
</head>
<body>

<h2>User Accounts</h2>

<table border="1">
    <tr>
        <th>Avatar</th>
        <th>ID</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Action</th>
    </tr>

    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <?php
                if (!empty($user['avatar'])) {
                    $avatarUrl = base_url(
                        'uploads/' . $user['avatar']
                    );
                } else {
                    $avatarUrl = base_url(
                        'images/placeholder.png'
                    );
                }

                printf(
                    '<img src="%s" alt="User Avatar" width="80" height="80" style="object-fit: cover;">',
                    esc($avatarUrl)
                );
                ?>
            </td>

            <td><?= esc($user['id']) ?></td>
            <td><?= esc($user['username']) ?></td>
            <td><?= esc($user['full_name']) ?></td>

            <td>
                <?= anchor(
                    'users/edit/' . $user['id'],
                    'Edit'
                ) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br><br>

<?= anchor('users/new', 'Add New User') ?>

</body>
</html>