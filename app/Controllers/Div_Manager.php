<?php namespace App\Controllers;

use CodeIgniter\Database\Query;

class Div_Manager extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        $db = \Config\Database::connect();

        if ($this->request->getMethod() == 'post') {
            if ($this->request->getPost('delete') === "true") {
                $db->transStart();
                $delete = $db->prepare(function($db) {
                    $sql = "DELETE FROM dividends WHERE dividend_id = ?";
                    return (new Query($db))->setQuery($sql);
                });
                $delete->execute(intval($this->request->getPost('update')));
                $delete->close();

                $db->transComplete();
                return redirect()->to('div_manager');
            }

            $rules = [
                'stock' => 'required',
                'dividend' => 'required|decimal|greater_than[0]'
            ];

            if (!$this->validate($rules)) {
                echo "<script type=\"text/javascript\">alert('Please fill in all fields and enter valid numbers for dividend amounts.');</script>";
            } else {
                if ($this->request->getPost('update') == "-1") {
                    $db->query("INSERT INTO dividends(stock_id, amount) VALUES (" . $this->request->getPost('stock') . ", " . $this->request->getPost('dividend') . ")");
                } else {
                    $update = $db->prepare(function($db) {
                        $sql = "UPDATE dividends SET stock_id = ?, amount = ? WHERE dividend_id = ?";
                        return (new Query($db))->setQuery($sql);
                    });
                    $update->execute($this->request->getPost('stock'), $this->request->getPost('dividend'), $this->request->getPost('update'));
                    $update->close();
                }
                return redirect()->to('div_manager');
            }
        }

        $data['stocks'] = $db->query("SELECT * from stocks WHERE user_id=" . session()->get('id'));
        $data['dividends'] = $db->query("SELECT dividend_id, stock, amount, shares, date_received from dividends NATURAL JOIN stocks WHERE user_id=" . session()->get('id'));

        echo view('templates/header', $data);
        echo view('div_manager');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}