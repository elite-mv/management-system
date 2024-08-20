<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([


            [
                'email' => 'mhelvoi@eliteacesinc.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 1,
                'name' => '[DEVELOPER]',
            ],
            [
                'email' => 'jocelyn@eliteacesinc.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 2,
                'name' => 'MS. JOCELYN COMPOTO',
            ],
            [
                'email' => 'test@bookkeeper.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 2,
                'name' => 'MX. BOOK KEEPER',
            ],
            [
                'email' => 'test@accountant.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 3,
                'name' => '[ DEVELOPER ]',
            ],
            [
                'email' => 'test@finance.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 4,
                'name' => 'MX. FINANCE',
            ],
            [
                'email' => 'test@president.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 5,
                'name' => '[ DEVELOPER ]',
            ],
            [
                'email' => 'test@auditor.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 6,
                'name' => 'MX. AUDITOR',
            ],
            [
                'email' => 'test@regular.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 7,
                'name' => 'MX. SAMPLE TESTERs',
            ],
            [
                'email' => 'cristina@eliteacesinc.com',
                'password' => bcrypt('mahalkositina'),
                'role_id' => 7,
                'name' => 'MS. MA. CRISTINA RAMA',
            ],
            [
                'email' => 'bookkeeper@gtiarmoredcars.com',
                'password' => bcrypt('12345678'),
                'role_id' => 2,
                'name' => 'MX. BOOK KEEPER',
            ],
            [
                'email' => 'auditor@gtiarmoredcars.com',
                'password' => bcrypt('12345678'),
                'role_id' => 6,
                'name' => 'AUDITOR-KAEFER',
            ],
            [
                'email' => 'finance@gtiarmoredcars.com',
                'password' => bcrypt('MandirigmA192023'),
                'role_id' => 4,
                'name' => 'MS. RICHELLE ALINGAROG',
            ],
            [
                'email' => 'rylan@gtiarmoredcars.com',
                'password' => bcrypt('12345678'),
                'role_id' => 5,
                'name' => 'RCA',
            ],
            [
                'email' => 'gti.richelle@gmail.com',
                'password' => bcrypt('GtI12345678'),
                'role_id' => 4,
                'name' => 'MS. RICHELLE ALINGAROG',
            ],
            [
                'email' => 'jess@bsarmor.com',
                'password' => bcrypt('BSAqazws'),
                'role_id' => 7,
                'name' => 'MR. JESSIE MORALES',
            ],
            [
                'email' => 'ria.tobias@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MS. RIA TOBIAS',
            ],
            [
                'email' => 'ria.deleon@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MS. RIA DE LEON',
            ],
            [
                'email' => 'anne.deleon@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MS. ANNE DE LEON',
            ],
            [
                'email' => 'albert.cabangis@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MR. ALBERT CABANGIS',
            ],
            [
                'email' => 'john.domasig@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MR. JOHN DOMASIG',
            ],
            [
                'email' => 'fhaye.saguid@gtiarmoredcars.com',
                'password' => bcrypt('Adminfhaye253254'),
                'role_id' => 7,
                'name' => 'MS. FHAYE SAGUID',
            ],
            [
                'email' => 'joanna.amarant@gtiarmoredcars.com',
                'password' => bcrypt('mahalkosiliyazia'),
                'role_id' => 7,
                'name' => 'MS. JOANNA AMARANTE',
            ],
            [
                'email' => 'april@eliteacesinc.com',
                'password' => bcrypt('AJM0420*'),
                'role_id' => 7,
                'name' => 'MS. APRIL JANE MAGTANGOB',
            ],
            [
                'email' => 'dave@eliteacesinc.com',
                'password' => bcrypt('ELITEqazws'),
                'role_id' => 7,
                'name' => 'MR. DAVID STEVENSON TACORDA',
            ],
            [
                'email' => 'bert@eliteacesinc.com',
                'password' => bcrypt('ELITEqazws'),
                'role_id' => 7,
                'name' => 'MR. ROBERTO NUÑEZ',
            ],
            [
                'email' => 'nathan@ambulanceph.com',
                'password' => bcrypt('SOTERIAqazws'),
                'role_id' => 7,
                'name' => 'MR. NATHAN GUNGON',
            ],
            [
                'email' => 'rose.dargo@guntech.ph',
                'password' => bcrypt('P@ssw0rd12345'),
                'role_id' => 7,
                'name' => 'MS. ROSE DARGO',
            ],
            [
                'email' => 'mica@guntech.ph',
                'password' => bcrypt('GUNTECHqazws'),
                'role_id' => 7,
                'name' => 'Ms. Rhodora Michaela M. Flores',
            ],
            [
                'email' => 'belle.eliteacestradinginc@gmail.com',
                'password' => bcrypt('Kenzumi281223'),
                'role_id' => 7,
                'name' => 'Belle Dijamco',
            ],
            [
                'email' => 'khex@gtiarmoredcars.com',
                'password' => bcrypt('Adminria2539847'),
                'role_id' => 7,
                'name' => 'MS. KHEX TOBIAS',
            ],
            [
                'email' => 'sweet@gtiarmoredcars.com',
                'password' => bcrypt('sweets121505'),
                'role_id' => 7,
                'name' => 'MS. SWEET DE LEON',
            ],
            [
                'email' => 'tabuk@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazwsT1'),
                'role_id' => 7,
                'name' => 'MR. ALBERT CABANGIS',
            ],
            [
                'email' => 'ariel@accountant.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 3,
                'name' => 'MR. AURELIO CRUZIN',
            ]
                ]);
    }
}
