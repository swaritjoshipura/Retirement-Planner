<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Hello <?= session()->get('first_name')?>  <?= session()->get('last_name') ?></h1>

            <h2>Dashboard</h2>

            <br>
            <h3>Monthly Dividend Income: $<?=$dividend_monthly_income?></h3>
            <h3>Monthly Recurring Income: $<?=$income?></h3>
            <h3>Monthly Recurring Expenses: $<?= $purchases?></h3>
            <br>
            <h3>Net Monthly Cash Flow: $<?= ($dividend_monthly_income+$income)-($purchases)?></h3>
            <br><br>
            <h3>One-Time Income: $<?= $income_once?></h3>
            <h3>One-Time Expenses: $<?= $purchases_once?></h3>
            <h3>Stock Portfolio: $<?= $stock_value?></h3>
            <br>
            <h3>Net Worth: $<?= round(($dividend_monthly_income+$income+$income_once+$stock_value)-($purchases+$purchases_once), 2)?></h3>
        </div>
    </div>
</div>