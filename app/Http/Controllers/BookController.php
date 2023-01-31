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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
