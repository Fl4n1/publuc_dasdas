<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('cart.index', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Товар добавлен в корзину!');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Корзина успешно обновлена!');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Товар удалён из корзины!');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'Все предметы удалены из корзины!');

        return redirect()->route('cart.list');
    }

    public function saveOrder(Request $request)
    {
        // проверяем данные формы оформления
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        // валидация пройдена, сохраняем заказ
        $basket = \Cart::getContent();
        $user_id = auth()->check() ? auth()->user()->id : null;
        $amount = \Cart::getTotal();
        $order = Order::create(
            $request->all() + ['amount' => $amount, 'user_id' => $user_id]
        );

        foreach ($basket as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'cost' => $product->price * $product->quantity,
            ]);
        }

        // уничтожаем корзину
        \Cart::clear();

        return to_route('cart.list')
            ->with('message', 'Ваш заказ успешно размещен');
    }

    public function checkout()
    {
        return view('cart.checkout');
    }

    /**
     * Сообщение об успешном оформлении заказа
     */
    public function success(Request $request)
    {
        if ($request->session()->exists('order_id')) {
            // сюда покупатель попадает сразу после успешного оформления заказа
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);
            return view('cart.success', compact('order'));
        } else {
            // если покупатель попал сюда случайно, не после оформления заказа,
            // ему здесь делать нечего — отправляем на страницу корзины
            return redirect()->route('cart.list');
        }
    }
}
