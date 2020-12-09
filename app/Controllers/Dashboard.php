<?php namespace App\Controllers;

use CodeIgniter\Database\Query;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        $db = \Config\Database::connect();

        if ($this->request->getMethod() == 'post') {

        }

        $share_yields = $db->prepare(function($db) {
            $sql =  "SELECT SUM(monthly_income) x from (SELECT *, (((total/price)/years)*100) yearly_yield, (total*shares)/years yearly_income, (((total/price)/(years*12))*100) monthly_yield, (total*shares)/(years*12) monthly_income, ROUND(years/12)+1 months FROM (SELECT SUM(amount) total, price, stock_id, stock, MAX(years) years, shares  from (SELECT *, ROUND((DATEDIFF(date_received, date_purchased) / 365) + 1) years from dividends NATURAL JOIN stocks WHERE user_id= ? ) as a GROUP BY stock_id) as b) as c;";

            return (new Query($db))->setQuery($sql);
        });

        $income = $db->prepare(function($db) {
            $sql =  "SELECT SUM(amount) x from income WHERE recurring=true AND user_id= ?";

            return (new Query($db))->setQuery($sql);
        });

        $purchases = $db->prepare(function($db) {
            $sql =  "SELECT SUM(amount) x from purchases WHERE recurring=true AND user_id= ?";

            return (new Query($db))->setQuery($sql);
        });

        $income_once = $db->prepare(function($db) {
            $sql =  "SELECT SUM(amount) x from income WHERE recurring=false AND user_id= ?";

            return (new Query($db))->setQuery($sql);
        });

        $purchases_once = $db->prepare(function($db) {
            $sql =  "SELECT SUM(amount) x from purchases WHERE recurring=false AND user_id= ?";

            return (new Query($db))->setQuery($sql);
        });

        $stock_value = $db->prepare(function($db) {
            $sql =  "SELECT SUM(cost) x FROM (SELECT (price*shares) cost from stocks WHERE user_id = ?) as a;";

            return (new Query($db))->setQuery($sql);
        });

        $data['dividend_monthly_income'] = round($share_yields->execute(intval(session()->get('id')))->getResult()[0]->x, 2);
        $data['income'] = round($income->execute(intval(session()->get('id')))->getResult()[0]->x, 2);
        $data['purchases'] = round($purchases->execute(intval(session()->get('id')))->getResult()[0]->x, 2);
        $data['income_once'] = round($income_once->execute(intval(session()->get('id')))->getResult()[0]->x, 2);
        $data['purchases_once'] = round($purchases_once->execute(intval(session()->get('id')))->getResult()[0]->x, 2);
        $data['stock_value'] = round($stock_value->execute(intval(session()->get('id')))->getResult()[0]->x, 2);


        $share_yields->close();
        $income->close();
        $purchases->close();
        $income_once->close();
        $purchases_once->close();
        $stock_value->close();

        echo view('templates/header', $data);
        echo view('dashboard');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}