<?php

namespace Admin\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseResourcePresenter extends ResourcePresenter
{
  protected $data;
  protected $helpers;

  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    $this->initGlobalData();
    parent::initController($request, $response, $logger);
  }

  protected function initGlobalData()
  {
    if (!empty($this->helpers)) {
      foreach ($this->helpers as $helper) {
        helper($helper);
      }
    }
  }
}
