<?php

use App\Models\Dispositivo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('precio');
            $table->integer('cantidad');
            $table->string('imagen');
            $table->string('textoAlternativoImagen');
            $table->timestamps();
        });

        $datosPredeterminados = array(
            [
                'nombre' => 'PlayStation 5',
                'descripcion' => 'Consola PlayStation 5 - Modelo de 512 GB. Incluye un control.',
                'precio' => 750,
                'cantidad' => 10,
                'imagen' => 'uploads/pW0XDrx6TVvrXtwJcVLZSTsg2SGERdDFijbebMB3.jpg',
                'textoAlternativoImagen' => 'Figura del Play Station 5'
            ],
            [
                'nombre' => 'Xbox Series X',
                'descripcion' => 'Nueva Consola Xbox Series X con una capacidad de 512GB SSD. Incluye un control y un mes gratis de Xbox Gamepass.',
                'precio' => 630,
                'cantidad' => 17,
                'imagen' => 'uploads/fCCDRNtyzh4XxmG5eDwpLwptVsawq2Juh8qKtrqg.jpg',
                'textoAlternativoImagen' => 'Figura del Xbox Series X'
            ],
            [
                'nombre' => 'Xiaomi Redmi Note 9',
                'descripcion' => 'Xiaomi Redmi Note 9 Dual SIM 128 GB gris medianoche 4 GB RAM',
                'precio' => 217,
                'cantidad' => 30,
                'imagen' => 'uploads/2yPmvnmkLPLn1g96ShNJxk6nyazOSjNXICmeVICS.jpg',
                'textoAlternativoImagen' => 'Figura del Xiami Redmi Note 9'
            ],
            [
                'nombre' => 'Amazon Kindle Fire 8',
                'descripcion' => 'Disfruta al m??ximo de la Tablet Fire HD 8 que te brinda hasta 10 horas de bater??a para que no se interrumpa el entretenimiento y la puedas llevar contigo a todas partes.',
                'precio' => 92,
                'cantidad' => 33,
                'imagen' => 'uploads/ACCDfByeweYsy5VfSnsNkemyx4XD1S0zgj35Nrb9.jpg',
                'textoAlternativoImagen' => 'Figura del Amazon Kindle Fire 8'
            ],
            [
                'nombre' => 'Mouse Inal??mbrico Lenovo',
                'descripcion' => 'El mouse Lenovo 300 compacto inal??mbrico es el accesorio perfecto para quienes viajan por el trabajo, ejecutivos que realizan presentaciones o cualquier persona que desee un mayor control y libertad.',
                'precio' => 11,
                'cantidad' => 25,
                'imagen' => 'uploads/n2ohGNjJt55Yg0vuGUh2eWmIOVtUM0lxpGek1F1M.jpg',
                'textoAlternativoImagen' => 'Figura del Mouse Inal??mbrico Lenovo'
            ],
            [
                'nombre' => 'Port??til Lenovo Ryzen 7 16gb 512gb Ssd Legion 5 Pro 16 Grey',
                'descripcion' => 'Disfruta de un rendimiento gamer de elite en una laptop para juegos delgada y liviana con una duraci??n de la bater??a incre??ble gracias a los nuevos procesadores m??viles AMD Ryzen??? 5000 H-Series. No vuelvas a aceptar l??mites en tu laptop para gaming.',
                'precio' => 1883,
                'cantidad' => 5,
                'imagen' => 'uploads/TXP9Q8wfOj67rCzlSvCLnU2uKq6KfK9a41RgTXLb.jpg',
                'textoAlternativoImagen' => 'Figura del Port??til Lenovo Ryzen 7 16gb 512gb'
            ],
            [
                'nombre' => 'Memoria Usb Maxell Metal 64gb',
                'descripcion' => 'Memoria USB Metal, dise??o peque??o, compacto y de bajo perfil con acabado de metal para mayor resistencia y duraci??n R??pida transferencia de datos y contenidos Para uso general o diario en el trabajo, la escuela, el hogar y los viajes para fotos, m??sica, videos, presentaciones, transferencia de archivos y almacenamiento general',
                'precio' => 8,
                'cantidad' => 50,
                'imagen' => 'uploads/uBuRgjgUiuD9LF3OUxjiD38SnsjuBxong1hZOHdv.jpg',
                'textoAlternativoImagen' => 'Figura de la memoria USB Maxell'
            ],
            // [
            //     'nombre' => '',
            //     'descripcion' => '',
            //     'precio' => ,
            //     'cantidad' => ,
            //     'imagen' => '',
            // ],
            // [
            //     'nombre' => '',
            //     'descripcion' => '',
            //     'precio' => ,
            //     'cantidad' => ,
            //     'imagen' => '',
            // ],
            // [
            //     'nombre' => '',
            //     'descripcion' => '',
            //     'precio' => ,
            //     'cantidad' => ,
            //     'imagen' => '',
            // ],
            // [
            //     'nombre' => '',
            //     'descripcion' => '',
            //     'precio' => ,
            //     'cantidad' => ,
            //     'imagen' => '',
            // ],
            // [
            //     'nombre' => '',
            //     'descripcion' => '',
            //     'precio' => ,
            //     'cantidad' => ,
            //     'imagen' => '',
            // ],
        );

        foreach($datosPredeterminados as $data){
            $dispositivo = new Dispositivo();
            $dispositivo->nombre = $data['nombre'];
            $dispositivo->descripcion = $data['descripcion'];
            $dispositivo->precio = $data['precio'];
            $dispositivo->cantidad = $data['cantidad'];
            $dispositivo->imagen = $data['imagen'];
            $dispositivo->textoAlternativoImagen = $data['textoAlternativoImagen'];
            $dispositivo->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositivos');
    }
}
