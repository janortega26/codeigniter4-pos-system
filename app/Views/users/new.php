<!DOCTYPE html>
<html>
<head>
    <title>New User</title>
</head>
<body>

<h2>New User</h2>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<?= form_open('users/create') ?>

    <p>
        Username:<br>
        <input
            type="text"
            name="username"
            value="<?= esc(set_value('username')) ?>"
        >
    </p>

    <p>
        Full Name:<br>
        <input
            type="text"
            name="full_name"
            value="<?= esc(set_value('full_name')) ?>"
        >
    </p>

    <button type="submit">Save User</button>

<?= form_close() ?>

<br>

<?= anchor('users', 'Back to User Accounts') ?>

</body>
</html>