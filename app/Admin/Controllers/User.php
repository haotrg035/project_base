<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseResourcePresenter;

class User extends BaseResourcePresenter
{
  protected $modelName = '';
  protected $helpers = ['Admin\Helpers\common'];

  public function index()
  {
    $this->data['meta']['title'] = 'Người dùng';
    return view('Admin\Views\Pages\User\index', $this->data);
  }
}
