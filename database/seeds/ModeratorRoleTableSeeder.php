<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeratorRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moderator_role')->insert([
            'link' => 'moderator.dashboard',
            'name' => 'الصفحة الرئيسية',//1
            'code' => 1

        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.review.money',
            'name' => 'تأكيد العمولات المالية',//2
            'code' => 2

        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.cities',
            'name' => 'عرض المدن',//3
            'code' => 3
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.cities.store',
            'name' => 'اضافة مدينة جديدة',//4
            'code' => 4
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.cities.update',
            'name' => 'تحديث بيانات المدينة',//5
            'code' => 5
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.cities.delete',
            'name' => 'حذف مدينة',//6
            'code' => 6
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.category',
            'name' => 'عرض الاقسام الرئيسية',//7
            'code' => 7
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.category.store',
            'name' => 'اضافة قسم رئيسي',//8
            'code' => 8
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.category.update',
            'name' => 'تحديث قسم رئيسي',//9
            'code' => 9
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.category.delete',
            'name' => 'حذف قسم رئيسي',//10
            'code' => 10
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.sub_category',
            'name' => 'عرض الاقسام الفرعية',//11
            'code' => 11
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.sub_category.store',
            'name' => 'اضافة قسم فرعي',//12
            'code' => 12
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.sub_category.update',
            'name' => 'تحديث قسم فرعي',//13
            'code' => 13
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.category.deleteSubCategory',
            'name' => 'حذف قسم فرعي', //14
            'code' => 14
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.membership',
            'name' => 'عرض العضويات', //15
            'code' => 15
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.membership.store',
            'name' => 'اضافة عضوية جديدة', //16
            'code' => 16
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.membership.edit',
            'name' => 'تعديل عضوية',  //17
            'code' => 17
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.membership.update',
            'name' => 'تحديث بيانات العضوية', //18
            'code' => 18
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.membership.delete',
            'name' => 'حذف العضوية', //19
            'code' => 19
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertisers',
            'name' => 'عرض المعلنين', //20
            'code' => 20
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertiser.search',
            'name' => 'البحث عن معلن ', //21
            'code' => 21
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertisers.store',
            'name' => 'اضافة معلن جديد', //22
            'code' => 22
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertisers.update',
            'name' => 'تحديث بيانات المعلن',//23
            'code' => 23
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertisers.updateMembership',
            'name' => 'تحديث عضوية المعلن ', //24
            'code' => 24
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertisers.delete',
            'name' => 'حذف معلن ', //25
            'code' => 25
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.gifts',
            'name' => 'عرض الهدايا ', //26
            'code' => 26
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.gifts.store',
            'name' => 'اضافة هدية جديدة ', //27
            'code' => 27
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.gifts.update',
            'name' => 'تحديث بيانات الهدايا', //28
            'code' => 28
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.gifts.updateMembership',
            'name' => 'تحديث العضوية للهدية ',//29
            'code' => 29
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.gifts.updateAvailable',
            'name' => 'تحديث توافر الهدية ', //30
            'code' => 30
        ]);



        DB::table('moderator_role')->insert([
            'link' => 'moderator.gifts.updateMembership',
            'name' => 'تحديث العضوية للهدية ',//31
            'code' => 31
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.gifts.delete',
            'name' => 'حذف الهدية ', //32
            'code' => 32
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.replace_gifts',
            'name' => 'طلبات الهدايا ',//33
            'code' => 33
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.replace_gifts.update',
            'name' => 'الموافقة على طلبات الهدايا ', //34
            'code' => 34
        ]);



        DB::table('moderator_role')->insert([
            'link' => 'moderator.packages',
            'name' => 'عرض باقات الاشتراك',//35
            'code' => 35
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.packages.store',
            'name' => 'اضافة باقة جديدة ', //36
            'code' => 36
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.packages.update',
            'name' => 'تحديث الباقات ',//37
            'code' => 37
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.packages.delete',
            'name' => 'حذف باقة اشتراك', //38
            'code' => 38
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.moderators',
            'name' => 'عرض المشرفين',//39
            'code' => 39
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.moderators.store',
            'name' => 'اضافة مشرف جديد ', //40
            'code' => 40
        ]);



        DB::table('moderator_role')->insert([
            'link' => 'moderator.moderators.edit',
            'name' => 'تعديل بيانات المشرف ',//41
            'code' => 41
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.add.role',
            'name' => 'اضافة صلاحيات المشرف', //42
            'code' => 42
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.update.role',
            'name' => 'تحديث صلاحيات المشرف  ',//43
            'code' => 43
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.moderators.update',
            'name' => 'تحديث بيانات المشرف  ',//44
            'code' => 44
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.moderators.delete',
            'name' => 'حذف  المشرف  ',//45
            'code' => 45
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.amrtidall',
            'name' => 'عرض النقاط', //46
            'code' => 46
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.amrtidall.store',
            'name' => 'اضافة نقاط جديدة', //47
            'code' => 47
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.amrtidall.update',
            'name' => 'تحديث النقاط ', //48
            'code' => 48
        ]);



        DB::table('moderator_role')->insert([
            'link' => 'moderator.amrtidall.pdf',
            'name' => 'تصدير النقاط لملف pdf', // 49
            'code' => 49
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.sliders',
            'name' => 'عرض السلايدر', //50
            'code' => 50
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.sliders.store',
            'name' => 'اضافة سلايدر جديد ', //51
            'code' => 51
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.sliders.update',
            'name' => 'تحديث السلايدر ', //52
            'code' => 52
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.sliders.delete',
            'name' => 'حذف السلايدر ', //53
            'code' => 53
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages',
            'name' => 'عرض الصفحات الثابتة ', //54
            'code' => 54
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.about_us',
            'name' => 'تفاصيل حول الموقع', //55
            'code' => 55
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.site_treaty',
            'name' => 'معاهدة الموقع ', //56
            'code' => 56
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.terms_conditions',
            'name' => 'الاحكام و الشروط', //57
            'code' => 57
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.social',
            'name' => 'بيانات السوشيل', //58
            'code' => 58
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.socialUpdate',
            'name' => 'تحديث بيانات السوشيل ', //59
            'code' => 59
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.store',
            'name' => 'اضافة نص جديد فى الصفحات  الثابتة ', //60
            'code' => 60
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.update',
            'name' => 'تحديث نص  فى الصفحات  الثابتة ', //61
            'code' => 61
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.know-right',
            'name' => 'اعرف حقك ', //62
            'code' => 62
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.know-right.store',
            'name' => 'اضافة حق جديد ', //63
            'code' => 63
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.know-right.update',
            'name' => 'تحديث بيانات حق', //64
            'code' => 64
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.delete',
            'name' => 'حذف نص  من الصفحات  الثابتة ', //65
            'code' => 65
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertising',
            'name' => 'عرض الاقسام و اعلانات الاقسام', //66
            'code' => 66
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertise',
            'name' => 'عرض  بيانات الاعلان', //67
            'code' => 67
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertise.save_status',
            'name' => 'تحديث حالة الاعلان', //68
            'code' => 68
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertising.all',
            'name' => 'عرض جميع اعلانات الاقسام', //69
            'code' => 69
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertising.mainFixed',
            'name' => 'عرض اعلانات القسم المثبتة', //70
            'code' => 70
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertising.finish',
            'name' => 'عرض اعلانات القسم المنتتهية ', //71
            'code' => 71
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertising',
            'name' => 'عرض اعلانات الاقسام', //72
            'code' => 72
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertising.new',
            'name' => 'عرض اعلانات القسم بانتظار التفعيل', //73
            'code' => 73
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertising.accept',
            'name' => 'عرض اعلانات القسم المفعلة', //74
            'code' => 74
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.advertising.delete',
            'name' => 'حذف اعلان ', //75
            'code' => 75
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.abuse',
            'name' => 'عرض  الاساءات ', //76
            'code' => 76
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.abuseAnswer',
            'name' => ' الرد على الاساءة ', //77
            'code' => 77
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.contact-us',
            'name' => 'عرض رسائل التواصل معنا ', //78
            'code' => 78
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.contactAnswer',
            'name' => 'الرد على رسائل التواصل معنا', //79
            'code' => 79
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.consultations',
            'name' => ' عرض طلبات الاستشارة ', //80
            'code' => 80
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.consultationsAnswer',
            'name' => ' الرد على طلبات الاستشارة ', //81
            'code' => 81
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.black_list',
            'name' => 'عرض  القائمة السوداء ', //82
            'code' => 82
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.black_list.store',
            'name' => 'اضافة الى  القائمة السوداء ', //83
            'code' => 83
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.black_list.delete',
            'name' => 'الحذف من القائمة السوادء', //84
            'code' => 84
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.points.active',
            'name' => 'تفعيل /الغاء تفعيل النقاط', //85
            'code' => 85
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.charts',
            'name' => 'الاحصائيات', //86
            'code' => 86
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.commission',
            'name' => 'العمولات ', //87
            'code' => 87
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.commission.update',
            'name' => 'تحديث العمولات ', //88
            'code' => 88
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.commission.accept',
            'name' => 'رفض العمولات ', //89
            'code' => 89
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.subscription.show',
            'name' => ' طلبات الاشتراك ', //90
            'code' => 90
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.package.addAdvertiser',
            'name' => ' قبول الاشتراكات ', //91
            'code' => 91
        ]);


        DB::table('moderator_role')->insert([
            'link' => 'moderator.pages.amrtidall',
            'name' => ' امر تدلل ', //92
            'code' => 92
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.reports',
            'name' => '  التقارير ', //93
            'code' => 93
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.messages',
            'name' => '  ارسال الرسائل الترويجية ', //94
            'code' => 94
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.updatePoints',
            'name' => '    اضافة نقاط للمعلن ', //95
            'code' => 95
        ]);

        DB::table('moderator_role')->insert([
            'link' => 'moderator.Sponsored',
            'name' => '      الاعلانات الممولة ', //96
            'code' => 96
        ]);
    }
}
