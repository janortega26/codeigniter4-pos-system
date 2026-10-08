<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>

<h2>Edit Customer</h2>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<?= form_open('customers/update/' . $customer['id']) ?>

    <p>
        Full Name:<br>
        <input
            type="text"
            name="full_name"
            value="<?= esc($customer['full_name']) ?>"
        >
    </p>

    <p>
        Email:<br>
        <input
            type="email"
            name="email"
            value="<?= esc($customer['email']) ?>"
        >
    </p>

    <p>
        Phone:<br>
        <input
            type="text"
            name="phone"
            value="<?= esc($customer['phone']) ?>"
        >
    </p>

    <button type="submit">Update Customer</button>

<?= form_close() ?>

<br>

<?= anchor('customers', 'Back to Customer Accounts') ?>

</body>
</html>