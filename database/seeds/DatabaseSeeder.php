<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(AdvertisingStatusTableSeeder::class);
        $this->call(KnowUsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(MembershipTableSeeder::class);
        $this->call(SubscriptionsPackageTableSeeder::class);
        $this->call(AdvertisersTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
        $this->call(AdvertisingTableSeeder::class);
        $this->call(GiftsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ModeratoresTableSeeder::class);
        $this->call(BlackListTableSeeder::class);
        $this->call(AdvertiserFollowersTableSeeder::class);
        $this->call(AdvertiserRatingTableSeeder::class);
        $this->call(ContactUsTableSeeder::class);
        $this->call(PointsTableSeeder::class);
        $this->call(AdvertiserFavouritesTableSeeder::class);
        $this->call(AdvertiserCodeTableSeeder::class);
        $this->call(GiftReplaceTableSeeder::class);
        $this->call(AdvertisingCommentsTableSeeder::class);
        $this->call(AdvertiserPointsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(KnowRightsTableSeeder::class);
        $this->call(ConsultationsTableSeeder::class);
        $this->call(ReportAbuseTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(MoneyTransferTableSeeder::class);
        $this->call(SocialTableSeeder::class);
        $this->call(PlanTableSeeder::class);
        $this->call(ModeratorRoleTableSeeder::class);
        $this->call(QuestionnaireTableSeeder::class);
    }
}
