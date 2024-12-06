<?php
require 'model/Product.php';

class ProductController
{

    public function show()
    {
        $newProduct = new Product();
        $products = $newProduct->all();

        require 'views/products/show.view.php';
    }
}

