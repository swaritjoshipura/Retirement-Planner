<?php namespace App\Controllers;

use CodeIgniter\Database\Query;

class Div_Info extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        $db = \Config\Database::connect();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'stock' => 'required',
                'price' => 'required|decimal|greater_than[0]',
                'shares' => 'required|decimal|greater_than[0]',
                'exchange' => 'required'
            ];

            if (! $this->validate($rules)) {
                echo "<script type=\"text/javascript\">alert('Please fill in all fields and enter valid numbers for price & shares.');</script>";
            } else {
                $db->transStart();
                if ($this->request->getPost('update') == "-1") {
                    $db->query("INSERT INTO stocks(stock, price, shares, exchange, user_id) VALUES (\"" . strtoupper($this->request->getPost('stock')) . "\", " . $this->request->getPost('price') . ", " . $this->request->getPost('shares') . ", \"" . strtoupper($this->request->getPost('exchange')) . "\", " . session()->get('id') . ")");
                } else {
                    $update_stock = $db->prepare(function($db) {
                        $sql = "UPDATE stocks SET stock = ?, price = ?, shares = ?, exchange = ? WHERE stock_id = ?";
                        return (new Query($db))->setQuery($sql);
                    });
                    $update_stock->execute(strtoupper($this->request->getPost('stock')), $this->request->getPost('price'), $this->request->getPost('shares'), strtoupper($this->request->getPost('exchange')), $this->request->getPost('update'));
                    $update_stock->close();
                }
                $db->transComplete();
                return redirect()->to('div_info');
            }
        }

        $data['stocks'] = $db->query("SELECT * from stocks WHERE user_id=" . session()->get('id'));

        echo view('templates/header', $data);
        echo view('div_info');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}