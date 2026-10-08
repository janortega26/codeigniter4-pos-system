<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<?php
if (!empty($user['avatar'])) {
    $avatarUrl = base_url('uploads/' . $user['avatar']);
    $avatarLabel = 'Current Avatar:';
} else {
    $avatarUrl = base_url('images/placeholder.png');
    $avatarLabel = 'No avatar uploaded.';
}
?>

<p><?= esc($avatarLabel) ?></p>

<?php
printf(
    '<img src="%s" alt="User Avatar" width="150" height="150" style="object-fit: cover;">',
    esc($avatarUrl)
);
?>

<?= form_open_multipart('users/update/' . $user['id']) ?>

    <p>
        Username:<br>
        <input
            type="text"
            name="username"
            value="<?= esc(set_value('username', $user['username'])) ?>"
        >
    </p>

    <p>
        Full Name:<br>
        <input
            type="text"
            name="full_name"
            value="<?= esc(set_value('full_name', $user['full_name'])) ?>"
        >
    </p>

    <p>
        Profile Picture:<br>
        <input
            type="file"
            name="avatar"
            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
        >
    </p>

    <p>Allowed files: JPG or PNG, maximum size of 2 MB.</p>

    <button type="submit">Update User</button>

<?= form_close() ?>

<br><br>

<?= anchor('users', 'Back to User Accounts') ?>

</body>
</html>