<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5 ; $i++) {

            $newProduct = new Product();
            $newProduct->name = 'hamburger';
            $newProduct->cover = 'products/image-1.jpg';
            $newProduct->description = 'hamburger formaggio e ketchup';
            $newProduct->price = rand(1, 500);
            $newProduct->manufacturer = '';
            $newProduct->subtotal = rand(1, 500);
            $newProduct->quantity = rand(1, 10);
            $newProduct->slug = '';
            $newProduct->save();
        }

    }
}
