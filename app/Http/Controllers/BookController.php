<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        // Validate passed parameters
        $validated = $request->validate([
            'title' => "required|string|max:255",
            'publisher' => "required|string|max:255",
            'pages' => "required|integer|min:1",
            'author_id' => "required|integer|min:0"
        ]);

        // Create book when validation is successful
        $book = Book::create([
            'title' => $validated['title'],
            'publisher' => $validated['publisher'],
            'pages' => $validated['pages'],
            'author_id' => $validated['author_id']
        ]);

        return Response([
            "message" => "Book created.",
            "book" => $book
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @param int $number - number of records to return (0 - all)
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, int $number): Response
    {
        if ($number == 0)
            $books = $book->all();
        else
            $books = $book->all()->take($number);

        return Response($books, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, $id): Response
    {
        // Validate passed parameters
        $val = $request->validate([
            'title' => "string|max:255",
            'publisher' => "string|max:255",
            'pages' => "integer|min:1",
            'author_id' => "integer|min:0"
        ]);

        $b = $book->find($id);

        // Update the column if a new value has been passed in
        array_key_exists('title', $val) && $b->title = $val['title'];
        array_key_exists('publisher', $val) && $b->publisher = $val['publisher'];
        array_key_exists('pages', $val) && $b->pages = $val['pages'];
        array_key_exists('author_id', $val) && $b->author_id = $val['author_id'];

        $b->save();

        return Response([
            "message" => "Book updated successfully."
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): Response
    {
        // Delete book from database
        Book::destroy($id);

        return Response([
            "message" => "Successfully deleted book.",
        ], 200);
    }
}
