<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Eloquent::unguard();
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	$this->call(UsersTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(BuildingTypesTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
        $this->call(FloorsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(SizeRangesTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);
        $this->call(RepresentativePositionsTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
