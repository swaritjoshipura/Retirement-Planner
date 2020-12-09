<?php namespace App\Controllers;

use CodeIgniter\Database\Query;

class Div_Income extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        $db = \Config\Database::connect();

        if ($this->request->getMethod() == 'post') {

        }

        $data['share_recoup'] = $db->query("SELECT stock, dividends_received, shares_price, ((dividends_received/shares_price)*100) total_yield from (SELECT stock, (SUM(amount)*SUM(shares)) dividends_received, (SUM(price)*SUM(shares)) shares_price from dividends NATURAL JOIN stocks WHERE user_id=" . session()->get('id') . " GROUP BY stock) as a");

        $share_yields = $db->prepare(function($db) {
           $sql =  "SELECT years, stock, (((total/price)/years)*100) yearly_yield, (total*shares)/years yearly_income, (((total/price)/(years*12))*100) monthly_yield, (total*shares)/(years*12) monthly_income, ROUND(years/12)+1 months, (shares*price) full_price FROM (SELECT SUM(amount) total, price, stock_id, stock, MAX(years) years, shares  from (SELECT *, ROUND((DATEDIFF(date_received, date_purchased) / 365) + 1) years from dividends NATURAL JOIN stocks WHERE user_id= ? ) as a GROUP BY stock_id) as b;";

           return (new Query($db))->setQuery($sql);
        });

        $data['share_yields'] = $share_yields->execute(intval(session()->get('id')));
        $share_yields->close();

        echo view('templates/header', $data);
        echo view('div_income');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}