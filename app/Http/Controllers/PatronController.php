<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Patron;
use App\Models\SubscriptionType;
use App\Http\Requests;
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
            $books = array();
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
            $book = $bookPatron->book()->get()->first();
            $book->book_patron_id = $bookPatron->id;
            $book->book_code = $bookPatron->book_code;
            $books[] = $book;
            $patron->books = $books;
        }

        $allBooks = Book::all()->where('no_of_issues', '>', '0');
        $subTypes = SubscriptionType::all();

        return view('patrons.edit', [
            'patron' => $patron,
            'allBooks' => $allBooks,
            'subTypes' => $subTypes
            ]);
    }

    public function update(Request $request, Patron $patron)
    {
        $input = $request->all();

        $patron->full_name = $input['full_name'];
        $patron->phone_number = $input['phone_number'];
        $patron->date_of_birth = date('Y-m-d', strtotime($input['date_of_birth']));
        $patron->expected_renew_date = date('Y-m-d', strtotime($input['expected_renew_date']));
        $patron->subscription_type_id = $input['subscription_type_id'];
        $patron->save();

        return redirect(route('patrons.edit', $patron->id));
    }

    public function destroy(Patron $patron)
    {
        if (count($patron->bookPatrons()->get()->toArray()) > 0) {
            request()->session()->flash('status', __('This patron still holds books!'));
            return redirect(route('patrons.edit', $patron->id));
        }
        $patron->delete();

        return redirect(route('patrons.show'));
    }

    public function pay(Patron $patron)
    {
        if ($patron->expected_renew_date > now()) {
            $patron->expected_renew_date = date("Y-m-d", strtotime('+1 year', strtotime(now())));
            
        } else {
            $patron->expected_renew_date = date("Y-m-d", strtotime('+1 year', strtotime($patron->expected_renew_date)));
        }
        
        $patron->save();

        return redirect(route('patrons.edit', $patron->id));
    }
}
