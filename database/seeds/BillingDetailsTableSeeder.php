<?php

use Illuminate\Database\Seeder;

class BillingDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('billing_details')->delete();
        
        \DB::table('billing_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'billing_header_id' => 1,
                'billing_item_id' => 2,
            'description' => 'The advance rent payment. Worth 3 month(s).',
                'price' => 106560.0,
                'status' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'billing_header_id' => 1,
                'billing_item_id' => 3,
            'description' => 'The security deposit. Worth 3 month(s) Base Rent.',
                'price' => 60480.0,
                'status' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'billing_header_id' => 1,
                'billing_item_id' => 6,
                'description' => '100 / sqm exclusive of vat',
                'price' => 35840.0,
                'status' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'billing_header_id' => 1,
                'billing_item_id' => 7,
            'description' => 'Fit out Deposit. 1 month(s) rent',
                'price' => 35520.0,
                'status' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'billing_header_id' => 2,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'billing_header_id' => 2,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'billing_header_id' => 3,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'billing_header_id' => 3,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'billing_header_id' => 4,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'billing_header_id' => 4,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'billing_header_id' => 5,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'billing_header_id' => 5,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'billing_header_id' => 6,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'billing_header_id' => 6,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'billing_header_id' => 7,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'billing_header_id' => 7,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'billing_header_id' => 8,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'billing_header_id' => 8,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            18 => 
            array (
                'id' => 19,
                'billing_header_id' => 9,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'billing_header_id' => 9,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            20 => 
            array (
                'id' => 21,
                'billing_header_id' => 10,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            21 => 
            array (
                'id' => 22,
                'billing_header_id' => 10,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            22 => 
            array (
                'id' => 23,
                'billing_header_id' => 11,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            23 => 
            array (
                'id' => 24,
                'billing_header_id' => 11,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            24 => 
            array (
                'id' => 25,
                'billing_header_id' => 12,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            25 => 
            array (
                'id' => 26,
                'billing_header_id' => 12,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            26 => 
            array (
                'id' => 27,
                'billing_header_id' => 13,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 35520.0,
                'status' => 0,
            ),
            27 => 
            array (
                'id' => 28,
                'billing_header_id' => 13,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            28 => 
            array (
                'id' => 29,
                'billing_header_id' => 14,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            29 => 
            array (
                'id' => 30,
                'billing_header_id' => 14,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            30 => 
            array (
                'id' => 31,
                'billing_header_id' => 15,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            31 => 
            array (
                'id' => 32,
                'billing_header_id' => 15,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            32 => 
            array (
                'id' => 33,
                'billing_header_id' => 16,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            33 => 
            array (
                'id' => 34,
                'billing_header_id' => 16,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            34 => 
            array (
                'id' => 35,
                'billing_header_id' => 17,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            35 => 
            array (
                'id' => 36,
                'billing_header_id' => 17,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            36 => 
            array (
                'id' => 37,
                'billing_header_id' => 18,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            37 => 
            array (
                'id' => 38,
                'billing_header_id' => 18,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            38 => 
            array (
                'id' => 39,
                'billing_header_id' => 19,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            39 => 
            array (
                'id' => 40,
                'billing_header_id' => 19,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            40 => 
            array (
                'id' => 41,
                'billing_header_id' => 20,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            41 => 
            array (
                'id' => 42,
                'billing_header_id' => 20,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            42 => 
            array (
                'id' => 43,
                'billing_header_id' => 21,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            43 => 
            array (
                'id' => 44,
                'billing_header_id' => 21,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            44 => 
            array (
                'id' => 45,
                'billing_header_id' => 22,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            45 => 
            array (
                'id' => 46,
                'billing_header_id' => 22,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            46 => 
            array (
                'id' => 47,
                'billing_header_id' => 23,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            47 => 
            array (
                'id' => 48,
                'billing_header_id' => 23,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            48 => 
            array (
                'id' => 49,
                'billing_header_id' => 24,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            49 => 
            array (
                'id' => 50,
                'billing_header_id' => 24,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
        ));
        
        
    }
}