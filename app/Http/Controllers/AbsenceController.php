<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;


class AbsenceController extends Controller
{
  //Save on DB function
  public function store($person_name, $description){
    $absence = new Absence;

    $absence ->person_name = $person_name;
    $absence ->description = $description;

    $absence ->save();
  }
}
