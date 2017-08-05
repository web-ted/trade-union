<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Enterprise;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class EnterpriseController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Enterprise::all();
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
			$enterprise = new Enterprise();
			$enterpriseAttributes = [
				'name'              => $request->get('name'),
				'address'           => $request->get('address'),
				'region'            => $request->get('region'),
				'phone'             => $request->get('phone'),
				'fax'               => $request->get('fax'),
				'email'             => $request->get('email'),
				'city'              => $request->get('city'),
				'founded'           => $request->get('founded'),
				'workers_number'    => $request->get('workers_number'),
				'owners'            => $request->get('owners'),
				'business_activity' => $request->get('business_activity'),
			];

			foreach ($enterpriseAttributes as $attrName => $attrVal) {
				$enterprise->$attrName = $attrVal;
			}

			if (!$enterprise->save()) {
				throw new \Exception("Cannot save enterprise: " . implode(',', $enterprise->errors()->all()));
			}

			$jsonResponse = [
				'response' => $enterprise,
				'response' => [
					'status'  => 'success',
					'message' => "Enterprise was created successfully",
					'worker'  => $enterprise
				],
				'status'   => 200
			];

		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'  => 'error',
					'message' => "Cannot save enterprise: " . $e->getMessage()
				],
				'status'   => 400
			];
		}

		return response()->json($jsonResponse['response'], $jsonResponse['status']);

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
			$enterpriseAttributes = [
				'name'              => $request->get('name'),
				'address'           => $request->get('address'),
				'region'            => $request->get('region'),
				'phone'             => $request->get('phone'),
				'fax'               => $request->get('fax'),
				'email'             => $request->get('email'),
				'city'              => $request->get('city'),
				'founded'           => $request->get('founded'),
				'workers_number'    => $request->get('workers_number'),
				'owners'            => $request->get('owners'),
				'business_activity' => $request->get('business_activity'),
			];

			$enterprise = Enterprise::findOrFail($id);

			foreach ($enterpriseAttributes as $attrName => $attrVal) {
				$enterprise->$attrName = $attrVal;
			}

			if (!$enterprise->save()) {
				throw new \Exception("Cannot update enterprise: " . implode(',', $enterprise->errors()->all()));
			}

			$jsonResponse = [
				'response' => [
					'status'     => 'Success',
					'message'    => "Enterprise was updated successfully",
					'enterprise' => $enterprise
				],
				'status'   => 200
			];
		} catch (ModelNotFoundException $n) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Member Not Found',
					'message' => "Enterprise with id: " . $id . " was not found."
				],
				'status'   => 404
			];
		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Error',
					'message' => "Cannot update enterprise: " . $e->getMessage()
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
			$enterprise = Enterprise::findOrFail($id);
			$count = $enterprise->workers->count();
			if($count > 0) {
				throw new \Exception("Cannot remove Enterprise '{$enterprise->name}'. $count workers belong to it");
			}
			$enterprise->delete();

			$jsonResponse = [
				'response' => [
					'status'     => 'Success',
					'message'    => "Enterprise: " . $enterprise->name . " was deleted successfully",
					'enterprise' => $enterprise
				],
				'status'   => 200
			];
		} catch (ModelNotFoundException $n) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Member Not Found',
					'message' => "Cannot find enterprise with id: " . $id
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

	public function export()
	{
		Excel::create('Members List', function ($excel) {
			$excel->sheet('Enterprises', function ($sheet) {
				$sheet->setOrientation('landscape');
				$sheet->loadView('excel.enterprises', ['members' => Enterprise::all()]);
			});
		})->download('xlsx');
	}

}
