<?php namespace App\Controllers;

use CodeIgniter\Database\Query;

class One_Time_Income extends BaseController
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
                    $sql = "DELETE FROM income WHERE income_id = ?";
                    return (new Query($db))->setQuery($sql);
                });
                $delete->execute(intval($this->request->getPost('update')));
                $delete->close();

                $db->transComplete();
                return redirect()->to('one_time_income');
            }

            $rules = [
                'amount' => 'required|decimal|greater_than[0]'
            ];

            if (!$this->validate($rules)) {
                echo "<script type=\"text/javascript\">alert('Please fill in all fields and enter valid numbers.');</script>";
            } else {
                $db->transStart();
                if ($this->request->getPost('update') == "-1") {
                    $db->query("INSERT INTO income(recurring, source, amount, user_id) VALUES (false, \"" . $this->request->getPost('source') . "\", " . $this->request->getPost('amount') . ", " . session()->get('id') . ")");
                } else {
                    $update = $db->prepare(function($db) {
                        $sql = "UPDATE income SET source = ?, amount = ? WHERE income_id = ?";
                        return (new Query($db))->setQuery($sql);
                    });
                    $update->execute($this->request->getPost('source'), doubleval($this->request->getPost('amount')), intval($this->request->getPost('update')));
                    $update->close();
                }
                $db->transComplete();
                return redirect()->to('one_time_income');
            }
        }

        $data['income'] = $db->query("SELECT * from income WHERE user_id=" . session()->get('id') . " AND recurring=false");

        echo view('templates/header', $data);
        echo view('one_time_income');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}