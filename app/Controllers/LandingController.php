<?php
namespace App\Controllers;
use App\Models\ProductModel;

class LandingController extends BaseController
{
    public function index()
    {
        $produk = (new ProductModel())
            ->orderBy('RAND()')
            ->findAll(8);
        return view('landingpage', ['produk' => $produk]);
    }
}