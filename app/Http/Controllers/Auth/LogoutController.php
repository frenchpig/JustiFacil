<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
  public function logout(Request $request)
  {
      Auth::logout(); // Cierra la sesión del usuario
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect('/'); // Redirige al usuario a la página de inicio o a otra ruta de tu elección
  }
}
