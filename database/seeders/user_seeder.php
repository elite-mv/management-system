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
                'company_id' => 3,
            ],
            [
                'email' => 'jocelyn@eliteacesinc.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 2,
                'name' => 'MS. JOCELYN COMPOTO',
                'company_id' => 1,
            ],
            [
                'email' => 'test@bookkeeper.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 2,
                'name' => 'MX. BOOK KEEPER',
                'company_id' => 1,
            ],
            [
                'email' => 'test@accountant.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 3,
                'name' => '[ DEVELOPER ]',
                'company_id' => 1,
            ],
            [
                'email' => 'test@finance.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 4,
                'name' => 'MX. FINANCE',
                'company_id' => 1,
            ],
            [
                'email' => 'test@president.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 5,
                'name' => '[ DEVELOPER ]',
                'company_id' => 1,
            ],
            [
                'email' => 'test@auditor.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 6,
                'name' => 'MX. AUDITOR',
                'company_id' => 1,
            ],
            [
                'email' => 'test@regular.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 7,
                'name' => 'MX. SAMPLE TESTERs',
                'company_id' => 1,
            ],
            [
                'email' => 'cristina@eliteacesinc.com',
                'password' => bcrypt('mahalkositina'),
                'role_id' => 7,
                'name' => 'MS. MA. CRISTINA RAMA',
                'company_id' => 1,
            ],
            [
                'email' => 'bookkeeper@gtiarmoredcars.com',
                'password' => bcrypt('12345678'),
                'role_id' => 2,
                'name' => 'MX. BOOK KEEPER',
                'company_id' => 1,
            ],
            [
                'email' => 'auditor@gtiarmoredcars.com',
                'password' => bcrypt('12345678'),
                'role_id' => 6,
                'name' => 'AUDITOR-KAEFER',
                'company_id' => 1,
            ],
            [
                'email' => 'finance@gtiarmoredcars.com',
                'password' => bcrypt('MandirigmA192023'),
                'role_id' => 4,
                'name' => 'MS. RICHELLE ALINGAROG',
                'company_id' => 1,
            ],
            [
                'email' => 'rylan@gtiarmoredcars.com',
                'password' => bcrypt('12345678'),
                'role_id' => 5,
                'name' => 'RCA',
                'company_id' => 1,
            ],
            [
                'email' => 'gti.richelle@gmail.com',
                'password' => bcrypt('GtI12345678'),
                'role_id' => 4,
                'name' => 'MS. RICHELLE ALINGAROG',
                'company_id' => 1,
            ],
            [
                'email' => 'jess@bsarmor.com',
                'password' => bcrypt('BSAqazws'),
                'role_id' => 7,
                'name' => 'MR. JESSIE MORALES',
                'company_id' => 1,
            ],
            [
                'email' => 'ria.tobias@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MS. RIA TOBIAS',
                'company_id' => 1,
            ],
            [
                'email' => 'ria.deleon@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MS. RIA DE LEON',
                'company_id' => 1,
            ],
            [
                'email' => 'anne.deleon@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MS. ANNE DE LEON',
                'company_id' => 1,
            ],
            [
                'email' => 'albert.cabangis@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MR. ALBERT CABANGIS',
                'company_id' => 1,
            ],
            [
                'email' => 'john.domasig@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazws'),
                'role_id' => 7,
                'name' => 'MR. JOHN DOMASIG',
                'company_id' => 1,
            ],
            [
                'email' => 'fhaye.saguid@gtiarmoredcars.com',
                'password' => bcrypt('Adminfhaye253254'),
                'role_id' => 7,
                'name' => 'MS. FHAYE SAGUID',
                'company_id' => 1,
            ],
            [
                'email' => 'joanna.amarant@gtiarmoredcars.com',
                'password' => bcrypt('mahalkosiliyazia'),
                'role_id' => 7,
                'name' => 'MS. JOANNA AMARANTE',
                'company_id' => 1,
            ],
            [
                'email' => 'april@eliteacesinc.com',
                'password' => bcrypt('AJM0420*'),
                'role_id' => 7,
                'name' => 'MS. APRIL JANE MAGTANGOB',
                'company_id' => 1,
            ],
            [
                'email' => 'dave@eliteacesinc.com',
                'password' => bcrypt('ELITEqazws'),
                'role_id' => 7,
                'name' => 'MR. DAVID STEVENSON TACORDA',
                'company_id' => 1,
            ],
            [
                'email' => 'bert@eliteacesinc.com',
                'password' => bcrypt('ELITEqazws'),
                'role_id' => 7,
                'name' => 'MR. ROBERTO NUÑEZ',
                'company_id' => 1,
            ],
            [
                'email' => 'nathan@ambulanceph.com',
                'password' => bcrypt('SOTERIAqazws'),
                'role_id' => 7,
                'name' => 'MR. NATHAN GUNGON',
                'company_id' => 1,
            ],
            [
                'email' => 'rose.dargo@guntech.ph',
                'password' => bcrypt('P@ssw0rd12345'),
                'role_id' => 7,
                'name' => 'MS. ROSE DARGO',
                'company_id' => 1,
            ],
            [
                'email' => 'mica@guntech.ph',
                'password' => bcrypt('GUNTECHqazws'),
                'role_id' => 7,
                'name' => 'Ms. Rhodora Michaela M. Flores',
                'company_id' => 1,
            ],
            [
                'email' => 'belle.eliteacestradinginc@gmail.com',
                'password' => bcrypt('Kenzumi281223'),
                'role_id' => 7,
                'name' => 'Belle Dijamco',
                'company_id' => 1,
            ],
            [
                'email' => 'khex@gtiarmoredcars.com',
                'password' => bcrypt('Adminria2539847'),
                'role_id' => 7,
                'name' => 'MS. KHEX TOBIAS',
                'company_id' => 1,
            ],
            [
                'email' => 'sweet@gtiarmoredcars.com',
                'password' => bcrypt('sweets121505'),
                'role_id' => 7,
                'name' => 'MS. SWEET DE LEON',
                'company_id' => 1,
            ],
            [
                'email' => 'tabuk@gtiarmoredcars.com',
                'password' => bcrypt('GTIqazwsT1'),
                'role_id' => 7,
                'name' => 'MR. ALBERT CABANGIS',
                'company_id' => 1,
            ],
            [
                'email' => 'ariel@accountant.com',
                'password' => bcrypt('qazws123'),
                'role_id' => 3,
                'name' => 'MR. AURELIO CRUZIN',
                'company_id' => 1,
            ]
        ]);
    }
}
