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
        $this->call(UnitPricesTableSeeder::class);
        $this->call(ParkAreasTableSeeder::class);
        $this->call(ParkSpacesTableSeeder::class);
        $this->call(MarketRatesTableSeeder::class);
        $this->call(BusinessTypeRequirementsTableSeeder::class);
        $this->call(TenantsTableSeeder::class);
        $this->call(RegistrationHeadersTableSeeder::class);
        $this->call(RegistrationDetailsTableSeeder::class);
        $this->call(RegistrationRequirementsTableSeeder::class);
        $this->call(UtilitiesTableSeeder::class);
        $this->call(RequirementsTableSeeder::class);
        $this->call(RepresentativesTableSeeder::class);
        $this->call(ContentsTableSeeder::class);
        $this->call(BillingItemsTableSeeder::class);
        $this->call(BillingHeadersTableSeeder::class);
        $this->call(BillingDetailsTableSeeder::class);
        $this->call(ContractHeadersTableSeeder::class);     
        $this->call(ContractContentsTableSeeder::class);
        $this->call(ContractDetailsTableSeeder::class);
        $this->call(CurrentContractsTableSeeder::class);
        $this->call(OfferSheetHeadersTableSeeder::class);
        $this->call(OfferSheetDetailsTableSeeder::class);
        $this->call(PenaltiesTableSeeder::class);
        $this->call(AmendmentTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
