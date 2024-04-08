<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('how_gen_salaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->date('today_day');
            $table->text('description');
            $table->bigInteger('schedule_id')->nullable();
            $table->bigInteger('trp_transport_id')->nullable();
            $table->bigInteger('additional_allowance_id')->nullable();
            $table->bigInteger('credit_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('how_gen_salaries');
    }
};

/**
 * Salary calculation for VIEW
 */
/*SELECT 
genSal.id,
genSal.today_day, 
genSal.description,
user_privet_datas.first_name, 
user_privet_datas.second_name,
-- schedule salary
schedul_cals.time_duration, 
schedul_cals.salary_on_schedul,
-- allowance
CASE 
WHEN DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m') AND genSal.user_id = allowance_for_users.user_id THEN
allowance_tbs.allowance
END AS `allowance_of_that`,
-- transport
CASE 
WHEN genSal.trp_transport_id = 0 THEN
'0.00'
WHEN genSal.trp_transport_id > 0 THEN
transpoer_price_details.transport_price
END AS `transport`,
-- additional allowance
CASE 
WHEN genSal.additional_allowance_id = 0 THEN
'0.00'
WHEN genSal.additional_allowance_id > 0 THEN
additional_allowances.allowance_amount
END AS `additional_allowance`

FROM
how_gen_salaries genSal
-- parivat data of user
LEFT JOIN
user_privet_datas ON genSal.user_id = user_privet_datas.user_id
-- schedule information
LEFT JOIN
schedul_cals ON genSal.schedule_id = schedul_cals.schedule_id_of_cal_gen
-- allowance
LEFT JOIN
allowance_for_users ON genSal.user_id = allowance_for_users.user_id
AND DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m')
LEFT JOIN 
allowance_tbs ON allowance_for_users.allowance_id = allowance_tbs.id
-- transport
LEFT JOIN
transpoer_price_details ON genSal.trp_transport_id = transpoer_price_details.id
-- additional allowance
LEFT JOIN additional_allowances ON genSal.additional_allowance_id = additional_allowances.id
-- no confirmed credit
LEFT JOIN
credit_t_b_d2s ON genSal.credit_id = credit_t_b_d2s.id;*/

// View Update - 1
/*CREATE VIEW monthly_user_balance AS
SELECT 
  user_id,
  DATE_FORMAT(today_day, '%Y-%m') AS month_year,
  SUM(net_salary) AS monthly_balance
FROM
  (SELECT 
    genSal.user_id,
    genSal.today_day,
    (schedul_cals.salary_on_schedul + IFNULL(allowance_tbs.allowance, 0) + IFNULL(transpoer_price_details.transport_price, 0) + IFNULL(additional_allowances.allowance_amount, 0) - IFNULL(credit_t_b_d2s.installment, 0)) AS net_salary
   FROM how_gen_salaries genSal
LEFT JOIN
user_privet_datas ON genSal.user_id = user_privet_datas.user_id
-- schedule information
LEFT JOIN
schedul_cals ON genSal.schedule_id = schedul_cals.schedule_id_of_cal_gen
-- allowance
LEFT JOIN
allowance_for_users ON genSal.user_id = allowance_for_users.user_id
AND DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m')
LEFT JOIN 
allowance_tbs ON allowance_for_users.allowance_id = allowance_tbs.id
-- transport
LEFT JOIN
transpoer_price_details ON genSal.trp_transport_id = transpoer_price_details.id
-- additional allowance
LEFT JOIN additional_allowances ON genSal.additional_allowance_id = additional_allowances.id
-- no confirmed credit
LEFT JOIN
credit_t_b_d2s ON genSal.credit_id = credit_t_b_d2s.id
  ) AS salary_components
GROUP BY user_id, DATE_FORMAT(today_day, '%Y-%m');*/

/*I need to this modify if "genSal.description" = "Credit" add with "monthly_balance" relevant values of this view if "genSal.desccription" = "Debit"  reduce  with "monthly_balance" relavant values of this view.
and need to "monthly_balance" for each user, resetting to 0 at the start of each month before adding up the transactions.*/

// View - Update - 2
/*CREATE VIEW monthly_user_balance AS
SELECT 
  user_id,
  DATE_FORMAT(today_day, '%Y-%m') AS month_year,
  SUM(net_salary) AS monthly_balance
FROM
  (
    SELECT 
      genSal.user_id,
      genSal.today_day,
      CASE 
        WHEN genSal.description = 'Credit' THEN
          schedul_cals.salary_on_schedul 
          + IFNULL(allowance_tbs.allowance, 0) 
          + IFNULL(transpoer_price_details.transport_price, 0) 
          + IFNULL(additional_allowances.allowance_amount, 0) 
          + IFNULL(credit_t_b_d2s.installment, 0) -- Assuming this is the field to modify for Credit
        WHEN genSal.description = 'Debit' THEN
          schedul_cals.salary_on_schedul 
          + IFNULL(allowance_tbs.allowance, 0) 
          + IFNULL(transpoer_price_details.transport_price, 0) 
          + IFNULL(additional_allowances.allowance_amount, 0) 
          - IFNULL(credit_t_b_d2s.installment, 0) -- Assuming this is the field to modify for Debit
        ELSE
          schedul_cals.salary_on_schedul 
          + IFNULL(allowance_tbs.allowance, 0) 
          + IFNULL(transpoer_price_details.transport_price, 0) 
          + IFNULL(additional_allowances.allowance_amount, 0) 
          - IFNULL(credit_t_b_d2s.installment, 0)
      END AS net_salary
    FROM how_gen_salaries genSal
    LEFT JOIN user_privet_datas ON genSal.user_id = user_privet_datas.user_id
    LEFT JOIN schedul_cals ON genSal.schedule_id = schedul_cals.schedule_id_of_cal_gen
    LEFT JOIN allowance_for_users ON genSal.user_id = allowance_for_users.user_id
      AND DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m')
    LEFT JOIN allowance_tbs ON allowance_for_users.allowance_id = allowance_tbs.id
    LEFT JOIN transpoer_price_details ON genSal.trp_transport_id = transpoer_price_details.id
    LEFT JOIN additional_allowances ON genSal.additional_allowance_id = additional_allowances.id
    LEFT JOIN credit_t_b_d2s ON genSal.credit_id = credit_t_b_d2s.id
  ) AS salary_components
GROUP BY user_id, DATE_FORMAT(today_day, '%Y-%m');
*/



// Update - 4
/*
CREATE VIEW monthly_user_balanceTEST4 AS
SELECT 
  user_id,
  DATE_FORMAT(today_day, '%Y-%m') AS month_year,
  description,
  Payment,
  SUM(net_salary) AS monthly_balance
FROM
  (
    SELECT 
      genSal.user_id,
      genSal.today_day,
      genSal.description,
      CASE 
        WHEN genSal.description = 'Credit' OR genSal.description = 'Debit' THEN
      		COALESCE(
              IF(schedul_cals.salary_on_schedul IS NOT NULL AND schedul_cals.salary_on_schedul != 0, schedul_cals.salary_on_schedul, NULL),
              IF(credit_t_b_d2s.installment IS NOT NULL AND credit_t_b_d2s.installment != 0, credit_t_b_d2s.installment, NULL),
              IF(allowance_tbs.allowance IS NOT NULL AND allowance_tbs.allowance != 0, allowance_tbs.allowance, NULL),
              IF(transpoer_price_details.transport_price IS NOT NULL AND transpoer_price_details.transport_price != 0, transpoer_price_details.transport_price, NULL),
              IF(additional_allowances.allowance_amount IS NOT NULL AND additional_allowances.allowance_amount != 0, additional_allowances.allowance_amount, NULL)
            )      
      END AS `Payment`,
      CASE 
        WHEN genSal.description = 'Credit' THEN
          COALESCE(schedul_cals.salary_on_schedul, 0) 
          - COALESCE(credit_t_b_d2s.installment, 0)
          + COALESCE(allowance_tbs.allowance, 0) 
          + COALESCE(transpoer_price_details.transport_price, 0) 
          + COALESCE(additional_allowances.allowance_amount, 0) 
        WHEN genSal.description = 'Debit' THEN
          COALESCE(schedul_cals.salary_on_schedul, 0) 
          - COALESCE(credit_t_b_d2s.installment, 0)
          + COALESCE(allowance_tbs.allowance, 0) 
          + COALESCE(transpoer_price_details.transport_price, 0) 
          + COALESCE(additional_allowances.allowance_amount, 0)
        ELSE
          COALESCE(schedul_cals.salary_on_schedul, 0) 
          - COALESCE(credit_t_b_d2s.installment, 0)
          + COALESCE(allowance_tbs.allowance, 0) 
          + COALESCE(transpoer_price_details.transport_price, 0) 
          + COALESCE(additional_allowances.allowance_amount, 0)
      END AS net_salary
    FROM how_gen_salaries genSal
    LEFT JOIN user_privet_datas ON genSal.user_id = user_privet_datas.user_id
    LEFT JOIN schedul_cals ON genSal.schedule_id = schedul_cals.schedule_id_of_cal_gen
    LEFT JOIN allowance_for_users ON genSal.user_id = allowance_for_users.user_id
      AND DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m')
    LEFT JOIN allowance_tbs ON allowance_for_users.allowance_id = allowance_tbs.id
    LEFT JOIN transpoer_price_details ON genSal.trp_transport_id = transpoer_price_details.id
    LEFT JOIN additional_allowances ON genSal.additional_allowance_id = additional_allowances.id
    LEFT JOIN credit_t_b_d2s ON genSal.credit_id = credit_t_b_d2s.id
  ) AS salary_components
GROUP BY user_id, DATE_FORMAT(today_day, '%Y-%m');

 */