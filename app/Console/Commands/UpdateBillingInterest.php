<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserBalance;
use Carbon\Carbon;
use Config;
use DB;
use App\BillingHeader;
use App\BillingDetail;
use App\Http\Controllers\smartCounter;
use Auth;
use App\BillingPenalty;
use App\Notification;

class UpdateBillingInterest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing_interest:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Database for billing interest';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
      $utilities=DB::table('utilities')
      ->whereRaw('date_as_of=(Select Max(date_as_of) from utilities)')
      ->select('utilities.*')
      ->first();
      $percent=$utilities->delayed_interest;
        $gap=$utilities->for_interest_days; //gap before start ng increment;
        $contracts=DB::TABLE('billing_headers')
        ->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
        ->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->HAVINGRAW("billing_headers.cost>SUM(payments.payment) and gap>$gap")
        ->GROUPBY('billing_headers.id')
        ->SELECT(DB::RAW('DATEDIFF(CURRENT_DATE(),billing_headers.date_issued) as gap,(billing_headers.cost-SUM(payments.payment)) as amount_due,billing_headers.cost,payments.payment,current_contract_id,billing_headers.id,COUNT(payments.id),tenants.user_id'))
        ->GET();
        foreach ($contracts as $contract) {
            // code...
          $rent_query=DB::TABLE('billing_items')
          ->JOIN('billing_details','billing_items.id','billing_details.billing_item_id')
          ->WHERE('billing_header_id',$contract->id)
          ->SELECT('billing_header_id')
          ->GET();
          if(!is_null($rent_query)) 
          {  
            $billing_penalty=DB::TABLE('billing_penalties')
            ->SELECT(DB::RAW('DATEDIFF(CURRENT_DATE(),date_as_of) as gap,id'))
            ->WHERE('billing_header_id',$contract->id)
            ->FIRST();
            if((!is_null($billing_penalty)&& $billing_penalty->gap>0)||is_null($billing_penalty))
            {

              $penalty=DB::table('billing_items')
              ->select('id')
              ->where('description','Penalty')
              ->first()->id
              ;
              $penalty_id=DB::table('penalties')
              ->select('id')
              ->where('description','Unable to pay on time')
              ->first()->id
              ;
                      if(!is_null($billing_penalty)&& $billing_penalty->gap>0) //update existing billing detail and billing penalty
                      {
                        $billpenalty=BillingPenalty::FINDORFAIL($billing_penalty->id);
                        $billpenalty->date_as_of=Carbon::now();
                        $billpenalty->save();
                        $billing_detail=DB::TABLE('billing_details')
                        ->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
                        ->JOIN('billing_headers','billing_details.billing_header_id','billing_headers.id')
                        ->WHERE('current_contract_id',$contract->current_contract_id)
                        ->WHERE('billing_items.description','Penalty')
                        ->SELECT('billing_details.id')
                        ->ORDERBY('billing_details.id','desc')
                        ->FIRST()->id;
                        $additional=($percent/100)*$contract->amount_due;
                        $detail= BillingDetail::FINDORFAIL($billing_detail);
                        $detail->price=$detail->price + $additional;
                        $detail->description="An additional $percent per day for the delay of payment for ($gap) days";
                        $detail->save();
                        $notification=new Notification();
                        $notification->user_id=$contract->user_id;
                        $notification->title="You have received a penalty.";
                        $notification->description="Your account must be settled in order to remove the interest.";
                        $notification->link='Sampolink';
                        $notification->date_issued=Carbon::now();
                        $notification->save();
                      }
                      else
                      {
                        $latest=DB::table("billing_headers")
                        ->select("billing_headers.*")
                        ->orderBy('code',"DESC")
                        ->first();

                        $code="BILL001";
                        if(!is_null($latest))
                          $code=$latest->code;

                        $sc= new smartCounter();

                        $code=$sc->increment($code);
                        $final_gap=$contract->gap-$gap;
                        $amount_due=$contract->amount_due;
                        for($x=0;$x<$final_gap;$x++)
                        {
                          $amount_due+=($contract->amount_due*($percent/100));
                        }


                        $billing_header=new BillingHeader();
                        $billing_header->code=$code;
                        $billing_header->current_contract_id=$contract->current_contract_id;
                        $billing_header->date_issued=Carbon::now();
                        $billing_header->cost=$contract->cost;
                        $billing_header->user_id=Auth::user()->id;
                        $billing_header->save();
                        $billing_detail=new BillingDetail();
                        $billing_detail->billing_header_id=$billing_header->id;
                        $billing_detail->billing_item_id=$penalty;
                        $billing_detail->description="Penalty for not paying rent";
                        $billing_detail->price=$amount_due;
                        $billing_detail->save();


                        $billpenalty=new BillingPenalty;
                        $billpenalty->date_as_of=Carbon::now();
                        $billpenalty->billing_header_id=$contract->id;
                        $billpenalty->penalty_id=$penalty_id;
                        $billpenalty->save();   

                        $notification=new Notification();
                        $notification->user_id=$contract->user_id;
                        $notification->title="You have received a penalty.";
                        $notification->description="Your account must be settled in order to remove the interest.";
                        $notification->link='Sampolink';
                        $notification->date_issued=Carbon::now();
                        $notification->save();
                      }
                    }
                  }
                }
              }
            }



