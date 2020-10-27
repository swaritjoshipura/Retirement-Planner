<?php namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        $db = \Config\Database::connect();

        if ($this->request->getMethod() == 'post') {
            $db->query("INSERT INTO stocks(stock, price, shares, exchange, user_id) VALUES (\"" . $this->request->getPost('stock') . "\", " . $this->request->getPost('price') . ", ". $this->request->getPost('shares') . ", \"". $this->request->getPost('exchange') . "\", ". session()->get('id') . ")");

            return redirect()->to('dashboard');
        }

        $data['stocks'] = $db->query("SELECT * from stocks WHERE user_id=" . session()->get('id'));

        echo view('templates/header', $data);
        echo view('dashboard');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}
