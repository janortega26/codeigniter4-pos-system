<!DOCTYPE html>
<html>
<head>
    <title>POS Login</title>
</head>
<body>

<h2>POS Login</h2>

<?php if (session()->getFlashdata('loginError')): ?>
    <p style="color: red;">
        <?= esc(session()->getFlashdata('loginError')) ?>
    </p>
<?php endif; ?>

<?php if (session()->getFlashdata('message')): ?>
    <p style="color: green;">
        <?= esc(session()->getFlashdata('message')) ?>
    </p>
<?php endif; ?>

<?php if (isset($validation)): ?>
    <div style="color: red;">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<?= form_open('login') ?>

    <p>
        Username:<br>

        <input
            type="text"
            name="username"
            value="<?= esc(old('username')) ?>"
            autocomplete="username"
        >
    </p>

    <p>
        Password:<br>

        <input
            type="password"
            name="password"
            autocomplete="current-password"
        >
    </p>

    <button type="submit">Login</button>

<?= form_close() ?>

</body>
</html>