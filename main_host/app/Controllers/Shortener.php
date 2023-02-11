<?php

namespace App\Controllers;


class Shortener extends BaseController
{
    protected $userModel;
    protected $urlModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->userModel = model("UserModel", true, $db);
        $this->urlModel = model("UrlModel", true, $db);
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    public function urlShortener()
    {
        $user = $this->userModel->where('email', $this->session->get('email'))->find();
        $urls = $this->urlModel->where('creator_id', $user[0]['id'])->find();
        $data = [
            'urls' => $urls,
        ];
        return view('url-shortener', $data);
    }

    public function shortenUrl()
    {
        $url =  trim($_POST['url']);
        $custom = trim($_POST['short']);


        if ($custom == '') {
            do {
                $short = $this->generateRandomString(6);
            } while ($this->urlModel->where('short_url', $short)->find());
        } else {
            $short = $custom;
            if ($this->urlModel->where('short_url', $short)->find()) {
                $result = [
                    'status' => 'conflict',
                    'data' => 'this short url is already in use'
                ];
            }
        }

        $this->validation->setRules(
            [
                'url' => 'required|min_length[5]|valid_url',
                'short' => 'required|min_length[3]|valid_url|is_unique[urls.short_url]'
            ],
            [
                'url' => [
                    'required' => 'Long URL field is required.',
                    'min_length' => 'Long URL field must be at least 5 characters long.',
                    'valid_url' => 'Please enter a valid URL.'
                ],
                'short' => [
                    'required' => 'Short URL field is required.',
                    'min_length' => 'Short URL field must be at least 3 characters long.',
                    'valid_url' => 'Please only use valid url characters.',
                    'is_unique' => 'This short url is already in use.'
                ]
            ]
        );

        if (!$this->validation->run(['url' => $url, 'short' => $short])) {
            return json_encode($this->validation->getErrors());
        }



        $user = $this->userModel->where('email', $this->session->get('email'))->find();
        $user_id = $user[0]['id'];

        $url_data = [
            'long_url' => $url,
            'short_url' => $short,
            'creator_id' => $user_id
        ];

        if ($this->urlModel->insert($url_data)) {
            $result = [
                'status' => 'success',
                'data' => $short
            ];
            $this->session->setFlashdata('shortened_url', $short);
            return json_encode($result);
        } else {
            $result = [
                'status' => 'error',
                'data' => "Failed to insert data to database"
            ];
            return json_encode($result);
        }
    }

    public function deleteUrl()
    {
        $url_id = $_POST['id'];
        if ($this->urlModel->where('id', $url_id)->delete()) {
            $result = [
                'status' => 'success',
                'data' => 'deleted'
            ];
            return json_encode($result);
        } else {
            $result = [
                'status' => 'error',
                'data' => "Failed to delete data from database"
            ];
            return json_encode($result);
        }
    }

    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
