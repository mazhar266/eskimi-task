<?php

/**
 * @name buildBreadCrumb
 * @author Mazhar Ahmed
 *
 * returns the breadcrumb of a category
 *
 * @param $category
 * @return string
 */
function buildBreadCrumb ($categories, $category)
{
    // on empty return the name
    if (empty ($category ['parent']))
    {
        return $category ['name'];
    }

    // find the parent
    $parent = getCategory ($category ['parent']);
    // call the recursion
    return buildBreadCrumb ($parent) . ' > ' . $category ['name'];
}

/**
 * @name getCategory
 * @author Mazhar Ahmed
 *
 * returns the category
 *
 * @param $id of category
 * @return array
 */
function getCategory ($categories, $id)
{
    foreach ($categories as $category)
    {
        if ($category ['id'] == $id)
        {
            return $category;
        }
    }
}

/**
 * @name getChildren
 * @author Mazhar Ahmed
 *
 * returns the children of given category
 *
 * @param $id of category
 * @return array
 */
function getChildren ($categories, $id = false)
{
    $categories = [];
    foreach ($categories as $category)
    {
        if (!$id)
        {
            if (!$category ['parent'])
            {
                $categories [] = $category;
            }
        } else {
            if ($category ['parent'] == $id)
            {
                $categories [] = $category;
            }
        }
    }
    return $categories;
}
