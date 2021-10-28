<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'name' => 'Casablanca',
                'slug' => 'casablanca'
            ], [
                'name' => 'Rabat',
                'slug' => 'rabat'
            ], [
                'name' => 'Marrakech',
                'slug' => 'marrakech'
            ], [
                'name' => 'El Jadida',
                'slug' => 'eljadida'
            ], [
                'name' => 'Oujda',
                'slug' => 'oujda'
            ], [
                'name' => 'Meknès',
                'slug' => 'meknes'
            ], [
                'name' => 'Agadir',
                'slug' => 'agadir'
            ], [
                'name' => 'Sale',
                'slug' => 'sale'
            ], [
                'name' => 'Safi',
                'slug' => 'safi'
            ], [
                'name' => 'Fès',
                'slug' => 'fes'
            ], [
                'name' => 'Kénitra',
                'slug' => 'kenitra'
            ], [
                'name' => 'Mohammedia',
                'slug' => 'mohammedia'
            ], [
                'name' => 'Tanger',
                'slug' => 'tanger'
            ], [
                'name' => 'Temara',
                'slug' => 'temara'
            ], [
                'name' => 'Khouribga',
                'slug' => 'khouribga'
            ], [
                'name' => 'Settat',
                'slug' => 'Settat'
            ], [
                'name' => 'Tetouan',
                'slug' => 'tetouan'
            ], [
                'name' => 'Nador',
                'slug' => 'nador'
            ], [
                'name' => 'Berrechid',
                'slug' => 'berrechid'
            ], [
                'name' => 'Larache',
                'slug' => 'larache'
            ], [
                'name' => 'Ait Melloul',
                'slug' => 'aitmelloul'
            ], [
                'name' => 'Berkane',
                'slug' => 'berkane'
            ], [
                'name' => 'Essaouira',
                'slug' => 'essaouira'
            ], [
                'name' => 'Khemisset',
                'slug' => 'khemisset'
            ], [
                'name' => 'Taza',
                'slug' => 'taza'
            ], [
                'name' => 'Ouarzazate',
                'slug' => 'ouarzazate'
            ], [
                'name' => 'Inezgane',
                'slug' => 'inezgane'
            ], [
                'name' => 'Bouznika',
                'slug' => 'bouznika'
            ], [
                'name' => 'Ben Guerir',
                'slug' => 'benguerir'
            ], [
                'name' => 'Sidi Kacem',
                'slug' => 'sidikacem'
            ], [
                'name' => 'Guelmim',
                'slug' => 'guelmim'
            ], [
                'name' => 'Laayoune',
                'slug' => 'laayoune'
            ], [
                'name' => 'Chefchaouen',
                'slug' => 'chefchaouen'
            ], [
                'name' => 'Beni Mellal',
                'slug' => 'benimellal'
            ], [
                'name' => 'Sefrou',
                'slug' => 'sefrou'
            ], [
                'name' => 'Tikiouine',
                'slug' => 'tikiouine'
            ], [
                'name' => 'Tiflet',
                'slug' => 'tiflet'
            ], [
                'name' => 'Azrou',
                'slug' => 'azrou'
            ], [
                'name' => 'Fkih Ben Salah',
                'slug' => 'fkihbensalah'
            ], [
                'name' => 'Al Hoceima',
                'slug' => 'alhoceima'
            ], [
                'name' => 'Ksar El Kebir',
                'slug' => 'ksarelkebir'
            ], [
                'name' => 'Sidi Slimane',
                'slug' => 'sidislimane'
            ], [
                'name' => 'Dar Bouazza',
                'slug' => 'darbouazza'
            ], [
                'name' => 'Taourirt',
                'slug' => 'taourirt'
            ]
            
        ]);
    }
}
