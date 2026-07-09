<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\DiscountModel;

class Home extends BaseController
{
    protected $productModel;
    protected $discountModel;

    function __construct(){
        helper(['number', 'form']);
        $this->productModel = new ProductModel();
        $this->discountModel = new DiscountModel();
    }

    public function index(): string
    {
        $products = $this->productModel->findAll();
        $data['products'] = $products;
        $data['discount'] = $this->discountModel->where('tanggal', date('Y-m-d'))->first();

        return view('v_home', $data);
    }

    public function faq(): string
    {
        return view('v_faq');
    }
}
