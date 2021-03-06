<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url (); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url (); ?>assets/css/style.css">

    <title>Admin | Category</title>
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
            <h2>Categories</h2>
        </div>
    </div>
    <form action="<?php echo base_url ('admin'); ?>" method="post">
    <div class="row category-form">
        <div class="col-md-4">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="col-md-4">
            <label for="parent">Parent Category</label>
            <select name="parent" id="parent" class="form-control">
                <option value="">No Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo $category ['breadcrumb']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label>&nbsp;</label>
            <input type="submit" class="btn btn-block btn-primary" value="Add Category">
        </div>
    </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            <?php if ($cat_err_msg): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $cat_err_msg; ?>
                </div>
            <?php endif; ?>

            <?php if ($cat_msg): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $cat_msg; ?>
                </div>
            <?php endif; ?>


            <ul class="tree">
                <?php
                    // =======================
                    // PreOrder Tree Traversal +
                    // =======================

                    $roots = getChildren($categories);
                    $elements = $roots;
                    $stack = [];
                    $done = false;
                    while (!$done)
                    {
                        // take a leaf from the element
                        $leaf = array_shift ($elements);

                        if (empty ($leaf))
                        {
                            // end the current list
                            echo '</ul>';
                            // pop elements from the stack
                            $elements = array_pop ($stack);
                            if (!$elements && empty ($stack))
                            {
                                // elements and stack are empty
                                $done = true;
                                break;
                            } else {
                                // else just skip this loop step
                                continue;
                            }
                        }

                        // print the leaf first
                        echo '<li>' . $leaf ['name'] .
                             '<div class="edit-category-holder"><a href="#" class="edit-category">Edit</a>
                              <form action="' . base_url ('admin') . '" method="post" class="edit-category-form">
                              <input type="hidden" value="' . $leaf ['id'] . '" name="id">
                              <input type="text" value="' . $leaf ['name'] . '" name="name">
                              <select name="parent">
                              <option value="">No Category</option>';
                        foreach ($categories as $category)
                        {
                            echo '<option value="' . $category['id'] . '"';
                            if ($category ['id'] == $leaf ['parent'])
                            {
                                echo 'selected="selected"';
                            }
                            echo '>' . $category['breadcrumb'] . '</option>';
                        }
                        echo '</select><input type="submit" value="Edit"></form>
                        </div><a href="' . base_url ('/admin/delete_category/' . $leaf ['id']) . '">Delete</a></li>';

                        // get the next sub tree
                        $nextTree = getChildren($categories, $leaf ['id']);
                        if (!empty ($nextTree))
                        {
                            // store to the stack
                            $stack [] = $elements;
                            $elements = $nextTree;
                            // start new sub list
                            echo '<ul>';
                        }

                    }
                ?>
            </ul>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="<?php echo base_url (); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url (); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url (); ?>assets/js/category.js"></script>
</body>
</html>