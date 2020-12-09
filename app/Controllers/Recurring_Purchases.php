<?php namespace App\Controllers;

use CodeIgniter\Database\Query;

class Recurring_Purchases extends BaseController
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
                    $sql = "DELETE FROM purchases WHERE purchase_id = ?";
                    return (new Query($db))->setQuery($sql);
                });
                $delete->execute(intval($this->request->getPost('update')));
                $delete->close();

                $db->transComplete();
                return redirect()->to('recurring_purchases');
            }

            $rules = [
                'amount' => 'required|decimal|greater_than[0]'
            ];

            if (!$this->validate($rules)) {
                echo "<script type=\"text/javascript\">alert('Please fill in all fields and enter valid numbers.');</script>";
            } else {
                $db->transStart();
                if ($this->request->getPost('update') == "-1") {
                    $db->query("INSERT INTO purchases(recurring, purchase, amount, user_id) VALUES (true, \"" . $this->request->getPost('purchase') . "\", " . $this->request->getPost('amount') . ", " . session()->get('id') . ")");
                } else {
                    $update = $db->prepare(function($db) {
                        $sql = "UPDATE purchases SET purchase = ?, amount = ? WHERE purchase_id = ?";
                        return (new Query($db))->setQuery($sql);
                    });
                    $update->execute($this->request->getPost('purchase'), doubleval($this->request->getPost('amount')), intval($this->request->getPost('update')));
                    $update->close();
                }
                $db->transComplete();
                return redirect()->to('recurring_purchases');
            }
        }

        $data['purchases'] = $db->query("SELECT * from purchases WHERE user_id=" . session()->get('id') . " AND recurring=true");

        echo view('templates/header', $data);
        echo view('recurring_purchases');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}