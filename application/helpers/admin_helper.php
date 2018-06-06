<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');

if ( ! function_exists ('getChildren')) {
    /**
     * @name getChildren
     * @author Mazhar Ahmed
     *
     * returns the children of given category
     *
     * @param $id of category
     * @return array
     */
    function getChildren($categories, $id = false)
    {
        $items = [];
        foreach ($categories as $category) {
            if (!$id) {
                if (!$category ['parent']) {
                    $items [] = $category;
                }
            } else {
                if ($category ['parent'] == $id) {
                    $items [] = $category;
                }
            }
        }
        return $items;
    }
}
