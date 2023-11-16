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

        foreach ($books as $book) {
            $categoryName = $book->category->name;
            // Do something with $categoryName, like echoing or storing it
        }
        \Log::debug($books); // Check the Laravel log for the output
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
        $book = new Book;
        $book->name = $request->name;
        $book->category_id = $request->category;
        $book->price = $request->price;
        $book->qty = $request->qty;
        $book->description = $request->description;
        $book->image1 = $request->attachment;
        $book->image2 = $request->attachment;
        
        if ($request->hasFile('attachment')) {
            $imagePath1 = $this->storeAttachment($request, $book);
            $book->image1 = $imagePath1;
        }
        
        if ($request->hasFile('attachment')) {
            $imagePath2 = $this->storeAttachment($request, $book);
            $book->image2 = $imagePath2;
        }

        $book->save();

        return redirect()->route('book.index');
    }

    protected function storeAttachment($request, $book)
    {
        $extension = $request->file('attachment')->extension();
        // dd($extension);
        $contents = file_get_contents($request->file('attachment'));
        $filename = $book->name;
        $noSpacesString = str_replace(' ', '_', $filename);
        $currentDateTime = date("Y-m-d_H:i:s");
        $filenameWithDateTime = $currentDateTime . '_' . $noSpacesString;
        $path = "images/$filenameWithDateTime.$extension";
        // dd($path);
        Storage::disk('public')->put($path, $contents);
        // $book->update(['image' => $path]);
        return $path;
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
        $category = Category::all();
        $book = Book::find($book->id);

        // dd($book);
        return view('book.update')->with('category', $category)->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $book = Book::find($book->id);
        // dd($request->attachment);
        $book->name = $request->name;
        $book->category_id = $request->category;
        $book->price = $request->price;
        $book->qty = $request->qty;
        $book->description = $request->description;
        if($request->attachment){
            $book->image1 = $request->attachment;
            $book->image2 = $request->attachment;
        }else{
            $book->image1 = $book->image1;
            $book->image2 = $book->image2;
        }
        
        
        if ($request->hasFile('attachment')) {
            $imagePath1 = $this->storeAttachment($request, $book);
            $book->image1 = $imagePath1;
        }
        
        if ($request->hasFile('attachment')) {
            $imagePath2 = $this->storeAttachment($request, $book);
            $book->image2 = $imagePath2;
        }

        $book->save();

        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book = Book::find($book->id);
        $book->delete();
        return redirect()->route('book.index');
    }






}
