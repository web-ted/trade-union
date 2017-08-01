<?php

namespace App\Http\Controllers;

use App\Enterprise;
use App\Specialty;
use App\Worker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class WorkerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// return Worker::all();
		return Worker::with(['specialty', 'enterprise'])->get();
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
		try {
			$worker = new Worker();
			$workerAttributes = [
				'active'              => $request->get('active'),
				'registration_number' => $request->get('registration_number'),
				'registered_at'       => $request->get('registered_at'),
				'first_name'          => $request->get('first_name'),
				'last_name'           => $request->get('last_name'),
				'father_name'         => $request->get('father_name'),
				'birth_date'          => $request->get('birth_date'),
				'id_card'             => $request->get('id_card'),
				'phone'               => $request->get('phone'),
				'mobile_phone'        => $request->get('mobile_phone'),
				'email'               => $request->get('email'),
				'address'             => $request->get('address'),
				'postal_code'         => $request->get('postal_code'),
				'region'              => $request->get('region'),
				'city'                => $request->get('city'),
				'hire_date'           => $request->get('hire_date'),
				'insurance_number'    => $request->get('insurance_number'),
				'comment'             => $request->get('comment'),
				'enterprise_id'       => $request->get('enterprise_id'),
				'specialty_id'        => $request->get('specialty_id'),
			];

			foreach ($workerAttributes as $attrName => $attrVal) {
				$worker->$attrName = $attrVal;
			}

			if (!$worker->save()) {
				throw new \Exception("Cannot save worker: " . implode(',', $worker->errors()->all()));
			}

			$jsonResponse = [
				'response' => $worker,
				'response' => [
					'status'  => 'Success',
					'message' => "Worker " . $worker->first_name . " " . $worker->last_name . " was created successfully",
					'worker'  => $worker
				],
				'status'   => 200
			];

		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Error',
					'message' => "Cannot save worker: " . $e->getMessage()
				],
				'status'   => 400
			];
		}

		return response()->json($jsonResponse['response'], $jsonResponse['status']);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		try {
			$worker = Worker::findOrFail($id);
			$jsonResponse = [
				'response' => $worker,
				'response' => [
					'status'  => 'success',
					'message' => "Worker was found successfully",
					'worker'  => $worker
				],
				'status'   => 200
			];
		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'  => 'error',
					'message' => "Worker with id: $id was not found",
					'worker'  => false
				],
				'status'   => 404
			];
		}

		return response()->json($jsonResponse['response'], $jsonResponse['status']);
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
		try {
			$workerAttributes = [
				'active'              => $request->get('active'),
				'registration_number' => $request->get('registration_number'),
				'registered_at'       => $request->get('registered_at'),
				'first_name'          => $request->get('first_name'),
				'last_name'           => $request->get('last_name'),
				'father_name'         => $request->get('father_name'),
				'birth_date'          => $request->get('birth_date'),
				'id_card'             => $request->get('id_card'),
				'phone'               => $request->get('phone'),
				'mobile_phone'        => $request->get('mobile_phone'),
				'email'               => $request->get('email'),
				'address'             => $request->get('address'),
				'postal_code'         => $request->get('postal_code'),
				'region'              => $request->get('region'),
				'city'                => $request->get('city'),
				'hire_date'           => $request->get('hire_date'),
				'insurance_number'    => $request->get('insurance_number'),
				'comment'             => $request->get('comment'),
				'enterprise_id'       => $request->get('enterprise_id'),
				'specialty_id'        => $request->get('specialty_id'),
			];

			$worker = Worker::findOrFail($id);

			foreach ($workerAttributes as $attrName => $attrVal) {
				$worker->$attrName = $attrVal;
			}

			if (!$worker->save()) {
				throw new \Exception("Cannot update worker: " . implode(',', $worker->errors()->all()));
			}

			$jsonResponse = [
				'response' => [
					'status'  => 'Success',
					'message' => "Worker " . $worker->first_name . " " . $worker->last_name . " was updated successfully",
					'worker'  => $worker
				],
				'status'   => 200
			];

		} catch (ModelNotFoundException $n) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Member Not Found',
					'message' => "Cannot update worker with id: " . $id . ". He was not found."
				],
				'status'   => 404
			];
		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'  => 'error',
					'message' => "Cannot update worker: " . $e->getMessage()
				],
				'status'   => 400
			];
		}

		return response()->json($jsonResponse['response'], $jsonResponse['status']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		try {
			$worker = Worker::findOrFail($id);
			$worker->delete();

			$jsonResponse = [
				'response' => [
					'status'  => 'Success',
					'message' => "Worker: " . $worker->first_name . " " . $worker->last_name . " was deleted successfully",
					'worker'  => $worker
				],
				'status'   => 200
			];
		} catch (ModelNotFoundException $n) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Member Not Found',
					'message' => "Cannot find worker with id: " . $id
				],
				'status'   => 404
			];
		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Error',
					'message' => $e->getMessage()
				],
				'status'   => 500
			];
		}

		return response()->json($jsonResponse['response'], $jsonResponse['status']);
	}

	public function nextRegistrationNumber()
	{
		$maxRegNumber = DB::table('workers')->max('registration_number');
		return response()->json(['maxRegistrationNumber' => $maxRegNumber]);
	}

	public function export()
	{
		Excel::create('Members List', function ($excel) {
			$excel->sheet('Workers', function ($sheet) {
				$sheet->setOrientation('landscape');
				$sheet->freezeFirstRow();
				$sheet->loadView('excel.workers', ['members' => Worker::all()]);
			});
		})->download('xlsx');
	}
}
