<?php

namespace Database\Seeders;

use App\Models\Patron;
use Illuminate\Database\Seeder;

class PatronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patron = new Patron();
        $patron->full_name = 'John Doe';
        $patron->date_of_birth = '1993-12-12';
        $patron->phone_number = '065/555-555';
        $patron->expected_renew_date = '2021-01-25';
        $patron->subscription_type_id = 1;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'Jane Doe';
        $patron->date_of_birth = '2005-12-12';
        $patron->phone_number = '065/444-555';
        $patron->expected_renew_date = '2021-01-15';
        $patron->subscription_type_id = 2;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'Peter Parker';
        $patron->date_of_birth = '1989-04-12';
        $patron->phone_number = '065/444-54657';
        $patron->expected_renew_date = '2022-01-01';
        $patron->subscription_type_id = 1;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'Mary Jane Watson';
        $patron->date_of_birth = '1989-08-11';
        $patron->phone_number = '065/43244-54657';
        $patron->expected_renew_date = '2021-05-05';
        $patron->subscription_type_id = 3;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'Harry Ozborn';
        $patron->date_of_birth = '1989-07-12';
        $patron->phone_number = '065/4141-5111';
        $patron->expected_renew_date = '2021-08-08';
        $patron->subscription_type_id = 3;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'Otto Octavius';
        $patron->date_of_birth = '1969-04-11';
        $patron->phone_number = '063/3333-333';
        $patron->expected_renew_date = '2021-09-02';
        $patron->subscription_type_id = 3;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'May Parker';
        $patron->date_of_birth = '1958-02-11';
        $patron->phone_number = '063/3465-474';
        $patron->expected_renew_date = '2022-01-01';
        $patron->subscription_type_id = 1;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'Ben Parker';
        $patron->date_of_birth = '1956-03-11';
        $patron->phone_number = '063/2684-474';
        $patron->expected_renew_date = '2022-01-01';
        $patron->subscription_type_id = 1;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'Gwen Stacy';
        $patron->date_of_birth = '1990-03-11';
        $patron->phone_number = '063/424-9900';
        $patron->expected_renew_date = '2021-10-01';
        $patron->subscription_type_id = 3;

        $patron->save();

        $patron = new Patron();
        $patron->full_name = 'Eddie Brock';
        $patron->date_of_birth = '1982-02-09';
        $patron->phone_number = '063/3656-546';
        $patron->expected_renew_date = '2021-04-01';
        $patron->subscription_type_id = 1;

        $patron->save();
    }
}
