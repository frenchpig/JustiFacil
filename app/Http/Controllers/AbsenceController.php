<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;


class AbsenceController extends Controller
{
  //show Absence view with all the existing absences on database
  public function index(){
    //get all absences
    $absences = Absence::all();
    //give the page a title
    $data = [
      'title' => 'Ausencias'
    ];
    //return view with all absences
    return view('absences', $data, compact('absences'));
  }

  //Save on DB function
  public function store($person_name, $description){
    //Creates an absence object
    $absence = new Absence;

    //Assing values to absences atributes
    $absence ->person_name = $person_name;
    $absence ->description = $description;

    //Saves to database
    $absence ->save();

  //store function end
  }

//Controller end
}
