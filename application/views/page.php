<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url (); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url (); ?>assets/css/style.css">

    <title>Admin | Page</title>
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
        <div class="col-md-12">
            <h2>Pages</h2>
        </div>
    </div>
    <form action="<?php echo base_url ('admin/pages'); ?>" method="post">
    <div class="row category-form">
        <div class="col-md-3">
            <input type="hidden" name="id" id="id" class="form-control">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Title" required>
        </div>
        <div class="col-md-3">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control" placeholder="Body"></textarea>
        </div>
        <div class="col-md-3">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['breadcrumb']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label>
            <input type="submit" class="btn btn-block btn-primary" id="submit" value="Add Page">
        </div>
    </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            <?php if ($page_err_msg): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $page_err_msg; ?>
                </div>
            <?php endif; ?>

            <?php if ($page_msg): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $page_msg; ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach ($pages as $page): ?>
                <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo htmlspecialchars ($page ['title']); ?></td>
                    <td><?php echo ellipsize (htmlspecialchars ($page ['body']), 200, 1, '...'); ?></td>
                    <td><?php echo $page ['breadcrumb']; ?></td>
                    <td>
                        <input class="id" type="hidden" value="<?php echo $page ['id']; ?>">
                        <input class="title" type="hidden" value="<?php echo $page ['title']; ?>">
                        <input class="body" type="hidden" value="<?php echo $page ['body']; ?>">
                        <input class="category" type="hidden" value="<?php echo $page ['category']; ?>">
                        <a href="#" class="page-edit-btn">Edit</a>
                        <a href="<?php echo base_url ('admin/delete_page/' . $page ['id']); ?>">Delete</a>
                    </td>
                </tr>
                <?php
                        $i++;
                    endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="<?php echo base_url (); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url (); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url (); ?>assets/js/page.js"></script>
</body>
</html>