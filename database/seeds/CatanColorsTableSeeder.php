<?php

use Illuminate\Database\Seeder;

class CatanColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $colors[]=[
            'color'    => 'red',
            'name'       => 'Красный',
            'color1_element'   => '#ce3631',
            'color2_element'   => '#751515',
            'color3_element'   => '#300508',
        ];
        $colors[]=[
            'color'    => 'green',
            'name'       => 'Зеленый',
            'color1_element'   => '#42ce31',
            'color2_element'   => '#167515',
            'color3_element'   => '#053006',
        ];
        $colors[]=[
            'color'    => 'orange',
            'name'       => 'Оранжевый',
            'color1_element'   => '#ce7931',
            'color2_element'   => '#754615',
            'color3_element'   => '#302505',
        ];
        $colors[]=[
            'color'    => 'blue',
            'name'       => 'Голубой',
            'color1_element'   => '#314cce',
            'color2_element'   => '#151875',
            'color3_element'   => '#050630',
        ];



        \DB::table('catan_colors')->insert($colors);
        //
    }
}
