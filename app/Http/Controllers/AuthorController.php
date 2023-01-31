<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
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
            'name' => "required|string|max:255",
            'country' => "required|string|max:255",
        ]);

        // Create author when validation is successful
        $author = Author::create([
            'name' => $validated['name'],
            'country' => $validated['country'],
        ]);

        return Response([
            "message" => "Author created.",
            "author" => $author
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author, string $name): Response
    {
        // Checks that the name is the required minimum length
        if (strlen($name) < 3) {
            return Response([
                "message" => "This action accepts 3 or more characters."
            ], 400);
        }

        // Find authors in whose name the given text is found
        $authors = $author->where('name', 'like', '%' . $name . '%')
            ->take(5)->get();

        return Response([$authors], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): Response
    {
        // Delete author from the database
        Author::destroy($id);

        return Response([
            "message" => "Author deleted successfully.",
        ], 200);
    }
}
