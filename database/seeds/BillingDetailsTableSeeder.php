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
            50 => 
            array (
                'id' => 51,
                'billing_header_id' => 25,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 355.2,
                'status' => 0,
            ),
            51 => 
            array (
                'id' => 52,
                'billing_header_id' => 25,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 25088.0,
                'status' => 0,
            ),
            52 => 
            array (
                'id' => 105,
                'billing_header_id' => 51,
                'billing_item_id' => 2,
            'description' => 'The advance rent payment. Worth 3 month(s).',
                'price' => 66600.0,
                'status' => 0,
            ),
            53 => 
            array (
                'id' => 106,
                'billing_header_id' => 51,
                'billing_item_id' => 3,
            'description' => 'The security deposit. Worth 3 month(s) Base Rent.',
                'price' => 37800.0,
                'status' => 0,
            ),
            54 => 
            array (
                'id' => 107,
                'billing_header_id' => 51,
                'billing_item_id' => 6,
                'description' => '100 / sqm exclusive of vat',
                'price' => 22400.0,
                'status' => 0,
            ),
            55 => 
            array (
                'id' => 108,
                'billing_header_id' => 51,
                'billing_item_id' => 7,
            'description' => 'Fit out Deposit. 1 month(s) rent',
                'price' => 22200.0,
                'status' => 0,
            ),
            56 => 
            array (
                'id' => 109,
                'billing_header_id' => 52,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            57 => 
            array (
                'id' => 110,
                'billing_header_id' => 52,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            58 => 
            array (
                'id' => 111,
                'billing_header_id' => 53,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            59 => 
            array (
                'id' => 112,
                'billing_header_id' => 53,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            60 => 
            array (
                'id' => 113,
                'billing_header_id' => 54,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            61 => 
            array (
                'id' => 114,
                'billing_header_id' => 54,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            62 => 
            array (
                'id' => 115,
                'billing_header_id' => 55,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            63 => 
            array (
                'id' => 116,
                'billing_header_id' => 55,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            64 => 
            array (
                'id' => 117,
                'billing_header_id' => 56,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            65 => 
            array (
                'id' => 118,
                'billing_header_id' => 56,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            66 => 
            array (
                'id' => 119,
                'billing_header_id' => 57,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            67 => 
            array (
                'id' => 120,
                'billing_header_id' => 57,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            68 => 
            array (
                'id' => 121,
                'billing_header_id' => 58,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            69 => 
            array (
                'id' => 122,
                'billing_header_id' => 58,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            70 => 
            array (
                'id' => 123,
                'billing_header_id' => 59,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            71 => 
            array (
                'id' => 124,
                'billing_header_id' => 59,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            72 => 
            array (
                'id' => 125,
                'billing_header_id' => 60,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            73 => 
            array (
                'id' => 126,
                'billing_header_id' => 60,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            74 => 
            array (
                'id' => 127,
                'billing_header_id' => 61,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            75 => 
            array (
                'id' => 128,
                'billing_header_id' => 61,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            76 => 
            array (
                'id' => 129,
                'billing_header_id' => 62,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            77 => 
            array (
                'id' => 130,
                'billing_header_id' => 62,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            78 => 
            array (
                'id' => 131,
                'billing_header_id' => 63,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 22200.0,
                'status' => 0,
            ),
            79 => 
            array (
                'id' => 132,
                'billing_header_id' => 63,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            80 => 
            array (
                'id' => 133,
                'billing_header_id' => 64,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            81 => 
            array (
                'id' => 134,
                'billing_header_id' => 64,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            82 => 
            array (
                'id' => 135,
                'billing_header_id' => 65,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            83 => 
            array (
                'id' => 136,
                'billing_header_id' => 65,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            84 => 
            array (
                'id' => 137,
                'billing_header_id' => 66,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            85 => 
            array (
                'id' => 138,
                'billing_header_id' => 66,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            86 => 
            array (
                'id' => 139,
                'billing_header_id' => 67,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            87 => 
            array (
                'id' => 140,
                'billing_header_id' => 67,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            88 => 
            array (
                'id' => 141,
                'billing_header_id' => 68,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            89 => 
            array (
                'id' => 142,
                'billing_header_id' => 68,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            90 => 
            array (
                'id' => 143,
                'billing_header_id' => 69,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            91 => 
            array (
                'id' => 144,
                'billing_header_id' => 69,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            92 => 
            array (
                'id' => 145,
                'billing_header_id' => 70,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            93 => 
            array (
                'id' => 146,
                'billing_header_id' => 70,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            94 => 
            array (
                'id' => 147,
                'billing_header_id' => 71,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            95 => 
            array (
                'id' => 148,
                'billing_header_id' => 71,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            96 => 
            array (
                'id' => 149,
                'billing_header_id' => 72,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            97 => 
            array (
                'id' => 150,
                'billing_header_id' => 72,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            98 => 
            array (
                'id' => 151,
                'billing_header_id' => 73,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            99 => 
            array (
                'id' => 152,
                'billing_header_id' => 73,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            100 => 
            array (
                'id' => 153,
                'billing_header_id' => 74,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            101 => 
            array (
                'id' => 154,
                'billing_header_id' => 74,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
            102 => 
            array (
                'id' => 155,
                'billing_header_id' => 75,
                'billing_item_id' => 1,
                'description' => 'The net rent value.',
                'price' => 222.0,
                'status' => 0,
            ),
            103 => 
            array (
                'id' => 156,
                'billing_header_id' => 75,
                'billing_item_id' => 4,
                'description' => '80 /sqm, plus VAT less 2% withholding tax, per month',
                'price' => 15680.0,
                'status' => 0,
            ),
        ));
        
        
    }
}