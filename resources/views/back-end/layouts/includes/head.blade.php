<style>

    .active {
        background-color: #efe817 !important;
    }
</style>

<div class="head">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <h2 class="head-title my-5">لوحة التحكم</h2>
            <img class="my-0" src="{{ asset('back-end/images/control-panel.svg')}}" alt="control-panel"
                 style="width: 40%;max-height: 150px;object-fit: contain;"/>
            <div class="row button-groups mx-auto w-100 mt-5 button-section">
                <div class="col-12 col-lg-6 d-flex justify-content-center px-0">
                    <button onclick="window.location.href='{{route('admin.dashboard')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                        الرئيسية
                    </button>
                    <button onclick="window.location.href='{{route('admin.charts')}}'" id="my-fav-ad"
                            class="my-ad btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.charts') ? 'active' : '' }}">
                        الاحصائيات
                    </button>
                    <button onclick="window.location.href='{{route('admin.category')}}'" id="my-fav-ad"
                            class="my-ad btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.category') ? 'active' : '' }}">
                        الأقسام
                    </button>
                    <button onclick="window.location.href='{{route('admin.cities')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::is('admin/cities*') ? 'active' : '' }}">
                        المدن
                    </button>
                    <button onclick="window.location.href='{{route('admin.sponsored')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::is('admin/sponsored*') ? 'active' : '' }}">
                        اعلانات ممولة
                    </button>
                    <button onclick="window.location.href='{{route('admin.gifts')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.gifts') ? 'active' : '' }}">
                        برنامج الهدايا
                    </button>
                    <button onclick="window.location.href='{{route('admin.replace_gifts')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.replace_gifts') ? 'active' : '' }}">
                        طلبات الهدايا
                    </button>


                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center px-0 button-section">
                    <button onclick="window.location.href='{{route('admin.advertisers')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.advertisers') ? 'active' : '' }}">
                        المعلنين
                    </button>
                    <button onclick="window.location.href='{{route('admin.black_list')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.black_list') ? 'active' : '' }}">
                        القائمة السوداء
                    </button>

                    <button onclick="window.location.href='{{route('admin.membership')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.membership') ? 'active' : '' }}">
                        العضويات
                    </button>
                    <button onclick="window.location.href='{{route('admin.messages')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.messages') ? 'active' : '' }}">
                        الرسائل الترويجية
                    </button>

                    <button onclick="window.location.href='{{route('admin.pages.know-right')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.pages.know-right') ? 'active' : '' }}">
                        اعرف حقك
                    </button>
                    <button onclick="window.location.href='{{route('admin.packages')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.packages') ? 'active' : '' }}">
                        الباقات
                    </button>
                    <button onclick="window.location.href='{{route('fixed.advertising')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('fixed.advertising') ? 'active' : '' }}">
                        طلبات التثبيت
                    </button>
                </div>
                <div class="col-12 col-lg-12 d-flex justify-content-center px-0 button-section">
                    <button onclick="window.location.href='{{route('admin.subscription.show')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.subscription.show') ? 'active' : '' }}">
                        طلبات الاشتراكات
                    </button>
                    <button onclick="window.location.href='{{route('admin.amrtidall')}}'" id="my-fav-ad"
                            class="my-ad btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.amrtidall') ? 'active' : '' }}">
                        امر تدلل
                    </button>
                    <button onclick="window.location.href='{{route('admin.advertising')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.advertising') ? 'active' : '' }}">
                        الاعلانات
                    </button>

                    <button onclick="window.location.href='{{route('admin.commission')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.commission') ? 'active' : '' }}">
                        العمولات
                    </button>

                    <button onclick="window.location.href='{{route('admin.sliders')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.sliders') ? 'active' : '' }} ">
                        السلايدر
                    </button>

                    <button onclick="window.location.href='{{route('admin.pages')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.pages') ? 'active' : '' }}">
                        الصفحات الثابتة
                    </button>
                    <button onclick="window.location.href='{{route('admin.moderators')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::is('admin/moderators*') ? 'active' : '' }}">
                        المشرفين
                    </button>
                    <button onclick="window.location.href='{{route('admin.abuse')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.abuse') ? 'active' : '' }}">
                        الاساءات
                    </button>
                    <button onclick="window.location.href='{{route('admin.consultations')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.consultations') ? 'active' : '' }}">
                        طلبات الاستشارة
                    </button>
                    <button onclick="window.location.href='{{route('admin.contact-us')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.contact-us') ? 'active' : '' }}">
                        تواصل معنا
                    </button>
                    <button onclick="window.location.href='{{route('admin.reports')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.reports') ? 'active' : '' }}">
                        التقارير
                    </button>
                    <button onclick="window.location.href='{{route('admin.questionnaire')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.questionnaire') ? 'active' : '' }}">
                        الاستبيان
                    </button>
                    <button onclick="window.location.href='{{route('admin.logout')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('admin.logout') ? 'active' : '' }}">
                        تسجيل الخروج
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

