<!DOCTYPE html>
<html>
<head>
    <title>New Customer</title>
</head>
<body>

<h2>New Customer</h2>

<?php if(isset($validation)): ?>
    <?= $validation->listErrors(); ?>
<?php endif; ?>

<form action="<?= site_url('customers/create') ?>"method="post">

    <p>
        Full Name:<br>
        <input type="text" name="full_name">
    </p>

    <p>
        Email:<br>
        <input type="email" name="email">
    </p>

    <p>
        Phone:<br>
        <input type="text" name="phone">
    </p>

    <button type="submit">Save Customer</button>

</form>

</body>
</html>