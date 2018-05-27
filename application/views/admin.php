<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url (); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url (); ?>assets/css/style.css">

    <title>Admin</title>
</head>
<body>

<nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <span class="py-2 d-md-inline-block">Admin</span>
        <a class="py-2 d-md-inline-block" href="<?php echo site_url ('admin'); ?>">Categories</a>
        <a class="py-2 d-md-inline-block" href="<?php echo site_url ('admin/pages'); ?>">Pages / Data</a>
        <a class="py-2 d-md-inline-block" href="<?php echo site_url ('login/logout') ?>">Logout</a>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            &nbsp;
        </div>
    </div>
    <form action="<?php echo base_url ('admin'); ?>" method="post">
    <div class="row category-form">
        <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="col-md-4">
            <select name="parent" id="" class="form-control">
                <option value="">No Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <input type="submit" class="btn btn-block btn-primary" value="Add Category">
        </div>
    </div>
    </form>

</div>

<!-- Optional JavaScript -->
<script src="<?php echo base_url (); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url (); ?>assets/js/bootstrap.min.js"></script>
</body>
</html>