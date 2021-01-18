<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use App\Models\Patron;
use App\Http\Resources\Patron as PatronResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatronController extends BaseController
{
    public function index()
    {
        $patrons = Patron::all();

        return $this->sendResponse(PatronResource::collection($patrons), 'Patrons retrieved successfully!');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'full_name' => 'required',
            'phone_number' => 'required',
            'date_of_birth' => 'required',
            'expected_renew_date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors());
        }

        $patron = Patron::create($input);
        return $this->sendResponse(new PatronResource($patron), 'Patron successfully created');
    }

    public function show($id)
    {
        $patron = Patron::find($id);
        if (is_null($patron)) {
            return  $this->sendError('Patron not found!');
        }
        return $this->sendResponse(new PatronResource($patron), 'Patron successfully retrieved');
    }

    public function update(Request $request, Patron $patron)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'full_name' => 'required',
            'phone_number' => 'required',
            'date_of_birth' => 'required',
            'expected_renew_date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors());
        }

        $patron->full_name = $input['full_name'];
        $patron->phone_number = $input['phone_number'];
        $patron->date_of_birth = $input['date_of_birth'];
        $patron->expected_renew_date = $input['expected_renew_date'];
        $patron->save();

        return $this->sendResponse(new PatronResource($patron), 'Patron successfully updated');
    }

    public function destroy(Patron $patron)
    {
        $patron->delete();

        return $this->sendResponse([], 'Patron successfully deleted');
    }
}
