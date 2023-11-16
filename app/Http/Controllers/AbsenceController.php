<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Person;


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
  public function store($person_name, $description,$phone){
    //Creates an absence object
    $absence = new Absence;

    //Assing values to absences atributes
    $absence ->person_name = $person_name;
    $absence ->description = $description;
    $absence ->phone = $phone;

    //Saves to database
    $absence ->save();

  //store function end
  }

  //Check if person exists on DB
  public function checkPhoneNumberRegistered($phone){
    //Gets a person with the phonenumber entered
    $person = Person::where('phone', $phone)->first();

    if ($person){
      return ['found'=>true,'user'=>$person];
    }else{
      return ['found'=>false,'user'=>null];
    }
  }

  public function registerPerson($name,$phone){
    $person = new Person();
    $person->name=$name;
    $person->phone=$phone;
    $person->save();

    return ['status'=>true];
  }


//Controller end
}
