<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateParentUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER parent_user_after_insert AFTER INSERT 
        ON users 
        FOR EACH ROW
        BEGIN
            IF(NEW.role = 1) 
            THEN
  				 INSERT INTO medical_staff (user_id) VALUES (NEW.id);
			END IF;
            
        	IF (NEW.role = 3)
            THEN
            	INSERT INTO parents (user_id) VALUES (NEW.id);
            END IF;
            
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::unprepared('DROP TRIGGER IF EXISTS parent_user_after_insert');
    }
}
