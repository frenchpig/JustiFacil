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
    $status = 'Todos';
    //return view with all absences
    return view('absences', $data, ['absences'=>$absences,'selectedStatus'=>$status]);
  }

  public function filterAbsences($status){
    $data = [
      'title' => 'Ausencias'
    ];
    if ($status && $status !== 'Todos'){
      $absences = Absence::where('status',$status)->get();
      return view('absences', $data, ['absences'=>$absences,'selectedStatus'=>$status]);
    }else{
      return redirect()->route('home');
    }
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

  public function acceptAbsence($id) {
    //returns absence by id
    $absence = Absence::find($id);

    //checks if absence was found
    if ($absence) {
      //changes status to Aceptada and saves.
      $absence->status= 'Aceptada';
      $absence->save();
    }
    return redirect()->back();
  }

  public function rejectAbsence($id) {
    //gets absence
    $absence = Absence::find($id);

    //if absence found
    if ($absence) {
      //reject
      $absence->status = 'Rechazada';
      $absence->save();
    }
    return redirect()->back();
  }


//Controller end
}
