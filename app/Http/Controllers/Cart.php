<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

// class Cart extends Controller
// {
// }

//1
class Cart extends Controller {
    private $items;
    private $total;



    public function __construct() {
        $this->items = [];
        $this->total = 0.00;
    }

    public function index() {
        return view('cart');
    }
//2
    public function emptyCart() {
        $this->items = [];
        $this->total = 0.00;
    }
//3
    public function setItems($items) {
        $this->items = $items;
    }

    public function getItems() {
        $items = [];
        if($this->hasItems()) {
            foreach($this->items as $item) {
                $items[] = [
                        'id' => $item['id'],
                         'name' => $item['name'],
                         'description' => $item['description'],
                         'price' => $item['price'],
                         'manufacturer' => $item['manufacturer'],
                         'cover' => $item['cover'],
                         'quantity' => $item['quantity'],
                         'subtotal' => $item['subtotal'],
                         'slug' => $item['slug']
                ];
            }
        }
        return $items;
}
//4
    public function setTotal($value) {
            $this->total = $value;
    }

    public function getTotal() {
            return $this->total;
    }

//5
    public function updateCart(Product $product, $quantity) {
            if($this->hasItems()) {
                foreach($this->items as &$item)  {
                    if($product->id == $item['id']) {
                        $item['quantity'] = $quantity;
                        $item['subtotal'] = ($product->price * $quantity);
                        $this->calculateTotal();
                    }
                }
            }
        }
//6
    public function removeFromCart(Product $product) {
        if($this->hasItems()) {
            $i = -1;
            foreach($this->items as $item) {
                $i++;
                if($product->id == $item['id']) {
                    unset($this->items[$i]);
                    $this->calculateTotal();
                }
            }
        }
    }

//7

    public function addToCart(Product $product, $quantity) {
            if($quantity < 1 || $this->isInCart($product)) {
                return;
            }
            $item = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'manufacturer' => $product->manufacturer,
                'cover' => $product->cover,
                'quantity' => $quantity,
                'subtotal' => ($product->price * $quantity),
                'slug' => $product->slug
            ];
            $this->items[] = $item;
            $this->calculateTotal();
        }

//8
    private function isInCart(Product $product) {
            if( $this->hasItems()) {
               foreach( $this->items as $item ) {
                   if($item['id'] == $product->id) {
                       return true;
                   }
               }
               return false;
            } else {
                return false;
            }
        }
//10

    private function calculateTotal() {
            $this->total = 0.00;
            if($this->hasItems()) {
                $tot = 0.00;
                foreach($this->items as $item) {
                    $tot += $item['subtotal'];
                }
                $this->total = $tot;
            }
        }

//11
    private function hasItems() {
        return ( count( $this->items ) > 0 );
    }
//12
    public function add(Request $request, $id)
        {
            $product_id = $request->id;
            $quantity = 1;
            if ($request->has(['id', 'quantity'])) {
                $product_id = $request->input('id');
                $quantity = (int) $request->input('quantity');
            }

            // dd($request->id);
            $product = Product::find($product_id);
            if(is_null($product)) {
                return redirect()->route('casa');
            }

            $cart = new Cart();
            $sessionCart = $request->session()->get('cart');
            // dd($sessionCart);

            if(!$sessionCart) {
                $cart->addToCart($product, $quantity);
                $request->session()->put(['cart' => ['items' => $cart->getItems(), 'total' => $cart->getTotal()]]);
            } else {
                $cart->setItems($sessionCart['items']);
                $cart->setTotal($sessionCart['total']);
                $cart->addToCart($product, $quantity);
                $request->session()->put(['cart' => ['items' => $cart->getItems(), 'total' => $cart->getTotal()]]);
            }
            // dd($cart);
            return redirect()->route('cart.index');
        }




        public function cartRemove(Request $request)
    {
        $id = (int) $request->input('id');
        $product = Product::find($id);
        $cart = new Cart();
        $sessionCart = $request->session()->get('cart');
        $cart->setItems($sessionCart['items']);
        $cart->setTotal($sessionCart['total']);
        $cart->removeFromCart($product);
        $request->session()->put(['cart' => ['items' => $cart->getItems(), 'total' => $cart->getTotal()]]);
        return redirect()->route('cart.index');
    }




    public function cartUpdate(Request $request)
    {
        $qty = $request->input('qty');
        $parts = explode(',', $qty);
        $cart = new Cart();
        $sessionCart = $request->session()->get('cart');
        $cart->setItems($sessionCart['items']);
        $cart->setTotal($sessionCart['total']);
        foreach($parts as $part) {
            $qtys = explode('-', $part);
            $id = (int) $qtys[0];
            $quantity = (int) $qtys[1];
            $product = Product::find($id);
            $cart->updateCart($product, $quantity);
        }
        $request->session()->put(['cart' => ['items' => $cart->getItems(), 'total' => $cart->getTotal()]]);
        return redirect()->route('cart.index');
    }




}

























/**/
