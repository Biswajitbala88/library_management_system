<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->get();
        return view('book.list', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        // dd($category);
        return view('book.edit', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $book = $request->validate([
        //     'name' => 'required',
        //     'category' => 'required',
        //     'price' => 'required',
        //     'qty' => 'required',
        //     'description' => 'required',
        //     'attachment' => 'required',
        // ]);
        // Book::create($book);
        $book = Book::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'image1' => $request->attachment,
            'image2' => $request->attachment,
        ]);
        if($request->file('attachment')){
            $this->storeAttachment($request, $book);
        }
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }


    protected function storeAttachment($request, $book)
    {
        // dd($book);
        $extension = $request->file('attachment')->extension();
        $contents = file_get_contents($request->file('attachment'));
        $filename = $book->name;
        $noSpacesString = str_replace(' ', '_', $filename);
        $currentDateTime = date("Y-m-d_H:i:s");
        $filenameWithDateTime = $currentDateTime . '_' . $noSpacesString;
        $path = "images/$filenameWithDateTime.$extension";

        Storage::disk('public')->put($path, $contents);
        $book->update(['image' => $path]);
    }

}
