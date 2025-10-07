
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->string('brand');
            $table->integer('stock');
            $table->string('utility');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Medicamentos');
    }
};
