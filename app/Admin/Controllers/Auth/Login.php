<?php

namespace Admin\Controllers\Auth;

use App\Controllers\BaseController;

class Login extends BaseController
{

  public function login()
  {
    return view('Admin\Views\Pages\Auth\login');
  }
}
