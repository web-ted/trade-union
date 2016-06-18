<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Worker::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $worker = new Worker();
        $workerAttributes = [
            'active' => $request->get('active'),
            'registration_number' => $request->get('registration_number'),
            'registered_at' => $request->get('registered_at'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'father_name' => $request->get('father_name'),
            'birth_date' => $request->get('birth_date'),
            'id_card' => $request->get('id_card'),
            'phone' => $request->get('phone'),
            'mobile_phone' => $request->get('mobile_phone'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'postal_code' => $request->get('postal_code'),
            'region' => $request->get('region'),
            'city' => $request->get('city'),
            'hire_date' => $request->get('hire_date'),
            'insurance_number' => $request->get('insurance_number'),
            'comment' => $request->get('comment'),
            'enterprise_id' => $request->get('enterprise_id'),
            'specialty_id' => $request->get('specialty_id'),
        ];

        foreach ($workerAttributes as $attrName => $attrVal) {
            $worker->$attrName = $attrVal;
        }
        return $worker->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Worker::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Worker::where('id', $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Worker::where('id', $id)->delete();
    }

    public function nextRegistrationNumber()
    {
        $maxRegNumber = DB::table('workers')->max('registration_number');
        return response()->json(['maxRegistrationNumber' => $maxRegNumber]);
    }
}
