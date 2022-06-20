<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-list', ['only' => ['admin']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Создаём конструктор запросов
        $builder = Product::latest()->orderBy('id', 'asc');

        // search Параметры, используемые для продуктов совпадения
        if ($search = $request->input('search', '')) {
            $like = '%' . $search . '%';
            // поиск по совпадениям: названию продукта, сведениям о продукте
            $builder->where(function ($query) use ($like) {
                $query->where('name', 'like', $like)
                    ->orWhere('description', 'like', $like);
            });
        }
        // Есть ли параметр заказа для отправки, если да, назначаем его переменной $order
        // order Параметр используется для управления правилами сортировки товаров.
        if ($order = $request->input('order', '')) {
            // заканчивается ли он на _asc или _desc
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // Если начало строки является одной из этих 3 строк, это допустимое значение сортировки.
                if (in_array($m[1], ['price', 'name'])) {
                    // Создайте параметр сортировки на основе входящего значения сортировки.
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }
        if ($request->input('price_from')) {
            $builder->where('price', '>=', $request->price_from);
        }

        if ($request->input('price_to')) {
            $builder->where('price', '<=', $request->price_to);
        }


        $products = $builder->paginate(15);
        $categories = \App\Models\Category::all();

        return view('products.index', [
            'products' => $products,
            'filters'  => [
                'order'  => $order,
            ],
            'categories' => $categories
        ]);
    }

    public function admin()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([]);

        $title = $request->input('title');
        $body = $request->input('body');
        $price = $request->input('price');
        $category = $request->input('category_id');

        //File upload
        $imagePath = 'storage/' . $request->file('image')->store('products', 'public');


        $product = new Product();
        $product->name = $title;
        $product->price = $price;
        $product->category_id = $category;
        $product->description = $body;
        $product->image = $imagePath;

        $product->save();
        return to_route('admin.products.index')
            ->with('success', 'Товар был успешно создан.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $category = $product->category;
        $relatedProducts = $category->products()->where('id', '!=', $product->id)->latest()->get();
        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        $title = $request->input('title');

        $body = $request->input('body');
        $price = $request->input('price');
        $category = $request->input('category_id');

        //File upload

        if (!isEmpty($request->file('image'))) {
            $imagePath = 'storage/' . $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->name = $title;
        $product->price = $price;
        $product->category_id = $category;
        $product->description = $body;


        $product->save();

        return to_route('admin.products.index')
            ->with('success', 'Товар был успешно изменён.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('admin.products.index')
            ->with('success', 'Товар был удалён');
    }
}
