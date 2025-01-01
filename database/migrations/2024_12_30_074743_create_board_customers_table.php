<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_customers', function (Blueprint $table) {
            $table->id();
            $table->string('login_code')->unique(); // Mã đăng nhập
            $table->string('card_code')->unique(); // Mã thẻ
            $table->string('full_name'); // Họ và tên
            $table->date('birth_date')->nullable(); // Ngày sinh
            $table->string('gender'); // Giới tính
            $table->string('phone'); // Số điện thoại
            $table->string('email'); // Email
            $table->string('avatar')->nullable();
            $table->string('unit_name'); // Tên đơn vị
            $table->string('unit_position'); // Chức vụ tại đơn vị
            $table->string('association_position'); // Chức vụ trong hội
            $table->string('term'); // Nhiệm kỳ
            $table->boolean('attendance_permission')->default(false); // Quyền điểm danh
            $table->foreignId('club_id')->nullable()->constrained('clubs')->nullOnDelete(); // Tham chiếu câu lạc bộ
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('board_customers');
    }
};