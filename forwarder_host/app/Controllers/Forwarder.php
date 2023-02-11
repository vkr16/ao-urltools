<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Forwarder extends BaseController
{
    protected $urlModel;

    public function __construct()
    {
        $this->urlModel = model('UrlModel', true, $db);
    }

    public function index($param)
    {
        if ($url_data = $this->urlModel->where('short_url', $param)->find()) {

            $this->urlModel->set("hits", $url_data[0]['hits'] + 1)->where('id', $url_data[0]['id'])->update();

            return redirect()->to($url_data[0]['long_url']);
        } else {
            throw new \Exception('404');
        }
    }

    public function dashboard()
    {
        return redirect()->to($_ENV['MAIN_HOST']);
    }
}
