<?php

namespace Book\Http\Controllers\Admin;

use Book\Http\Controllers\Controller;
use Book\Image;
use Book\Product;
use Illuminate\Http\Request;
use Book\Http\Requests\ProductRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.images.index', ['images' => Image::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::pluck('name', 'id');
        return view('admin.images.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        /*dd($request->all());*/

        $image = new Image;

        $path_image          = $request->path;
        $path_image_new_name = time() . $path_image->getClientOriginalName();
        $path_image->move('storage/', $path_image_new_name);

        $image->name       = $request->name;
        $image->path       = 'storage/' . $path_image_new_name;
        $image->product_id = $request->product_id;

        $image->save();

        return redirect()->route('admin.image.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.images.edit', ['image' => Image::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $image = Image::find($id);

        $path_image          = $request->path;
        $path_image_new_name = time() . $path_image->getClientOriginalName();
        $path_image->move('public/storage\\', $path_image_new_name);

        $image->name       = $request->name;
        $image->path       = 'public/storage\\' . $path_image_new_name;
        $image->product_id = $request->product_id;

        $image->save();

        return redirect()->route('admin.image.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);

        if (file_exists($image->path)) {
            unlink($image->path);
        }
        $image->delete();
        return redirect()->back();
    }
}