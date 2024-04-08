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
        Schema::create('schedul_cals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('schedule_id_of_cal_gen');
            $table->decimal('time_duration', 65,2);
            $table->bigInteger('user_id');
            $table->decimal('salary_on_schedul', 65, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedul_cals');
    }
};

/*
SELECT 
genSal.id,
genSal.today_day, 
genSal.description,
user_privet_datas.first_name, 
user_privet_datas.second_name,

-- schedule salary
CASE
WHEN schedul_cals.time_duration != 0 AND schedul_cals.time_duration IS NOT NULL THEN schedul_cals.time_duration
ELSE 'None'
END AS `timeduration`,
-- payment description
CASE 
WHEN genSal.schedule_id != NULL OR genSal.schedule_id != 0 THEN
'Schedule'
-- allowance 
WHEN DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m') AND genSal.user_id = allowance_for_users.user_id THEN
'Allowance'
-- transport
WHEN genSal.trp_transport_id != 0 OR genSal.trp_transport_id != NULL THEN
'Transport'

-- additional allowance

WHEN genSal.additional_allowance_id != 0 OR genSal.additional_allowance_id != NULL THEN
'Additional Allowance'
END AS `Paymenent_description`,
-- payment
CASE 
WHEN genSal.schedule_id != NULL OR genSal.schedule_id != 0 THEN
schedul_cals.salary_on_schedul
-- allowance 
WHEN DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m') AND genSal.user_id = allowance_for_users.user_id THEN
allowance_tbs.allowance
-- transport
WHEN genSal.trp_transport_id != 0 OR genSal.trp_transport_id != NULL THEN
transpoer_price_details.transport_price

-- additional allowance

WHEN genSal.additional_allowance_id != 0 OR genSal.additional_allowance_id != NULL THEN
additional_allowances.allowance_amount
END AS `Paymenent`

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
credit_t_b_d2s ON genSal.credit_id = credit_t_b_d2s.id;
*/