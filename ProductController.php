<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Http Request
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $products = Product::latest()->paginate(10);

        //render view with products
        return view('products.index', compact('products'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'foto'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_lengkap'         => 'required|min:10',
            'alamat_lengkap'   => 'required|min:10',
            'tempat_lahir'   => 'required|min:10',
            'tanggal_lahir'   => 'required|min:10',
            'jenis_kelamin'         => 'required|min:10',
            'jabatan'         => 'required|min:10',
            'mulai_masuk_kerja'         => 'required|min:10',
            'job_desc'         => 'required|min:10',
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('public/products', $image->hashName());

        //create product
        Product::create([
            'foto'         => $image->hashName(),
            'nama_lengkap'  => $request->nama_lengkap,
            'alamat_lengkap'   => $request->alamat_lengkap,
            'tempat_lahir'         => $request->tempat_lahir,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'jabatan'         => $request->jabatan,
            'mulai_masuk_kerja'         => $request->mulai_masuk_kerja,
            'job_desc'         => $request->job_desc
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get product by ID
        $product = Product::findOrFail($id);

        //render view with product
        return view('products.show', compact('product'));
    }
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get product by ID
        $product = Product::findOrFail($id);

        //render view with product
        return view('products.edit', compact('product'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id):RedirectResponse
    {
        $request->validate([
            'foto'         => '|image|mimes:jpeg,jpg,png|max:2048',
            'nama_lengkap'         => 'required|min:10',
            'alamat_lengkap'   => 'required|min:10',
            'tempat_lahir'   => 'required|min:10',
            'tanggal_lahir'   => 'required|min:10',
            'jenis_kelamin'         => 'required|min:10',
            'jabatan'         => 'required|min:10',
            'mulai_masuk_kerja'         => 'required|min:10',
            'job_desc'         => 'required|min:10'
        ]);

        $product = Product::findorFail($id);

        if ($request->hasFile('foto')) {

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('public/products', $image->hashName());

            //delete old image
            Storage::delete('public/products/'.$product->image);

            //update product with new image
            $product->update([
            'foto'         => $image->hashName(),
            'nama_lengkap'  => $request->nama_lengkap,
            'alamat_lengkap'   => $request->alamat_lengkap,
            'tempat_lahir'         => $request->tempat_lahir,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'jabatan'         => $request->jabatan,
            'mulai_masuk_kerja'         => $request->mulai_masuk_kerja,
            'job_desc'         => $request->job_desc
            ]);

        } else {

            //update product without image
            $product->update([
                'nama_lengkap'  => $request->nama_lengkap,
                'alamat_lengkap'   => $request->alamat_lengkap,
                'tempat_lahir'         => $request->tempat_lahir,
                'tanggal_lahir'         => $request->tanggal_lahir,
                'jenis_kelamin'         => $request->jenis_kelamin,
                'jabatan'         => $request->jabatan,
                'mulai_masuk_kerja'         => $request->mulai_masuk_kerja,
                'job_desc'         => $request->job_desc
            ]);
        }

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $product = Product::findOrFail($id);

        //delete image
        Storage::delete('public/products/'. $product->foto);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}
