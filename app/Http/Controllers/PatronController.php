<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Patron;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class PatronController extends Controller
{
    public function index()
    {
        $patrons = Patron::all();

        foreach ($patrons as $patron) {
            $patron->expected_renewal_date;

            $last_payment_date = date("Y-m-d", strtotime('-1 year', strtotime($patron->expected_renew_date)));

            $days_past = abs(strtotime(date('Y-m-d')) - strtotime($last_payment_date))/86400;

            $percentage = round($days_past/365*100);
            
            $patron->percentage = $percentage;

            $bookPatrons = $patron->bookPatrons()->get();
            foreach ($bookPatrons as $bookPatron) {
                $books[] = $bookPatron->book()->get()->first();
                $patron->books = $books;
            }
        }

        return view('patrons.show', ['patrons' => $patrons]);
    }

    public function edit($id)
    {
        $patron = Patron::find($id);
        $bookPatrons = $patron->bookPatrons()->get();
        foreach ($bookPatrons as $bookPatron) {
            $books[] = $bookPatron->book()->get()->first();
            $patron->books = $books;
        }

        $allBooks = Book::all();
        $subTypes = SubscriptionType::all();

        return view('patrons.edit', [
            'patron' => $patron,
            'allBooks' => $allBooks,
            'subTypes' => $subTypes
            ]);
    }

    public function lend(Request $request)
    {
        return true;
    }
}
