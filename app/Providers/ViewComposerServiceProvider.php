<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use DB;
use Carbon\Carbon;
use Config;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeCoreLayout();
        $this->composeDashboard();
        $this->composeTenantLayout();
        $this->composeTenantLayout();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    private function composeCoreLayout()
    {
        view()->composer('layout.coreLayout', function($view) {
            $list=DB::TABLE('notifications')
            ->WHERE('user_id',Auth::user()->id)
            ->SELECT('id','title','description','link','date_issued')
            ->WHERE('is_read',0)
            ->GET();
            $count=DB::TABLE('notifications')
            ->WHERE('user_id',Auth::user()->id)
            ->WHERE('is_read',0)
            ->COUNT('id')
            ;

            foreach ($list as $element) {
                # code...
                $myDate=new Carbon($element->date_issued);
                $element->date_issued=$element->date_issued;
            }
            $notification = (object)['count' =>$count, 'list' => $list];
            $user = Auth::user();
            $view->withUser($user)
            ->withNotification($notification);
        });
        
        
    }
    private function composeDashboard()
    {
        view()->composer('user.admin.dashboard', function($view) {
            $registration=DB::TABLE('registration_headers')
            ->WHERE('status',0)
            ->COUNT();
            $unit=DB::TABLE('units')
            ->WHERERAW('id not in (SELECT unit_id from contract_details inner join current_contracts on contract_details.current_contract_id=current_contracts.id where current_contracts.status =1)')
            ->COUNT();
            $tenant=DB::TABLE('tenants')
            ->JOIN('registration_headers','tenants.id','registration_headers.tenant_id')
            ->JOIN('contract_headers','registration_headers.id','contract_headers.registration_header_id')
            ->JOIN('current_contracts','contract_headers.id','current_contracts.contract_header_id')
            ->GROUPBY('tenants.id')
            ->WHERE('current_contracts.status',1)
            ->COUNT();
            $billing=DB::TABLE('billing_headers')
            ->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
            ->HAVINGRAW('SUM(COALESCE(payments.payment,0))<billing_headers.cost')
            ->GROUPBY('billing_headers.id')
            ->SELECT('billing_headers.cost','payments.payment',DB::RAW('count(billing_headers.id) as count'))->FIRST();
            if(is_null($billing))
                $billing=0;
            else
                $billing=$billing->count;
            $average_market_rate=DB::table("cities")
            ->leftJoin("market_rates","cities.id","market_rates.city_id")
            ->groupBy("cities.id")
            ->whereRaw("market_rates.date_as_of=(SELECT MAX(date_as_of) from market_rates where city_id=cities.id) or isnull(market_rates.date_as_of)")
            ->AVG(DB::RAW('COALESCE(market_rates.rate,0)'));
            $average_market_rate="₱ ".number_format($average_market_rate,2)."/sqm";

            $tenantlist=DB::TABLE('tenants')
            ->JOIN('business_types','tenants.business_type_id','business_types.id')
            ->JOIN('registration_headers','tenants.id','registration_headers.tenant_id')
            ->WHERE('registration_headers.status',1)
            ->ORDERBY('registration_headers.id','desc')
            ->LIMIT(5)
            ->GROUPBY('tenants.id')
            ->SELECT('tenants.description as tenant','business_types.description as business')
            ->GET()
            ;

            $unitlist=DB::TABLE('buildings')
            ->JOIN('floors','buildings.id','floors.building_id')
            ->JOIN('units','floors.id','units.floor_id')
            ->JOIN('offer_sheet_details','units.id','offer_sheet_details.unit_id')
            ->GROUPBY('units.id')
            ->SELECT('buildings.description as building','units.code as unit')
            ->LIMIT(5)
            ->GET();

            $collectionlist=DB::TABLE('billing_headers')
            ->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
            ->HAVINGRAW('cost >SUM(COALESCE(payment,0))')
            ->GROUPBY('billing_headers.id')
            ->SELECT('cost','payment','billing_headers.code','billing_headers.date_issued','billing_headers.code')
            ->LIMIT(5)
            ->GET()
            ;
            foreach ($collectionlist as $collection) {
                # code...
                $collection->date_issued=new Carbon($collection->date_issued);
                $collection->date_issued=Carbon::now()->diffForHumans($collection->date_issued);
            }
            $list=(object)['tenant'=>$tenantlist,'unit'=>$unitlist,'collection'=>$collectionlist];
            $count=(object)['registration'=>$registration,'unit'=>$unit,'tenant'=>$tenant,'billing'=>$billing];
            $view->withCount($count)
            ->withAverage($average_market_rate)
            ->withList($list)
            ;

        });
    }
    private function composeTenantLayout(){
        view()->composer('layouts.tenantLayout', function($view) {
            $list=DB::TABLE('notifications')
            ->WHERE('user_id',Auth::user()->id)
            ->SELECT('id','title','description','link','date_issued')
            ->orderBy('is_read','desc')
            ->orderBy('notifications.id','desc')
            ->GET();
            $count=DB::TABLE('notifications')
            ->WHERE('user_id',Auth::user()->id)
            ->WHERE('is_read',0)
            ->COUNT('id')
            ;
            foreach ($list as $element) {
                $myDate=new Carbon($element->date_issued);
                $element->date_issued=$element->date_issued;
            }
            $notification = (object)['count' =>$count, 'list' => $list];
            $view->with("notification",$notification);
        });
    }
    private function composeTenantDashboard(){
        view()->composer('tenant.index', function($view) {
            $list=DB::TABLE('notifications')
            ->WHERE('user_id',Auth::user()->id)
            ->SELECT('id','title','description','link','date_issued')
            ->WHERE('is_urgent',1)
            ->GET();
            foreach ($list as $element) {
                # code...
                $myDate=new Carbon($element->date_issued);
                $element->date_issued=$myDate;
            }
            $user = Auth::user();
            $view->with('urgent',$list);
        });
    }
}
