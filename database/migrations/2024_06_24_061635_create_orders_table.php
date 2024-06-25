<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->nullable();
            $table->string('season')->nullable();
            $table->string('brand')->nullable();
            $table->string('sub_brand')->nullable();
            $table->string('style_code')->nullable();
            $table->integer('order_quantity')->nullable();
            $table->string('gender')->nullable();
            $table->string('budget')->nullable();
            $table->string('Category')->nullable();
            $table->string('Product')->nullable();
            $table->string('Cluster')->nullable();
            $table->string('Sleeve')->nullable();
            $table->integer('Body_Length')->nullable();
            $table->integer('Sleeve_Length')->nullable();
            $table->integer('Width')->nullable();
            $table->string('Shell_Fabric')->nullable();
            $table->string('Structure')->nullable();
            $table->string('Content')->nullable();
            $table->integer('Count')->nullable();
            $table->integer('Gsm')->nullable();          
            $table->string('fabric_bio')->nullable();
            $table->string('fabric_dyeing')->nullable();
            $table->string('special_process_1_input')->nullable();
            $table->string('special_process_2_input')->nullable();
            $table->integer('SMV')->nullable();
            $table->integer('print_emb')->nullable();
            $table->integer('trim_cost')->nullable();
            $table->integer('incremental_consumptions')->nullable();
            $table->string('trim_fab_1')->nullable();
            $table->integer('rib_jacquards')->nullable();
            $table->integer('variegated_cost_input')->nullable();
            $table->integer('cpl_input')->nullable();
            $table->string('gmt_wash')->nullable();
            $table->integer('yarn_rl_compact')->nullable();
            $table->integer('knitting')->nullable();
            $table->integer('fab_bio')->nullable();
            $table->integer('dyeing')->nullable();
            $table->integer('special_process_1')->nullable();
            $table->integer('special_process_2')->nullable();
            $table->integer('compacting')->nullable();
            $table->integer('sum_input')->nullable();
            $table->integer('process_loss')->nullable();
            $table->integer('CPL')->nullable();
            $table->integer('fabric_per_kg')->nullable();
            $table->integer('std_consumption')->nullable();
            $table->integer('Incremental_Consum')->nullable();
            $table->integer('per_gmt_fab_cost')->nullable();
            $table->integer('rib_consumption')->nullable();
            $table->integer('rib_per_kg')->nullable();
            $table->integer('per_gmt_rib_cost')->nullable();
            $table->integer('fabric_cost_per_gmt')->nullable();
            $table->integer('cmt')->nullable();
            $table->integer('emb_print')->nullable();
            $table->integer('Thread')->nullable();
            $table->integer('branded_trims')->nullable();
            $table->integer('packaging_trims')->nullable();
            $table->integer('washing')->nullable();
            $table->integer('Variegated_Cost')->nullable();
            $table->integer('Sum')->nullable();
            $table->integer('rejection_%')->nullable();
            $table->integer('finance_%')->nullable();
            $table->integer('margin+oh_%')->nullable();
            $table->integer('total')->nullable();
            $table->integer('testing')->nullable();
            $table->integer('transport')->nullable();
            $table->integer('fob')->nullable();
            $table->integer('mrp')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('min_range')->nullable();
            $table->integer('multiple')->nullable();
            $table->integer('percent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

