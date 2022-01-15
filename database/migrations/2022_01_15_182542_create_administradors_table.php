<?php

use App\Models\Administrador;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('correo')->unique();
            $table->string('password');
            $table->timestamps();
        });

        $datosPredeterminados = array(
            [
                'correo' => 'jupachon@unal.edu.co',
                'password' => '$2y$10$fifIMBBX8pBMXF2ZBZCTO.MVXtSl6nuQYRravAEa6NOG9kIDVvPi6'
            ],
            [
                'correo' => 'ptabordam@unal.edu.co',
                'password' => '$2y$10$fifIMBBX8pBMXF2ZBZCTO.MVXtSl6nuQYRravAEa6NOG9kIDVvPi6'
            ],
            [
                'correo' => 'almunozr@unal.edu.co',
                'password' => '$2y$10$fifIMBBX8pBMXF2ZBZCTO.MVXtSl6nuQYRravAEa6NOG9kIDVvPi6'
            ],
        );

        foreach ($datosPredeterminados as $administrador) {
            $nuevoAdmin = new Administrador();
            $nuevoAdmin->correo = $administrador['correo'];
            $nuevoAdmin->password = $administrador['password'];
            $nuevoAdmin->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administradors');
    }
}
