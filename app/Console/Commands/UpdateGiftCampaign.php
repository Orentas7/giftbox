<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\GiftCampaign;

class UpdateGiftCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'giftCampaign:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates giftCampaigns dispatch, delivery date';

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
     * @return int
     */
    public function handle()
    {
        $giftCampaigns = GiftCampaign::where('dispatch_date', '<', Carbon::today())->get();
        foreach($giftCampaigns as $giftCampaign){            
            $giftCampaign->update(['campaign_status_id' => 3]);
        };
        $giftCampaigns = GiftCampaign::where('delivery_date', '<', Carbon::today())->get();
        foreach($giftCampaigns as $giftCampaign){
            $giftCampaign->update(['campaign_status_id' => 4]);
        };
        $this->info('Success');
    }
}
