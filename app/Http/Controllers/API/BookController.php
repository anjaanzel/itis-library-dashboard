<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use App\Models\Book;
use App\Http\Resources\Book as BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends BaseController
{
    public function index()
    {
        $books = Book::all();

        return $this->sendResponse(BookResource::collection($books), 'Books retrieved successfully!');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'author' => 'required',
            'no_of_issues' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors());
        }

        $book = Book::create($input);
        return $this->sendResponse(new BookResource($book), 'Book successfully created');
    }

    public function show($id)
    {
        $book = Book::find($id);
        if (is_null($book)) {
            return  $this->sendError('Book not found!');
        }
        return $this->sendResponse(new BookResource($book), 'Book successfully retrieved');
    }

    public function update(Request $request, Book $book)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'author' => 'required',
            'no_of_issues' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors());
        }

        $book->title = $input['title'];
        $book->synopsis = $input['synopsis'];
        $book->author = $input['author'];
        $book->genre = $input['genre'];
        $book->logo_path = $input['logo_path'];
        $book->no_of_issues = $input['no_of_issues'];
        $book->save();

        return $this->sendResponse(new BookResource($book), 'Book successfully updated');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return $this->sendResponse([], 'Book successfully deleted');
    }
}
