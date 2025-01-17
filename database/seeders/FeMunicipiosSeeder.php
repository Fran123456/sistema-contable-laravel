<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeMunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fe_municipios')->insert([
            ['id' => 1, 'codigo_m' => '00', 'valor' => 'Otro País', 'cod_departamento' => '00'],
            ['id' => 2, 'codigo_m' => '01', 'valor' => 'AHUACHAPÁN', 'cod_departamento' => '01'],
            ['id' => 3, 'codigo_m' => '02', 'valor' => 'APANECA', 'cod_departamento' => '01'],
            ['id' => 4, 'codigo_m' => '03', 'valor' => 'ATIQUIZAYA', 'cod_departamento' => '01'],
            ['id' => 5, 'codigo_m' => '04', 'valor' => 'CONCEPCIÓN DE ATACO', 'cod_departamento' => '01'],
            ['id' => 6, 'codigo_m' => '05', 'valor' => 'EL REFUGIO', 'cod_departamento' => '01'],
            ['id' => 7, 'codigo_m' => '06', 'valor' => 'GUAYMANGO', 'cod_departamento' => '01'],
            ['id' => 8, 'codigo_m' => '07', 'valor' => 'JUJUTLA', 'cod_departamento' => '01'],
            ['id' => 9, 'codigo_m' => '08', 'valor' => 'SAN FRANCISCO MENÉNDEZ', 'cod_departamento' => '01'],
            ['id' => 10, 'codigo_m' => '09', 'valor' => 'SAN LORENZO', 'cod_departamento' => '01'],
            ['id' => 11, 'codigo_m' => '10', 'valor' => 'SAN PEDRO PUXTLA', 'cod_departamento' => '01'],
            ['id' => 12, 'codigo_m' => '11', 'valor' => 'TACUBA', 'cod_departamento' => '01'],
            ['id' => 13, 'codigo_m' => '12', 'valor' => 'TURÍN', 'cod_departamento' => '01'],
            ['id' => 14, 'codigo_m' => '01', 'valor' => 'CANDELARIA DE LA FRONTERA', 'cod_departamento' => '02'],
            ['id' => 15, 'codigo_m' => '02', 'valor' => 'COATEPEQUE', 'cod_departamento' => '02'],
            ['id' => 16, 'codigo_m' => '03', 'valor' => 'CHALCHUAPA', 'cod_departamento' => '02'],
            ['id' => 17, 'codigo_m' => '04', 'valor' => 'EL CONGO', 'cod_departamento' => '02'],
            ['id' => 18, 'codigo_m' => '05', 'valor' => 'EL PORVENIR', 'cod_departamento' => '02'],
            ['id' => 19, 'codigo_m' => '06', 'valor' => 'MASAHUAT', 'cod_departamento' => '02'],
            ['id' => 20, 'codigo_m' => '07', 'valor' => 'METAPÁN', 'cod_departamento' => '02'],
            ['id' => 21, 'codigo_m' => '08', 'valor' => 'SAN ANTONIO PAJONAL', 'cod_departamento' => '02'],
            ['id' => 22, 'codigo_m' => '09', 'valor' => 'SAN SEBASTIÁN SALITRILLO', 'cod_departamento' => '02'],
            ['id' => 23, 'codigo_m' => '10', 'valor' => 'SANTA ANA', 'cod_departamento' => '02'],
            ['id' => 24, 'codigo_m' => '11', 'valor' => 'STA ROSA GUACHI', 'cod_departamento' => '02'],
            ['id' => 25, 'codigo_m' => '12', 'valor' => 'STGO D LA FRONT', 'cod_departamento' => '02'],
            ['id' => 26, 'codigo_m' => '13', 'valor' => 'TEXISTEPEQUE', 'cod_departamento' => '02'],
            ['id' => 27, 'codigo_m' => '01', 'valor' => 'ACAJUTLA', 'cod_departamento' => '03'],
            ['id' => 28, 'codigo_m' => '02', 'valor' => 'ARMENIA', 'cod_departamento' => '03'],
            ['id' => 29, 'codigo_m' => '03', 'valor' => 'CALUCO', 'cod_departamento' => '03'],
            ['id' => 30, 'codigo_m' => '04', 'valor' => 'CUISNAHUAT', 'cod_departamento' => '03'],
            ['id' => 31, 'codigo_m' => '05', 'valor' => 'STA I ISHUATAN', 'cod_departamento' => '03'],
            ['id' => 32, 'codigo_m' => '06', 'valor' => 'IZALCO', 'cod_departamento' => '03'],
            ['id' => 33, 'codigo_m' => '07', 'valor' => 'JUAYÚA', 'cod_departamento' => '03'],
            ['id' => 34, 'codigo_m' => '08', 'valor' => 'NAHUIZALCO', 'cod_departamento' => '03'],
            ['id' => 35, 'codigo_m' => '09', 'valor' => 'NAHULINGO', 'cod_departamento' => '03'],
            ['id' => 36, 'codigo_m' => '10', 'valor' => 'SALCOATITÁN', 'cod_departamento' => '03'],
            ['id' => 37, 'codigo_m' => '11', 'valor' => 'SAN ANTONIO DEL MONTE', 'cod_departamento' => '03'],
            ['id' => 38, 'codigo_m' => '12', 'valor' => 'SAN JULIÁN', 'cod_departamento' => '03'],
            ['id' => 39, 'codigo_m' => '13', 'valor' => 'STA C MASAHUAT', 'cod_departamento' => '03'],
            ['id' => 40, 'codigo_m' => '14', 'valor' => 'SANTO DOMINGO GUZMÁN', 'cod_departamento' => '03'],
            ['id' => 41, 'codigo_m' => '15', 'valor' => 'SONSONATE', 'cod_departamento' => '03'],
            ['id' => 42, 'codigo_m' => '16', 'valor' => 'SONZACATE', 'cod_departamento' => '03'],
            ['id' => 43, 'codigo_m' => '01', 'valor' => 'AGUA CALIENTE', 'cod_departamento' => '04'],
            ['id' => 44, 'codigo_m' => '02', 'valor' => 'ARCATAO', 'cod_departamento' => '04'],
            ['id' => 45, 'codigo_m' => '03', 'valor' => 'AZACUALPA', 'cod_departamento' => '04'],
            ['id' => 46, 'codigo_m' => '04', 'valor' => 'CITALÁ', 'cod_departamento' => '04'],
            ['id' => 47, 'codigo_m' => '05', 'valor' => 'COMALAPA', 'cod_departamento' => '04'],
            ['id' => 48, 'codigo_m' => '06', 'valor' => 'CONCEPCIÓN QUEZALTEPEQUE', 'cod_departamento' => '04'],
            ['id' => 49, 'codigo_m' => '07', 'valor' => 'CHALATENANGO', 'cod_departamento' => '04'],
            ['id' => 50, 'codigo_m' => '08', 'valor' => 'DULCE NOM MARÍA', 'cod_departamento' => '04'],
            ['id' => 51, 'codigo_m' => '09', 'valor' => 'EL CARRIZAL', 'cod_departamento' => '04'],
            ['id' => 52, 'codigo_m' => '10', 'valor' => 'EL PARAÍSO', 'cod_departamento' => '04'],
            ['id' => 53, 'codigo_m' => '11', 'valor' => 'LA LAGUNA', 'cod_departamento' => '04'],
            ['id' => 54, 'codigo_m' => '12', 'valor' => 'LA PALMA', 'cod_departamento' => '04'],
            ['id' => 55, 'codigo_m' => '13', 'valor' => 'LA REINA', 'cod_departamento' => '04'],
            ['id' => 56, 'codigo_m' => '14', 'valor' => 'LAS FLORES', 'cod_departamento' => '04'],
            ['id' => 57, 'codigo_m' => '15', 'valor' => 'LAS VUELTAS', 'cod_departamento' => '04'],
            ['id' => 58, 'codigo_m' => '16', 'valor' => 'NUEVA CONCEPCIÓN', 'cod_departamento' => '04'],
            ['id' => 59, 'codigo_m' => '17', 'valor' => 'NUEVA TRINIDAD', 'cod_departamento' => '04'],
            ['id' => 60, 'codigo_m' => '18', 'valor' => 'OJO DE AGUA', 'cod_departamento' => '04'],
            ['id' => 61, 'codigo_m' => '19', 'valor' => 'POTONICO', 'cod_departamento' => '04'],
            ['id' => 62, 'codigo_m' => '20', 'valor' => 'SAN ANTONIO DE LA CRUZ', 'cod_departamento' => '04'],
            ['id' => 63, 'codigo_m' => '21', 'valor' => 'SAN ANTONIO LOS RANCHOS', 'cod_departamento' => '04'],
            ['id' => 64, 'codigo_m' => '22', 'valor' => 'SAN FERNANDO', 'cod_departamento' => '04'],
            ['id' => 65, 'codigo_m' => '23', 'valor' => 'SAN FRANCISCO LEMPA', 'cod_departamento' => '04'],
            ['id' => 66, 'codigo_m' => '24', 'valor' => 'SAN FRANCISCO MORAZÁN', 'cod_departamento' => '04'],
            ['id' => 67, 'codigo_m' => '25', 'valor' => 'SAN IGNACIO', 'cod_departamento' => '04'],
            ['id' => 68, 'codigo_m' => '26', 'valor' => 'SAN ISIDRO LABRADOR', 'cod_departamento' => '04'],
            ['id' => 69, 'codigo_m' => '27', 'valor' => 'SAN LUIS DEL CARMEN', 'cod_departamento' => '04'],
            ['id' => 70, 'codigo_m' => '28', 'valor' => 'SAN MIGUEL DE MERCEDES', 'cod_departamento' => '04'],
            ['id' => 71, 'codigo_m' => '29', 'valor' => 'SAN RAFAEL', 'cod_departamento' => '04'],
            ['id' => 72, 'codigo_m' => '30', 'valor' => 'SANTA RITA', 'cod_departamento' => '04'],
            ['id' => 73, 'codigo_m' => '31', 'valor' => 'TEJUTLA', 'cod_departamento' => '04'],
            ['id' => 74, 'codigo_m' => '01', 'valor' => 'AGUILARES', 'cod_departamento' => '05'],
            ['id' => 75, 'codigo_m' => '02', 'valor' => 'APOPA', 'cod_departamento' => '05'],
            ['id' => 76, 'codigo_m' => '03', 'valor' => 'AYUTUXTEPEQUE', 'cod_departamento' => '05'],
            ['id' => 77, 'codigo_m' => '04', 'valor' => 'CIUDAD DELGADO', 'cod_departamento' => '05'],
            ['id' => 78, 'codigo_m' => '05', 'valor' => 'CUSTATLAN', 'cod_departamento' => '05'],
            ['id' => 79, 'codigo_m' => '06', 'valor' => 'EL PAISNAL', 'cod_departamento' => '05'],
            ['id' => 80, 'codigo_m' => '07', 'valor' => 'GUAZAPA', 'cod_departamento' => '05'],
            ['id' => 81, 'codigo_m' => '08', 'valor' => 'ILOPANGO', 'cod_departamento' => '05'],
            ['id' => 82, 'codigo_m' => '09', 'valor' => 'MEJICANOS', 'cod_departamento' => '05'],
            ['id' => 83, 'codigo_m' => '10', 'valor' => 'NEJAPA', 'cod_departamento' => '05'],
            ['id' => 84, 'codigo_m' => '11', 'valor' => 'PANCHIMALCO', 'cod_departamento' => '05'],
            ['id' => 85, 'codigo_m' => '12', 'valor' => 'ROSARIO DE MORA', 'cod_departamento' => '05'],
            ['id' => 86, 'codigo_m' => '13', 'valor' => 'SAN MARCOS', 'cod_departamento' => '05'],
            ['id' => 87, 'codigo_m' => '14', 'valor' => 'SAN MARTÍN', 'cod_departamento' => '05'],
            ['id' => 88, 'codigo_m' => '15', 'valor' => 'SAN SALVADOR', 'cod_departamento' => '05'],
            ['id' => 89, 'codigo_m' => '16', 'valor' => 'SANTIAGO TEXACUANGOS', 'cod_departamento' => '05'],
            ['id' => 90, 'codigo_m' => '17', 'valor' => 'SANTO TOMÁS', 'cod_departamento' => '05'],
            ['id' => 91, 'codigo_m' => '18', 'valor' => 'SOYAPANGO', 'cod_departamento' => '05'],
            ['id' => 92, 'codigo_m' => '19', 'valor' => 'TONACATEPEQUE', 'cod_departamento' => '05'],
            ['id' => 93, 'codigo_m' => '01', 'valor' => 'ANTIGUO CUSCATLÁN', 'cod_departamento' => '06'],
            ['id' => 94, 'codigo_m' => '02', 'valor' => 'CHILTUPÁN', 'cod_departamento' => '06'],
            ['id' => 95, 'codigo_m' => '03', 'valor' => 'CIUDAD ARCE', 'cod_departamento' => '06'],
            ['id' => 96, 'codigo_m' => '04', 'valor' => 'COLÓN', 'cod_departamento' => '06'],
            ['id' => 97, 'codigo_m' => '05', 'valor' => 'COMASAGUA', 'cod_departamento' => '06'],
            ['id' => 98, 'codigo_m' => '06', 'valor' => 'HUIZÚCAR', 'cod_departamento' => '06'],
            ['id' => 99, 'codigo_m' => '07', 'valor' => 'JAYAQUE', 'cod_departamento' => '06'],
            ['id' => 100, 'codigo_m' => '08', 'valor' => 'JICALAPA', 'cod_departamento' => '06'],
            ['id' => 101, 'codigo_m' => '09', 'valor' => 'LA LIBERTAD', 'cod_departamento' => '06'],
            ['id' => 102, 'codigo_m' => '10', 'valor' => 'NUEVO CUSCATLÁN', 'cod_departamento' => '06'],
            ['id' => 103, 'codigo_m' => '11', 'valor' => 'QUEZALTEPEQUE', 'cod_departamento' => '06'],
            ['id' => 104, 'codigo_m' => '12', 'valor' => 'SACACOYO', 'cod_departamento' => '06'],
            ['id' => 105, 'codigo_m' => '13', 'valor' => 'SAN JOSÉ VILLANUEVA', 'cod_departamento' => '06'],
            ['id' => 106, 'codigo_m' => '14', 'valor' => 'SAN JUAN OPICO', 'cod_departamento' => '06'],
            ['id' => 107, 'codigo_m' => '15', 'valor' => 'TAMANIQUE', 'cod_departamento' => '06'],
            ['id' => 108, 'codigo_m' => '16', 'valor' => 'TALNIQUE', 'cod_departamento' => '06'],
            ['id' => 109, 'codigo_m' => '17', 'valor' => 'TEOTEPEQUE', 'cod_departamento' => '06'],
            ['id' => 110, 'codigo_m' => '18', 'valor' => 'TEPECOYO', 'cod_departamento' => '06'],
            ['id' => 111, 'codigo_m' => '19', 'valor' => 'ZARAGOZA', 'cod_departamento' => '06'],
            ['id' => 112, 'codigo_m' => '01', 'valor' => 'CANGREJERA', 'cod_departamento' => '07'],
            ['id' => 113, 'codigo_m' => '02', 'valor' => 'CHILTIUPÁN', 'cod_departamento' => '07'],
            ['id' => 114, 'codigo_m' => '03', 'valor' => 'JULUPARQUE', 'cod_departamento' => '07'],
            ['id' => 115, 'codigo_m' => '04', 'valor' => 'METAPÁN', 'cod_departamento' => '07'],
            ['id' => 116, 'codigo_m' => '05', 'valor' => 'NUEVO PARAÍSO', 'cod_departamento' => '07'],
            ['id' => 117, 'codigo_m' => '06', 'valor' => 'SAN ISIDRO', 'cod_departamento' => '07'],
            ['id' => 118, 'codigo_m' => '07', 'valor' => 'SANTA ANA', 'cod_departamento' => '07'],
            ['id' => 119, 'codigo_m' => '08', 'valor' => 'SANTA BÁRBARA', 'cod_departamento' => '07'],
            ['id' => 120, 'codigo_m' => '09', 'valor' => 'SAN FRANCISCO JAVIER', 'cod_departamento' => '07'],
            ['id' => 121, 'codigo_m' => '10', 'valor' => 'SAN SEBASTIÁN SALITRILLO', 'cod_departamento' => '07'],
            ['id' => 122, 'codigo_m' => '11', 'valor' => 'SANTIAGO DE LA FRONTERA', 'cod_departamento' => '07'],
            ['id' => 123, 'codigo_m' => '12', 'valor' => 'TEXISTEPEQUE', 'cod_departamento' => '07'],
            ['id' => 124, 'codigo_m' => '13', 'valor' => 'EL CARMEN', 'cod_departamento' => '07'],
            ['id' => 125, 'codigo_m' => '14', 'valor' => 'LAS CRUCITAS', 'cod_departamento' => '07'],
            ['id' => 126, 'codigo_m' => '15', 'valor' => 'NUEVA ESPERANZA', 'cod_departamento' => '07'],
            ['id' => 127, 'codigo_m' => '16', 'valor' => 'TACUBA', 'cod_departamento' => '07'],
            ['id' => 128, 'codigo_m' => '17', 'valor' => 'TEJUTLA', 'cod_departamento' => '07'],
            ['id' => 129, 'codigo_m' => '18', 'valor' => 'TEXISTEPEQUE', 'cod_departamento' => '07'],
            ['id' => 130, 'codigo_m' => '19', 'valor' => 'ZARAGOZA', 'cod_departamento' => '07'],
            ['id' => 131, 'codigo_m' => '15', 'valor' => 'SUCHITOTO', 'cod_departamento' => '07'],
            ['id' => 132, 'codigo_m' => '16', 'valor' => 'TENANCINGO', 'cod_departamento' => '07'],
            ['id' => 133, 'codigo_m' => '01', 'valor' => 'CUYULTITÁN', 'cod_departamento' => '08'],
            ['id' => 134, 'codigo_m' => '02', 'valor' => 'EL ROSARIO', 'cod_departamento' => '08'],
            ['id' => 135, 'codigo_m' => '03', 'valor' => 'JERUSALÉN', 'cod_departamento' => '08'],
            ['id' => 136, 'codigo_m' => '04', 'valor' => 'MERCED LA CEIBA', 'cod_departamento' => '08'],
            ['id' => 137, 'codigo_m' => '05', 'valor' => 'OLOCUILTA', 'cod_departamento' => '08'],
            ['id' => 138, 'codigo_m' => '06', 'valor' => 'PARAÍSO OSORIO', 'cod_departamento' => '08'],
            ['id' => 139, 'codigo_m' => '07', 'valor' => 'SN ANT MASAHUAT', 'cod_departamento' => '08'],
            ['id' => 140, 'codigo_m' => '08', 'valor' => 'SAN EMIGDIO', 'cod_departamento' => '08'],
            ['id' => 141, 'codigo_m' => '09', 'valor' => 'SN FCO CHINAMEC', 'cod_departamento' => '08'],
            ['id' => 142, 'codigo_m' => '10', 'valor' => 'SAN J NONUALCO', 'cod_departamento' => '08'],
            ['id' => 143, 'codigo_m' => '11', 'valor' => 'SAN JUAN TALPA', 'cod_departamento' => '08'],
            ['id' => 144, 'codigo_m' => '12', 'valor' => 'SAN JUAN TEPEZONTES', 'cod_departamento' => '08'],
            ['id' => 145, 'codigo_m' => '13', 'valor' => 'SAN LUIS TALPA', 'cod_departamento' => '08'],
            ['id' => 146, 'codigo_m' => '14', 'valor' => 'SAN MIGUEL TEPEZONTES', 'cod_departamento' => '08'],
            ['id' => 147, 'codigo_m' => '15', 'valor' => 'SAN PEDRO MASAHUAT', 'cod_departamento' => '08'],
            ['id' => 148, 'codigo_m' => '16', 'valor' => 'SAN PEDRO NONUALCO', 'cod_departamento' => '08'],
            ['id' => 149, 'codigo_m' => '17', 'valor' => 'SAN R OBRAJUELO', 'cod_departamento' => '08'],
            ['id' => 150, 'codigo_m' => '18', 'valor' => 'STA MA OSTUMA', 'cod_departamento' => '08'],
            ['id' => 151, 'codigo_m' => '19', 'valor' => 'STGO NONUALCO', 'cod_departamento' => '08'],
            ['id' => 152, 'codigo_m' => '20', 'valor' => 'TAPALHUACA', 'cod_departamento' => '08'],
            ['id' => 153, 'codigo_m' => '21', 'valor' => 'ZACATECOLUCA', 'cod_departamento' => '08'],
            ['id' => 154, 'codigo_m' => '22', 'valor' => 'SN LUIS LA HERR', 'cod_departamento' => '08'],
            ['id' => 155, 'codigo_m' => '01', 'valor' => 'CINQUERA', 'cod_departamento' => '09'],
            ['id' => 156, 'codigo_m' => '02', 'valor' => 'GUACOTECTI', 'cod_departamento' => '09'],
            ['id' => 157, 'codigo_m' => '03', 'valor' => 'ILOBASCO', 'cod_departamento' => '09'],
            ['id' => 158, 'codigo_m' => '04', 'valor' => 'JUTIAPA', 'cod_departamento' => '09'],
            ['id' => 159, 'codigo_m' => '05', 'valor' => 'SAN ISIDRO', 'cod_departamento' => '09'],
            ['id' => 160, 'codigo_m' => '06', 'valor' => 'SENSUNTEPEQUE', 'cod_departamento' => '09'],
            ['id' => 161, 'codigo_m' => '07', 'valor' => 'TEJUTEPEQUE', 'cod_departamento' => '09'],
            ['id' => 162, 'codigo_m' => '08', 'valor' => 'VICTORIA', 'cod_departamento' => '09'],
            ['id' => 163, 'codigo_m' => '09', 'valor' => 'DOLORES', 'cod_departamento' => '09'],
            ['id' => 164, 'codigo_m' => '01', 'valor' => 'APASTEPEQUE', 'cod_departamento' => '10'],
            ['id' => 165, 'codigo_m' => '02', 'valor' => 'GUADALUPE', 'cod_departamento' => '10'],
            ['id' => 166, 'codigo_m' => '03', 'valor' => 'SAN CAY ISTEPEQ', 'cod_departamento' => '10'],
            ['id' => 167, 'codigo_m' => '04', 'valor' => 'SANTA CLARA', 'cod_departamento' => '10'],
            ['id' => 168, 'codigo_m' => '05', 'valor' => 'SANTO DOMINGO', 'cod_departamento' => '10'],
            ['id' => 169, 'codigo_m' => '06', 'valor' => 'SN EST CATARINA', 'cod_departamento' => '10'],
            ['id' => 170, 'codigo_m' => '07', 'valor' => 'SAN ILDEFONSO', 'cod_departamento' => '10'],
            ['id' => 171, 'codigo_m' => '08', 'valor' => 'SAN LORENZO', 'cod_departamento' => '10'],
            ['id' => 172, 'codigo_m' => '09', 'valor' => 'SAN SEBASTIÁN', 'cod_departamento' => '10'],
            ['id' => 173, 'codigo_m' => '10', 'valor' => 'SAN VICENTE', 'cod_departamento' => '10'],
            ['id' => 174, 'codigo_m' => '11', 'valor' => 'TECOLUCA', 'cod_departamento' => '10'],
            ['id' => 175, 'codigo_m' => '12', 'valor' => 'TEPETITÁN', 'cod_departamento' => '10'],
            ['id' => 176, 'codigo_m' => '13', 'valor' => 'VERAPAZ', 'cod_departamento' => '10'],
            ['id' => 177, 'codigo_m' => '01', 'valor' => 'ALEGRÍA', 'cod_departamento' => '11'],
            ['id' => 178, 'codigo_m' => '02', 'valor' => 'BERLÍN', 'cod_departamento' => '11'],
            ['id' => 179, 'codigo_m' => '03', 'valor' => 'CALIFORNIA', 'cod_departamento' => '11'],
            ['id' => 180, 'codigo_m' => '04', 'valor' => 'CONCEP BATRES', 'cod_departamento' => '11'],
            ['id' => 181, 'codigo_m' => '05', 'valor' => 'EL TRIUNFO', 'cod_departamento' => '11'],
            ['id' => 182, 'codigo_m' => '06', 'valor' => 'EREGUAYQUÍN', 'cod_departamento' => '11'],
            ['id' => 183, 'codigo_m' => '07', 'valor' => 'ESTANZUELAS', 'cod_departamento' => '11'],
            ['id' => 184, 'codigo_m' => '08', 'valor' => 'JIQUILISCO', 'cod_departamento' => '11'],
            ['id' => 185, 'codigo_m' => '09', 'valor' => 'JUCUAPA', 'cod_departamento' => '11'],
            ['id' => 186, 'codigo_m' => '10', 'valor' => 'JUCUARÁN', 'cod_departamento' => '11'],
            ['id' => 187, 'codigo_m' => '11', 'valor' => 'MERCEDES UMAÑA', 'cod_departamento' => '11'],
            ['id' => 188, 'codigo_m' => '12', 'valor' => 'NUEVA GRANADA', 'cod_departamento' => '11'],
            ['id' => 189, 'codigo_m' => '13', 'valor' => 'OZATLÁN', 'cod_departamento' => '11'],
            ['id' => 190, 'codigo_m' => '14', 'valor' => 'PTO EL TRIUNFO', 'cod_departamento' => '11'],
            ['id' => 191, 'codigo_m' => '15', 'valor' => 'SAN AGUSTÍN', 'cod_departamento' => '11'],
            ['id' => 192, 'codigo_m' => '16', 'valor' => 'SN BUENAVENTURA', 'cod_departamento' => '11'],
            ['id' => 193, 'codigo_m' => '17', 'valor' => 'SAN DIONISIO', 'cod_departamento' => '11'],
            ['id' => 194, 'codigo_m' => '18', 'valor' => 'SANTA ELENA', 'cod_departamento' => '11'],
            ['id' => 195, 'codigo_m' => '19', 'valor' => 'SAN FCO JAVIER', 'cod_departamento' => '11'],
            ['id' => 196, 'codigo_m' => '20', 'valor' => 'SANTA MARÍA', 'cod_departamento' => '11'],
            ['id' => 197, 'codigo_m' => '21', 'valor' => 'STGO DE MARÍA', 'cod_departamento' => '11'],
            ['id' => 198, 'codigo_m' => '22', 'valor' => 'TECAPÁN', 'cod_departamento' => '11'],
            ['id' => 199, 'codigo_m' => '23', 'valor' => 'USULUTÁN', 'cod_departamento' => '11'],
            ['id' => 200, 'codigo_m' => '01', 'valor' => 'CAROLINA', 'cod_departamento' => '12'],
            ['id' => 201, 'codigo_m' => '02', 'valor' => 'CIUDAD BARRIOS', 'cod_departamento' => '12'],
            ['id' => 202, 'codigo_m' => '03', 'valor' => 'COMACARÁN', 'cod_departamento' => '12'],
            ['id' => 203, 'codigo_m' => '04', 'valor' => 'CHAPELTIQUE', 'cod_departamento' => '12'],
            ['id' => 204, 'codigo_m' => '05', 'valor' => 'CHINAMECA', 'cod_departamento' => '12'],
            ['id' => 205, 'codigo_m' => '06', 'valor' => 'CHIRILAGUA', 'cod_departamento' => '12'],
            ['id' => 206, 'codigo_m' => '07', 'valor' => 'EL TRANSITO', 'cod_departamento' => '12'],
            ['id' => 207, 'codigo_m' => '08', 'valor' => 'LOLOTIQUE', 'cod_departamento' => '12'],
            ['id' => 208, 'codigo_m' => '09', 'valor' => 'MONCAGUA', 'cod_departamento' => '12'],
            ['id' => 209, 'codigo_m' => '10', 'valor' => 'NUEVA GUADALUPE', 'cod_departamento' => '12'],
            ['id' => 210, 'codigo_m' => '11', 'valor' => 'NVO EDÉN S JUAN', 'cod_departamento' => '12'],
            ['id' => 211, 'codigo_m' => '12', 'valor' => 'QUELEPA', 'cod_departamento' => '12'],
            ['id' => 212, 'codigo_m' => '13', 'valor' => 'SAN ANT D MOSCO', 'cod_departamento' => '12'],
            ['id' => 213, 'codigo_m' => '14', 'valor' => 'SAN GERARDO', 'cod_departamento' => '12'],
            ['id' => 214, 'codigo_m' => '15', 'valor' => 'SAN JORGE', 'cod_departamento' => '12'],
            ['id' => 215, 'codigo_m' => '16', 'valor' => 'SAN LUIS REINA', 'cod_departamento' => '12'],
            ['id' => 216, 'codigo_m' => '17', 'valor' => 'SAN MIGUEL', 'cod_departamento' => '12'],
            ['id' => 217, 'codigo_m' => '18', 'valor' => 'SAN RAF ORIENTE', 'cod_departamento' => '12'],
            ['id' => 218, 'codigo_m' => '19', 'valor' => 'SESORI', 'cod_departamento' => '12'],
            ['id' => 219, 'codigo_m' => '20', 'valor' => 'ULUAZAPA', 'cod_departamento' => '12'],
            ['id' => 220, 'codigo_m' => '01', 'valor' => 'ARAMBALA', 'cod_departamento' => '13'],
            ['id' => 221, 'codigo_m' => '02', 'valor' => 'CACAOPERA', 'cod_departamento' => '13'],
            ['id' => 222, 'codigo_m' => '03', 'valor' => 'CORINTO', 'cod_departamento' => '13'],
            ['id' => 223, 'codigo_m' => '04', 'valor' => 'CHILANGA', 'cod_departamento' => '13'],
            ['id' => 224, 'codigo_m' => '05', 'valor' => 'DELIC DE CONCEP', 'cod_departamento' => '13'],
            ['id' => 225, 'codigo_m' => '06', 'valor' => 'EL DIVISADERO', 'cod_departamento' => '13'],
            ['id' => 226, 'codigo_m' => '07', 'valor' => 'EL ROSARIO', 'cod_departamento' => '13'],
            ['id' => 227, 'codigo_m' => '08', 'valor' => 'GUALOCOCTI', 'cod_departamento' => '13'],
            ['id' => 228, 'codigo_m' => '09', 'valor' => 'GUATAJIAGUA', 'cod_departamento' => '13'],
            ['id' => 229, 'codigo_m' => '10', 'valor' => 'JOATECA', 'cod_departamento' => '13'],
            ['id' => 230, 'codigo_m' => '11', 'valor' => 'JOCOAITIQUE', 'cod_departamento' => '13'],
            ['id' => 231, 'codigo_m' => '12', 'valor' => 'JOCORO', 'cod_departamento' => '13'],
            ['id' => 232, 'codigo_m' => '13', 'valor' => 'LOLOTIQUILLO', 'cod_departamento' => '13'],
            ['id' => 233, 'codigo_m' => '14', 'valor' => 'MEANGUERA', 'cod_departamento' => '13'],
            ['id' => 234, 'codigo_m' => '15', 'valor' => 'OSICALA', 'cod_departamento' => '13'],
            ['id' => 235, 'codigo_m' => '16', 'valor' => 'PERQUÍN', 'cod_departamento' => '13'],
            ['id' => 236, 'codigo_m' => '17', 'valor' => 'SAN CARLOS', 'cod_departamento' => '13'],
            ['id' => 237, 'codigo_m' => '18', 'valor' => 'SAN FERNANDO', 'cod_departamento' => '13'],
            ['id' => 238, 'codigo_m' => '19', 'valor' => 'SAN FCO GOTERA', 'cod_departamento' => '13'],
            ['id' => 239, 'codigo_m' => '20', 'valor' => 'SAN ISIDRO', 'cod_departamento' => '13'],
            ['id' => 240, 'codigo_m' => '21', 'valor' => 'SAN SIMÓN', 'cod_departamento' => '13'],
            ['id' => 241, 'codigo_m' => '22', 'valor' => 'SENSEMBRA', 'cod_departamento' => '13'],
            ['id' => 242, 'codigo_m' => '23', 'valor' => 'SOCIEDAD', 'cod_departamento' => '13'],
            ['id' => 243, 'codigo_m' => '24', 'valor' => 'TOROLA', 'cod_departamento' => '13'],
            ['id' => 244, 'codigo_m' => '25', 'valor' => 'YAMABAL', 'cod_departamento' => '13'],
            ['id' => 245, 'codigo_m' => '26', 'valor' => 'YOLOAIQUÍN', 'cod_departamento' => '13'],
            ['id' => 246, 'codigo_m' => '01', 'valor' => 'ANAMOROS', 'cod_departamento' => '14'],
            ['id' => 247, 'codigo_m' => '02', 'valor' => 'BOLÍVAR', 'cod_departamento' => '14'],
            ['id' => 248, 'codigo_m' => '03', 'valor' => 'CONCEP DE OTE', 'cod_departamento' => '14'],
            ['id' => 249, 'codigo_m' => '04', 'valor' => 'CONCHAGUA', 'cod_departamento' => '14'],
            ['id' => 250, 'codigo_m' => '05', 'valor' => 'EL CARMEN', 'cod_departamento' => '14'],
            ['id' => 251, 'codigo_m' => '06', 'valor' => 'EL SAUCE', 'cod_departamento' => '14'],
            ['id' => 252, 'codigo_m' => '07', 'valor' => 'INTIPUCÁ', 'cod_departamento' => '14'],
            ['id' => 253, 'codigo_m' => '08', 'valor' => 'LA UNIÓN', 'cod_departamento' => '14'],
            ['id' => 254, 'codigo_m' => '09', 'valor' => 'LISLIQUE', 'cod_departamento' => '14'],
            ['id' => 255, 'codigo_m' => '10', 'valor' => 'MEANG DEL GOLFO', 'cod_departamento' => '14'],
            ['id' => 256, 'codigo_m' => '11', 'valor' => 'NUEVA ESPARTA', 'cod_departamento' => '14'],
            ['id' => 257, 'codigo_m' => '12', 'valor' => 'PASAQUINA', 'cod_departamento' => '14'],
            ['id' => 258, 'codigo_m' => '13', 'valor' => 'POLORÓS', 'cod_departamento' => '14'],
            ['id' => 259, 'codigo_m' => '14', 'valor' => 'SAN ALEJO', 'cod_departamento' => '14'],
            ['id' => 260, 'codigo_m' => '15', 'valor' => 'SAN JOSE', 'cod_departamento' => '14'],
            ['id' => 261, 'codigo_m' => '16', 'valor' => 'SANTA ROSA LIMA', 'cod_departamento' => '14'],
            ['id' => 262, 'codigo_m' => '17', 'valor' => 'YAYANTIQUE', 'cod_departamento' => '14'],
            ['id' => 263, 'codigo_m' => '18', 'valor' => 'YUCUAIQUÍN', 'cod_departamento' => '14']
        ]);

    }
}
