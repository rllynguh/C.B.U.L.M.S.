<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2017_10_17_023325_create_addresses_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2017_10_17_023325_create_banks_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2017_10_17_023325_create_billing_details_table',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2017_10_17_023325_create_billing_headers_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2017_10_17_023325_create_billing_items_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2017_10_17_023325_create_billing_notices_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2017_10_17_023325_create_billing_penalties_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2017_10_17_023325_create_building_types_table',
                'batch' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2017_10_17_023325_create_buildings_table',
                'batch' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'migration' => '2017_10_17_023325_create_business_type_requirements_table',
                'batch' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'migration' => '2017_10_17_023325_create_business_types_table',
                'batch' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'migration' => '2017_10_17_023325_create_cities_table',
                'batch' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'migration' => '2017_10_17_023325_create_contents_table',
                'batch' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'migration' => '2017_10_17_023325_create_contract_contents_table',
                'batch' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'migration' => '2017_10_17_023325_create_contract_details_table',
                'batch' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'migration' => '2017_10_17_023325_create_contract_extends_table',
                'batch' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'migration' => '2017_10_17_023325_create_contract_headers_table',
                'batch' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'migration' => '2017_10_17_023325_create_contract_terminations_table',
                'batch' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'migration' => '2017_10_17_023325_create_current_contract_penalties_table',
                'batch' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'migration' => '2017_10_17_023325_create_current_contracts_table',
                'batch' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'migration' => '2017_10_17_023325_create_dated_checks_table',
                'batch' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'migration' => '2017_10_17_023325_create_floors_table',
                'batch' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'migration' => '2017_10_17_023325_create_fund_transfers_table',
                'batch' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'migration' => '2017_10_17_023325_create_market_rates_table',
                'batch' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'migration' => '2017_10_17_023325_create_message_receivers_table',
                'batch' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'migration' => '2017_10_17_023325_create_message_senders_table',
                'batch' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'migration' => '2017_10_17_023325_create_move_in_details_table',
                'batch' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'migration' => '2017_10_17_023325_create_move_in_headers_table',
                'batch' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'migration' => '2017_10_17_023325_create_notifications_table',
                'batch' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'migration' => '2017_10_17_023325_create_offer_sheet_details_table',
                'batch' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'migration' => '2017_10_17_023325_create_offer_sheet_headers_table',
                'batch' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'migration' => '2017_10_17_023325_create_park_areas_table',
                'batch' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'migration' => '2017_10_17_023325_create_park_rates_table',
                'batch' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'migration' => '2017_10_17_023325_create_park_spaces_table',
                'batch' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'migration' => '2017_10_17_023325_create_payments_table',
                'batch' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'migration' => '2017_10_17_023325_create_penalties_table',
                'batch' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'migration' => '2017_10_17_023325_create_post_dated_checks_table',
                'batch' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'migration' => '2017_10_17_023325_create_provinces_table',
                'batch' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'migration' => '2017_10_17_023325_create_registration_details_table',
                'batch' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'migration' => '2017_10_17_023325_create_registration_headers_table',
                'batch' => 1,
            ),
            40 => 
            array (
                'id' => 41,
                'migration' => '2017_10_17_023325_create_registration_requirements_table',
                'batch' => 1,
            ),
            41 => 
            array (
                'id' => 42,
                'migration' => '2017_10_17_023325_create_representative_positions_table',
                'batch' => 1,
            ),
            42 => 
            array (
                'id' => 43,
                'migration' => '2017_10_17_023325_create_representatives_table',
                'batch' => 1,
            ),
            43 => 
            array (
                'id' => 44,
                'migration' => '2017_10_17_023325_create_requirements_table',
                'batch' => 1,
            ),
            44 => 
            array (
                'id' => 45,
                'migration' => '2017_10_17_023325_create_size_ranges_table',
                'batch' => 1,
            ),
            45 => 
            array (
                'id' => 46,
                'migration' => '2017_10_17_023325_create_tenants_table',
                'batch' => 1,
            ),
            46 => 
            array (
                'id' => 47,
                'migration' => '2017_10_17_023325_create_unit_prices_table',
                'batch' => 1,
            ),
            47 => 
            array (
                'id' => 48,
                'migration' => '2017_10_17_023325_create_units_table',
                'batch' => 1,
            ),
            48 => 
            array (
                'id' => 49,
                'migration' => '2017_10_17_023325_create_user_balances_table',
                'batch' => 1,
            ),
            49 => 
            array (
                'id' => 50,
                'migration' => '2017_10_17_023325_create_users_table',
                'batch' => 1,
            ),
            50 => 
            array (
                'id' => 51,
                'migration' => '2017_10_17_023325_create_utilities_table',
                'batch' => 1,
            ),
            51 => 
            array (
                'id' => 52,
                'migration' => '2017_10_17_023332_create_amendment_forfeit_table',
                'batch' => 1,
            ),
            52 => 
            array (
                'id' => 53,
                'migration' => '2017_10_17_023332_create_amendment_table',
                'batch' => 1,
            ),
            53 => 
            array (
                'id' => 54,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_addresses_table',
                'batch' => 1,
            ),
            54 => 
            array (
                'id' => 55,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_billing_details_table',
                'batch' => 1,
            ),
            55 => 
            array (
                'id' => 56,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_billing_headers_table',
                'batch' => 1,
            ),
            56 => 
            array (
                'id' => 57,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_billing_notices_table',
                'batch' => 1,
            ),
            57 => 
            array (
                'id' => 58,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_billing_penalties_table',
                'batch' => 1,
            ),
            58 => 
            array (
                'id' => 59,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_buildings_table',
                'batch' => 1,
            ),
            59 => 
            array (
                'id' => 60,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_business_type_requirements_table',
                'batch' => 1,
            ),
            60 => 
            array (
                'id' => 61,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_cities_table',
                'batch' => 1,
            ),
            61 => 
            array (
                'id' => 62,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_contract_contents_table',
                'batch' => 1,
            ),
            62 => 
            array (
                'id' => 63,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_contract_details_table',
                'batch' => 1,
            ),
            63 => 
            array (
                'id' => 64,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_contract_extends_table',
                'batch' => 1,
            ),
            64 => 
            array (
                'id' => 65,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_contract_headers_table',
                'batch' => 1,
            ),
            65 => 
            array (
                'id' => 66,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_contract_terminations_table',
                'batch' => 1,
            ),
            66 => 
            array (
                'id' => 67,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_current_contract_penalties_table',
                'batch' => 1,
            ),
            67 => 
            array (
                'id' => 68,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_current_contracts_table',
                'batch' => 1,
            ),
            68 => 
            array (
                'id' => 69,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_dated_checks_table',
                'batch' => 1,
            ),
            69 => 
            array (
                'id' => 70,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_floors_table',
                'batch' => 1,
            ),
            70 => 
            array (
                'id' => 71,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_fund_transfers_table',
                'batch' => 1,
            ),
            71 => 
            array (
                'id' => 72,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_market_rates_table',
                'batch' => 1,
            ),
            72 => 
            array (
                'id' => 73,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_message_receivers_table',
                'batch' => 1,
            ),
            73 => 
            array (
                'id' => 74,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_message_senders_table',
                'batch' => 1,
            ),
            74 => 
            array (
                'id' => 75,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_move_in_details_table',
                'batch' => 1,
            ),
            75 => 
            array (
                'id' => 76,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_notifications_table',
                'batch' => 1,
            ),
            76 => 
            array (
                'id' => 77,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_offer_sheet_details_table',
                'batch' => 1,
            ),
            77 => 
            array (
                'id' => 78,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_offer_sheet_headers_table',
                'batch' => 1,
            ),
            78 => 
            array (
                'id' => 79,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_park_areas_table',
                'batch' => 1,
            ),
            79 => 
            array (
                'id' => 80,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_park_rates_table',
                'batch' => 1,
            ),
            80 => 
            array (
                'id' => 81,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_park_spaces_table',
                'batch' => 1,
            ),
            81 => 
            array (
                'id' => 82,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_payments_table',
                'batch' => 1,
            ),
            82 => 
            array (
                'id' => 83,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_post_dated_checks_table',
                'batch' => 1,
            ),
            83 => 
            array (
                'id' => 84,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_registration_details_table',
                'batch' => 1,
            ),
            84 => 
            array (
                'id' => 85,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_registration_headers_table',
                'batch' => 1,
            ),
            85 => 
            array (
                'id' => 86,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_registration_requirements_table',
                'batch' => 1,
            ),
            86 => 
            array (
                'id' => 87,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_representatives_table',
                'batch' => 1,
            ),
            87 => 
            array (
                'id' => 88,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_tenants_table',
                'batch' => 1,
            ),
            88 => 
            array (
                'id' => 89,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_unit_prices_table',
                'batch' => 1,
            ),
            89 => 
            array (
                'id' => 90,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_units_table',
                'batch' => 1,
            ),
            90 => 
            array (
                'id' => 91,
                'migration' => '2017_10_17_023333_add_foreign_keys_to_user_balances_table',
                'batch' => 1,
            ),
            91 => 
            array (
                'id' => 92,
                'migration' => '2017_10_20_001718_create_extension_request_table',
                'batch' => 1,
            ),
            92 => 
            array (
                'id' => 93,
                'migration' => '2017_12_20_021036_add_foreign_keys_to_amendment_forfeit_table',
                'batch' => 1,
            ),
            93 => 
            array (
                'id' => 94,
                'migration' => '2017_12_20_021036_add_foreign_keys_to_amendment_table',
                'batch' => 1,
            ),
        ));
        
        
    }
}