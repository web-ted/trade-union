<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
	public function test()
	{
		$specialty = Specialty::find(10);
		return response()->json(['count' => $specialty->workers->count()]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Specialty::all();
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
			$specialty = new Specialty();
			$specialtyAttributes = [
				'name'              => $request->get('name'),
				'description'       => $request->get('description'),
			];

			foreach ($specialtyAttributes as $attrName => $attrVal) {
				$specialty->$attrName = $attrVal;
			}

			if (!$specialty->save()) {
				throw new \Exception("Cannot save worker: " . implode(',', $specialty->errors()->all()));
			}

			$jsonResponse = [
				'response' => $specialty,
				'response' => [
					'status'    => 'Success',
					'message'   => "Specialty " . $specialty->name . " was created successfully",
					'specialty' => $specialty
				],
				'status'   => 200
			];

		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Error',
					'message' => "Cannot save specialty: " . $e->getMessage()
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
			$specialty = Specialty::findOrFail($id);
			$jsonResponse = [
				'response' => $specialty,
				'response' => [
					'status'    => 'success',
					'message'   => "Specialty was found successfully",
					'specialty' => $specialty
				],
				'status'   => 200
			];
		} catch (ModelNotFoundException $n) {
			$jsonResponse = [
				'response' => [
					'status'    => 'error',
					'message'   => "Specialty with id: $id was not found",
					'specialty' => false
				],
				'status'   => 404
			];
		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'    => 'error',
					'message'   => "Error:" . $e->getMessage(),
					'specialty' => false
				],
				'status'   => 404
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
			$specialtyAttributes = [
				'name'              => $request->get('name'),
				'description'       => $request->get('description'),
			];

			$specialty = Specialty::findOrFail($id);

			foreach ($specialtyAttributes as $attrName => $attrVal) {
				$specialty->$attrName = $attrVal;
			}

			if (!$specialty->save()) {
				throw new \Exception("Cannot update specialty: " . implode(',', $specialty->errors()->all()));
			}

			$jsonResponse = [
				'response' => [
					'status'    => 'Success',
					'message'   => "Specialty " . $specialty->first_name . " " . $specialty->last_name . " was updated successfully",
					'specialty' => $specialty
				],
				'status'   => 200
			];

		} catch (ModelNotFoundException $n) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Member Not Found',
					'message' => "Cannot update specialty with id: " . $id . ". He was not found."
				],
				'status'   => 404
			];
		} catch (\Exception $e) {
			$jsonResponse = [
				'response' => [
					'status'  => 'error',
					'message' => "Cannot update specialty: " . $e->getMessage()
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
			$specialty = Specialty::findOrFail($id);
			$count = $specialty->workers->count();
			if($count > 0) {
				throw new \Exception("Cannot remove Specialty '{$specialty->name}'. $count workers belong to it");
			}
			$specialty->delete();

			$jsonResponse = [
				'response' => [
					'status'    => 'Success',
					'message'   => "Specialty: " . $specialty->first_name . " " . $specialty->last_name . " was deleted successfully",
					'specialty' => $specialty
				],
				'status'   => 200
			];
		} catch (ModelNotFoundException $n) {
			$jsonResponse = [
				'response' => [
					'status'  => 'Member Not Found',
					'message' => "Cannot find specialty with id: " . $id
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
			$excel->sheet('Specialties', function ($sheet) {
				$sheet->setOrientation('landscape');
				$sheet->loadView('excel.specialties', ['members' => self::all()]);
			});
		})->download('xlsx');
	}

}
