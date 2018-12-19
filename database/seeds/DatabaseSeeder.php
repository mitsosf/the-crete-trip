<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call('EventTableSeeder');
        $this->command->info('Seeded the event!');

        $this->call('SectionsTableSeeder');
        $this->command->info('Seeded the countries!');

        $this->call('CountriesTableSeeder');
        $this->command->info('Seeded the countries!');

        $this->call('RolesTableSeeder');
        $this->command->info('Seeded the roles!');
    }
}

class EventTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('event')->delete();

        $attributes = array(
            array(
                'attribute' => 'fee',
                'value' => '0'

            ),
            array(
                'attribute' => 'boat',
                'value' => '0'

            ),
            array(
                'attribute' => 'reducedfee',
                'value' => '0'

            ),
            array(
                'attribute' => 'maxBeds',
                'value' => '0'

            ),
            array(
                'attribute' => 'rooming',
                'value' => '0'

            ),
        );

        DB::table('event')->insert($attributes);
    }
}

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('roles')->delete();

        $roles = array(
            array('name' => 'Participant'),
            array('name' => 'LC'),
            array('name' => 'OC'),
        );

        DB::table('roles')->insert($roles);
    }
}

class SectionsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('sections')->delete();

        $sections = array(
            array('name' => 'ESN ATEITH', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'ATEITH'),
            array('name' => 'ESN AUA ATHENS', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'AUA'),
            array('name' => 'ESN AUTH', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'AUTH'),
            array('name' => 'ESN AEGEAN', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'AEGEAN'),
            array('name' => 'ESN ATHENS AUEB', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'AUEB'),
            array('name' => 'ESN DUTH', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'DUTH'),
            array('name' => 'ESN HARO', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'HARO'),
            array('name' => 'ESN IOANNINA', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'IOANNINA'),
            array('name' => 'ESN KAPA ATHENS', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'KAPA'),
            array('name' => 'ESN LARISSA', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'LARISSA'),
            array('name' => 'ESN NTUA ATHENS', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'NTUA'),
            array('name' => 'ESN PANTEION', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'PANTEION'),
            array('name' => 'ESN TEI ATHENS', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'TATH'),
            array('name' => 'ESN TEI OF CRETE', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'TOC'),
            array('name' => 'ESN TEI OF PIRAEUS', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'TEIPIR'),
            array('name' => 'ESN TEI OF WESTERN MACEDONIA', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'TEIWM'),
            array('name' => 'ESN TUC', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'TUC'),
            array('name' => 'ESN TEISTE', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'TEISTE'),
            array('name' => 'ESN UOC', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'UOC'),
            array('name' => 'ESN UOM THESSALONIKI', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'UOM'),
            array('name' => 'ESN UOPA', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'UOPA'),
            array('name' => 'ESN UNIPI', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'UNIPI'),
            array('name' => 'ESN CYPRUS', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'CYPRUS'),
            array('name' => 'No ESN Section', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'NOSECTION'),
            array('name' => 'International Guests (ESNers)', 'reference' => 'TCT' . substr(Carbon::now()->year, 2, 2) . 'GUESTS'),
        );

        DB::table('sections')->insert($sections);
    }
}

class CountriesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('countries')->delete();

        $countries = array(
            array('code' => 'AF', 'name' => 'Afghanistan'),
            array('code' => 'AL', 'name' => 'Albania'),
            array('code' => 'DZ', 'name' => 'Algeria'),
            array('code' => 'AS', 'name' => 'American Samoa'),
            array('code' => 'AD', 'name' => 'Andorra'),
            array('code' => 'AO', 'name' => 'Angola'),
            array('code' => 'AI', 'name' => 'Anguilla'),
            array('code' => 'AQ', 'name' => 'Antarctica'),
            array('code' => 'AG', 'name' => 'Antigua and/or Barbuda'),
            array('code' => 'AR', 'name' => 'Argentina'),
            array('code' => 'AM', 'name' => 'Armenia'),
            array('code' => 'AW', 'name' => 'Aruba'),
            array('code' => 'AU', 'name' => 'Australia'),
            array('code' => 'AT', 'name' => 'Austria'),
            array('code' => 'AZ', 'name' => 'Azerbaijan'),
            array('code' => 'BS', 'name' => 'Bahamas'),
            array('code' => 'BH', 'name' => 'Bahrain'),
            array('code' => 'BD', 'name' => 'Bangladesh'),
            array('code' => 'BB', 'name' => 'Barbados'),
            array('code' => 'BY', 'name' => 'Belarus'),
            array('code' => 'BE', 'name' => 'Belgium'),
            array('code' => 'BZ', 'name' => 'Belize'),
            array('code' => 'BJ', 'name' => 'Benin'),
            array('code' => 'BM', 'name' => 'Bermuda'),
            array('code' => 'BT', 'name' => 'Bhutan'),
            array('code' => 'BO', 'name' => 'Bolivia'),
            array('code' => 'BA', 'name' => 'Bosnia and Herzegovina'),
            array('code' => 'BW', 'name' => 'Botswana'),
            array('code' => 'BV', 'name' => 'Bouvet Island'),
            array('code' => 'BR', 'name' => 'Brazil'),
            array('code' => 'IO', 'name' => 'British lndian Ocean Territory'),
            array('code' => 'BN', 'name' => 'Brunei Darussalam'),
            array('code' => 'BG', 'name' => 'Bulgaria'),
            array('code' => 'BF', 'name' => 'Burkina Faso'),
            array('code' => 'BI', 'name' => 'Burundi'),
            array('code' => 'KH', 'name' => 'Cambodia'),
            array('code' => 'CM', 'name' => 'Cameroon'),
            array('code' => 'CA', 'name' => 'Canada'),
            array('code' => 'CV', 'name' => 'Cape Verde'),
            array('code' => 'KY', 'name' => 'Cayman Islands'),
            array('code' => 'CF', 'name' => 'Central African Republic'),
            array('code' => 'TD', 'name' => 'Chad'),
            array('code' => 'CL', 'name' => 'Chile'),
            array('code' => 'CN', 'name' => 'China'),
            array('code' => 'CX', 'name' => 'Christmas Island'),
            array('code' => 'CC', 'name' => 'Cocos (Keeling) Islands'),
            array('code' => 'CO', 'name' => 'Colombia'),
            array('code' => 'KM', 'name' => 'Comoros'),
            array('code' => 'CG', 'name' => 'Congo'),
            array('code' => 'CK', 'name' => 'Cook Islands'),
            array('code' => 'CR', 'name' => 'Costa Rica'),
            array('code' => 'HR', 'name' => 'Croatia (Hrvatska)'),
            array('code' => 'CU', 'name' => 'Cuba'),
            array('code' => 'CY', 'name' => 'Cyprus'),
            array('code' => 'CZ', 'name' => 'Czech Republic'),
            array('code' => 'CD', 'name' => 'Democratic Republic of Congo'),
            array('code' => 'DK', 'name' => 'Denmark'),
            array('code' => 'DJ', 'name' => 'Djibouti'),
            array('code' => 'DM', 'name' => 'Dominica'),
            array('code' => 'DO', 'name' => 'Dominican Republic'),
            array('code' => 'TP', 'name' => 'East Timor'),
            array('code' => 'EC', 'name' => 'Ecudaor'),
            array('code' => 'EG', 'name' => 'Egypt'),
            array('code' => 'SV', 'name' => 'El Salvador'),
            array('code' => 'GQ', 'name' => 'Equatorial Guinea'),
            array('code' => 'ER', 'name' => 'Eritrea'),
            array('code' => 'EE', 'name' => 'Estonia'),
            array('code' => 'ET', 'name' => 'Ethiopia'),
            array('code' => 'FK', 'name' => 'Falkland Islands (Malvinas)'),
            array('code' => 'FO', 'name' => 'Faroe Islands'),
            array('code' => 'FJ', 'name' => 'Fiji'),
            array('code' => 'FI', 'name' => 'Finland'),
            array('code' => 'FR', 'name' => 'France'),
            array('code' => 'FX', 'name' => 'France, Metropolitan'),
            array('code' => 'GF', 'name' => 'French Guiana'),
            array('code' => 'PF', 'name' => 'French Polynesia'),
            array('code' => 'TF', 'name' => 'French Southern Territories'),
            array('code' => 'MK', 'name' => 'FYROM'),
            array('code' => 'GA', 'name' => 'Gabon'),
            array('code' => 'GM', 'name' => 'Gambia'),
            array('code' => 'GE', 'name' => 'Georgia'),
            array('code' => 'DE', 'name' => 'Germany'),
            array('code' => 'GH', 'name' => 'Ghana'),
            array('code' => 'GI', 'name' => 'Gibraltar'),
            array('code' => 'GR', 'name' => 'Greece'),
            array('code' => 'GL', 'name' => 'Greenland'),
            array('code' => 'GD', 'name' => 'Grenada'),
            array('code' => 'GP', 'name' => 'Guadeloupe'),
            array('code' => 'GU', 'name' => 'Guam'),
            array('code' => 'GT', 'name' => 'Guatemala'),
            array('code' => 'GN', 'name' => 'Guinea'),
            array('code' => 'GW', 'name' => 'Guinea-Bissau'),
            array('code' => 'GY', 'name' => 'Guyana'),
            array('code' => 'HT', 'name' => 'Haiti'),
            array('code' => 'HM', 'name' => 'Heard and Mc Donald Islands'),
            array('code' => 'HN', 'name' => 'Honduras'),
            array('code' => 'HK', 'name' => 'Hong Kong'),
            array('code' => 'HU', 'name' => 'Hungary'),
            array('code' => 'IS', 'name' => 'Iceland'),
            array('code' => 'IN', 'name' => 'India'),
            array('code' => 'ID', 'name' => 'Indonesia'),
            array('code' => 'IR', 'name' => 'Iran (Islamic Republic of)'),
            array('code' => 'IQ', 'name' => 'Iraq'),
            array('code' => 'IE', 'name' => 'Ireland'),
            array('code' => 'IL', 'name' => 'Israel'),
            array('code' => 'IT', 'name' => 'Italy'),
            array('code' => 'CI', 'name' => 'Ivory Coast'),
            array('code' => 'JM', 'name' => 'Jamaica'),
            array('code' => 'JP', 'name' => 'Japan'),
            array('code' => 'JO', 'name' => 'Jordan'),
            array('code' => 'KZ', 'name' => 'Kazakhstan'),
            array('code' => 'KE', 'name' => 'Kenya'),
            array('code' => 'KI', 'name' => 'Kiribati'),
            array('code' => 'KP', 'name' => 'Korea, Democratic People\'s Republic of'),
            array('code' => 'KR', 'name' => 'Korea, Republic of'),
            array('code' => 'KW', 'name' => 'Kuwait'),
            array('code' => 'KG', 'name' => 'Kyrgyzstan'),
            array('code' => 'LA', 'name' => 'Lao People\'s Democratic Republic'),
            array('code' => 'LV', 'name' => 'Latvia'),
            array('code' => 'LB', 'name' => 'Lebanon'),
            array('code' => 'LS', 'name' => 'Lesotho'),
            array('code' => 'LR', 'name' => 'Liberia'),
            array('code' => 'LY', 'name' => 'Libyan Arab Jamahiriya'),
            array('code' => 'LI', 'name' => 'Liechtenstein'),
            array('code' => 'LT', 'name' => 'Lithuania'),
            array('code' => 'LU', 'name' => 'Luxembourg'),
            array('code' => 'MO', 'name' => 'Macau'),
            array('code' => 'MG', 'name' => 'Madagascar'),
            array('code' => 'MW', 'name' => 'Malawi'),
            array('code' => 'MY', 'name' => 'Malaysia'),
            array('code' => 'MV', 'name' => 'Maldives'),
            array('code' => 'ML', 'name' => 'Mali'),
            array('code' => 'MT', 'name' => 'Malta'),
            array('code' => 'MH', 'name' => 'Marshall Islands'),
            array('code' => 'MQ', 'name' => 'Martinique'),
            array('code' => 'MR', 'name' => 'Mauritania'),
            array('code' => 'MU', 'name' => 'Mauritius'),
            array('code' => 'TY', 'name' => 'Mayotte'),
            array('code' => 'MX', 'name' => 'Mexico'),
            array('code' => 'FM', 'name' => 'Micronesia, Federated States of'),
            array('code' => 'MD', 'name' => 'Moldova, Republic of'),
            array('code' => 'MC', 'name' => 'Monaco'),
            array('code' => 'MN', 'name' => 'Mongolia'),
            array('code' => 'MS', 'name' => 'Montserrat'),
            array('code' => 'MA', 'name' => 'Morocco'),
            array('code' => 'MZ', 'name' => 'Mozambique'),
            array('code' => 'MM', 'name' => 'Myanmar'),
            array('code' => 'NA', 'name' => 'Namibia'),
            array('code' => 'NR', 'name' => 'Nauru'),
            array('code' => 'NP', 'name' => 'Nepal'),
            array('code' => 'NL', 'name' => 'Netherlands'),
            array('code' => 'AN', 'name' => 'Netherlands Antilles'),
            array('code' => 'NC', 'name' => 'New Caledonia'),
            array('code' => 'NZ', 'name' => 'New Zealand'),
            array('code' => 'NI', 'name' => 'Nicaragua'),
            array('code' => 'NE', 'name' => 'Niger'),
            array('code' => 'NG', 'name' => 'Nigeria'),
            array('code' => 'NU', 'name' => 'Niue'),
            array('code' => 'NF', 'name' => 'Norfork Island'),
            array('code' => 'MP', 'name' => 'Northern Mariana Islands'),
            array('code' => 'NO', 'name' => 'Norway'),
            array('code' => 'OM', 'name' => 'Oman'),
            array('code' => 'PK', 'name' => 'Pakistan'),
            array('code' => 'PW', 'name' => 'Palau'),
            array('code' => 'PA', 'name' => 'Panama'),
            array('code' => 'PG', 'name' => 'Papua New Guinea'),
            array('code' => 'PY', 'name' => 'Paraguay'),
            array('code' => 'PE', 'name' => 'Peru'),
            array('code' => 'PH', 'name' => 'Philippines'),
            array('code' => 'PN', 'name' => 'Pitcairn'),
            array('code' => 'PL', 'name' => 'Poland'),
            array('code' => 'PT', 'name' => 'Portugal'),
            array('code' => 'PR', 'name' => 'Puerto Rico'),
            array('code' => 'QA', 'name' => 'Qatar'),
            array('code' => 'SS', 'name' => 'Republic of South Sudan'),
            array('code' => 'RE', 'name' => 'Reunion'),
            array('code' => 'RO', 'name' => 'Romania'),
            array('code' => 'RU', 'name' => 'Russian Federation'),
            array('code' => 'RW', 'name' => 'Rwanda'),
            array('code' => 'KN', 'name' => 'Saint Kitts and Nevis'),
            array('code' => 'LC', 'name' => 'Saint Lucia'),
            array('code' => 'VC', 'name' => 'Saint Vincent and the Grenadines'),
            array('code' => 'WS', 'name' => 'Samoa'),
            array('code' => 'SM', 'name' => 'San Marino'),
            array('code' => 'ST', 'name' => 'Sao Tome and Principe'),
            array('code' => 'SA', 'name' => 'Saudi Arabia'),
            array('code' => 'SN', 'name' => 'Senegal'),
            array('code' => 'RS', 'name' => 'Serbia'),
            array('code' => 'SC', 'name' => 'Seychelles'),
            array('code' => 'SL', 'name' => 'Sierra Leone'),
            array('code' => 'SG', 'name' => 'Singapore'),
            array('code' => 'SK', 'name' => 'Slovakia'),
            array('code' => 'SI', 'name' => 'Slovenia'),
            array('code' => 'SB', 'name' => 'Solomon Islands'),
            array('code' => 'SO', 'name' => 'Somalia'),
            array('code' => 'ZA', 'name' => 'South Africa'),
            array('code' => 'GS', 'name' => 'South Georgia South Sandwich Islands'),
            array('code' => 'ES', 'name' => 'Spain'),
            array('code' => 'LK', 'name' => 'Sri Lanka'),
            array('code' => 'SH', 'name' => 'St. Helena'),
            array('code' => 'PM', 'name' => 'St. Pierre and Miquelon'),
            array('code' => 'SD', 'name' => 'Sudan'),
            array('code' => 'SR', 'name' => 'Suriname'),
            array('code' => 'SJ', 'name' => 'Svalbarn and Jan Mayen Islands'),
            array('code' => 'SZ', 'name' => 'Swaziland'),
            array('code' => 'SE', 'name' => 'Sweden'),
            array('code' => 'CH', 'name' => 'Switzerland'),
            array('code' => 'SY', 'name' => 'Syrian Arab Republic'),
            array('code' => 'TW', 'name' => 'Taiwan'),
            array('code' => 'TJ', 'name' => 'Tajikistan'),
            array('code' => 'TZ', 'name' => 'Tanzania, United Republic of'),
            array('code' => 'TH', 'name' => 'Thailand'),
            array('code' => 'TG', 'name' => 'Togo'),
            array('code' => 'TK', 'name' => 'Tokelau'),
            array('code' => 'TO', 'name' => 'Tonga'),
            array('code' => 'TT', 'name' => 'Trinidad and Tobago'),
            array('code' => 'TN', 'name' => 'Tunisia'),
            array('code' => 'TR', 'name' => 'Turkey'),
            array('code' => 'TM', 'name' => 'Turkmenistan'),
            array('code' => 'TC', 'name' => 'Turks and Caicos Islands'),
            array('code' => 'TV', 'name' => 'Tuvalu'),
            array('code' => 'UG', 'name' => 'Uganda'),
            array('code' => 'UA', 'name' => 'Ukraine'),
            array('code' => 'AE', 'name' => 'United Arab Emirates'),
            array('code' => 'GB', 'name' => 'United Kingdom'),
            array('code' => 'US', 'name' => 'United States'),
            array('code' => 'UM', 'name' => 'United States minor outlying islands'),
            array('code' => 'UY', 'name' => 'Uruguay'),
            array('code' => 'UZ', 'name' => 'Uzbekistan'),
            array('code' => 'VU', 'name' => 'Vanuatu'),
            array('code' => 'VA', 'name' => 'Vatican City State'),
            array('code' => 'VE', 'name' => 'Venezuela'),
            array('code' => 'VN', 'name' => 'Vietnam'),
            array('code' => 'VG', 'name' => 'Virgin Islands (British)'),
            array('code' => 'VI', 'name' => 'Virgin Islands (U.S.)'),
            array('code' => 'WF', 'name' => 'Wallis and Futuna Islands'),
            array('code' => 'EH', 'name' => 'Western Sahara'),
            array('code' => 'YE', 'name' => 'Yemen'),
            array('code' => 'YU', 'name' => 'Yugoslavia'),
            array('code' => 'ZR', 'name' => 'Zaire'),
            array('code' => 'ZM', 'name' => 'Zambia'),
            array('code' => 'ZW', 'name' => 'Zimbabwe'),
        );

        DB::table('countries')->insert($countries);
    }
}
