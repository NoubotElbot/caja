<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(Product::where('stock', '>', 0)->get());
        }
        $products = Product::paginate();
        return view('products.index', compact('products'))->with(['view' => 'productos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create')->with(['view' => 'productos']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point
            //dd();
            $path = '/products' . '/' . $fileName;
            Storage::put('/public' . $path, $img);
            $data['image'] = $path;
        }

        $product = Product::create($data);

        return redirect()->route('productos.show', $product)->with([
            'alert' => [
                "type" => "success",
                "message" => "Producto #$product->id creada con exito.",
                "icon" => "success"
            ],
            'view' => 'productos'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'))->with([
            'view' => 'productos'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'))->with([
            'view' => 'productos'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $product->image);
            $image      = $request->file('image');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point
            //dd();
            $path = '/products' . '/' . $fileName;
            Storage::put('/public' . $path, $img);
            $data['image'] = $path;
        }

        $product->update($data);

        return redirect()->route('productos.show', $product)->with([
            'alert' => [
                "type" => "success",
                "message" => "Producto #$product->id modificado con exito.",
                "icon" => "success"
            ],
            'view' => 'productos'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('productos.index')->with([
            'alert' => [
                "type" => "success",
                "message" => "Producto #$product->id eliminado con exito.",
                "icon" => "success"
            ],
            'view' => 'productos'
        ]);
    }
}
