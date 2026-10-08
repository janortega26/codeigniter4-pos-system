<!DOCTYPE html>
<html>
<head>
    <title>New User</title>
</head>
<body>

<h2>New User</h2>

<?php if (isset($validation)): ?>
    <div style="color: red;">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<?= form_open('users/create') ?>

    <p>
        Username:<br>
        <input
            type="text"
            name="username"
            value="<?= esc(old('username')) ?>"
        >
    </p>

    <p>
        Full Name:<br>
        <input
            type="text"
            name="full_name"
            value="<?= esc(old('full_name')) ?>"
        >
    </p>

    <p>
        Password:<br>
        <input
            type="password"
            name="password"
        >
    </p>

    <p>
        Confirm Password:<br>
        <input
            type="password"
            name="password_confirm"
        >
    </p>

    <button type="submit">Save User</button>

<?= form_close() ?>

<br><br>

<?= anchor('users', 'Back to User Accounts') ?>

</body>
</html>