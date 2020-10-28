<?php

namespace Admin\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;
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

    /**
     * Set meta data for page
     *
     * @param String $pageTitle Title of weboage
     * @param String $pageSubtitle subtitle next to title
     * @return void
     */
    protected function setMeta(String $pageTitle, String $pageSubtitle = "")
    {
        return $this->data['meta'] = [
            'title' => $pageTitle,
            'subtitle' => $pageSubtitle,
        ];
    }
}