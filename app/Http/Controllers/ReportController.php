<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{
    public function exportAll($active=true)
    {
	    Excel::create('Members List', function ($excel) {
	    $excel->sheet('Workers', function ($sheet) {
		    $sheet->setOrientation('landscape');
		    $sheet->freezeFirstRow();
		    $sheet->loadView('excel.workers', ['members' => Worker::all()]);
	    });

	    $excel->sheet('Enterprises', function ($sheet) {
		    $sheet->setOrientation('landscape');
		    $sheet->loadView('excel.enterprises', ['members' => Enterprise::all()]);
	    });

	    $excel->sheet('Specialties', function ($sheet) {
		    $sheet->setOrientation('landscape');
		    $sheet->loadView('excel.specialties', ['members' => Specialty::all()]);
	    });
    })->download('xlsx');
    }


}
