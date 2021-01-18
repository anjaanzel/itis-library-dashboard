<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookPatron;
use App\Models\Patron;
use Illuminate\Http\Request;

class BookPatronController extends Controller
{
    public function store(Request $request)
    {
        BookPatron::create($request->all());
        $book = Book::find($request->book_id);
        $book->no_of_issues = $book->no_of_issues - 1;
        $book->save();

        return redirect(route('patrons.edit', $request->patron_id));
    }

    public function destroy($id)
    {
        $bookPatron = BookPatron::find($id);
        $patron = $bookPatron->patron()->get()->first();
        $bookPatron->delete();

        return redirect(route('patrons.edit', $patron->id));
    }

    public function destroyAllByPatronId($patron_id)
    {
        $patron = Patron::find($patron_id);
        $bookPatrons = $patron->bookPatrons()->get();
        foreach ($bookPatrons as $bookPatron) {
            $bookPatron->delete();
        }
        return redirect(route('patrons.edit', $patron_id));
    }
}
