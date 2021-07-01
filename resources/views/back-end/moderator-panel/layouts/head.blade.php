<style>
    .active {
        background-color: #efe817 !important;
    }
</style>

<div class="head">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <h2 class="head-title my-5">لوحة تحكم المشرفين</h2>
            <img class="my-0" src="{{ asset('back-end/images/control-panel.svg')}}" alt="control-panel"
                 style="width: 40%;max-height: 150px;object-fit: contain;"/>
            <div class="row button-groups mx-auto w-100 mt-5 button-section">
                <div class="col-12 col-lg-6 d-flex justify-content-center px-0">
                    <button onclick="window.location.href='{{route('moderator.dashboard')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.dashboard') ? 'active' : '' }}">
                        الرئيسية
                    </button>
                    <button onclick="window.location.href='{{route('moderator.charts')}}'" id="my-fav-ad"
                            class="my-ad btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.charts') ? 'active' : '' }}">
                        الاحصائيات
                    </button>
                    <button onclick="window.location.href='{{route('moderator.category')}}'" id="my-fav-ad"
                            class="my-ad btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.category') ? 'active' : '' }}">
                        الأقسام
                    </button>
                    <button onclick="window.location.href='{{route('moderator.cities')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.cities') ? 'active' : '' }}">
                        المدن
                    </button>
                    <button onclick="window.location.href='{{route('moderator.sponsored')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::is('moderator/sponsored*') ? 'active' : '' }}">
                        اعلانات ممولة
                    </button>
                    <button onclick="window.location.href='{{route('moderator.gifts')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.gifts') ? 'active' : '' }}">
                        برنامج الهدايا
                    </button>
                    <button onclick="window.location.href='{{route('moderator.replace_gifts')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.replace_gifts') ? 'active' : '' }}">
                        طلبات الهدايا
                    </button>

                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center px-0 button-section">
                    <button onclick="window.location.href='{{route('moderator.advertisers')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.advertisers') ? 'active' : '' }}">
                        المعلنين
                    </button>
                    <button onclick="window.location.href='{{route('moderator.black_list')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.black_list') ? 'active' : '' }}">
                        القائمة السوداء
                    </button>

                    <button onclick="window.location.href='{{route('moderator.membership')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.membership') ? 'active' : '' }}">
                        العضويات
                    </button>
                    <button onclick="window.location.href='{{route('moderator.messages')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.messages') ? 'active' : '' }}">
                        الرسائل الترويجية
                    </button>

                    <button onclick="window.location.href='{{route('moderator.pages.know-right')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.pages.know-right') ? 'active' : '' }}">
                        اعرف حقك
                    </button>
                    <button onclick="window.location.href='{{route('moderator.packages')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.packages') ? 'active' : '' }}">
                        الباقات
                    </button>
                    <button onclick="window.location.href='{{route('moderator.fixed.advertising')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.fixed.advertising') ? 'active' : '' }}">
                        طلبات التثبيت
                    </button>
                </div>
                <div class="col-12 col-lg-12 d-flex justify-content-center px-0 button-section">
                    <button onclick="window.location.href='{{route('moderator.subscription.show')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.subscription.show') ? 'active' : '' }}">
                        طلبات الاشتراكات
                    </button>
                    <button onclick="window.location.href='{{route('moderator.amrtidall')}}'" id="my-fav-ad"
                            class="my-ad btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.amrtidall') ? 'active' : '' }}">
                        امر تدلل
                    </button>
                    <button onclick="window.location.href='{{route('moderator.advertising')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.advertising') ? 'active' : '' }}">
                        الاعلانات
                    </button>

                    <button onclick="window.location.href='{{route('moderator.commission')}}'" id="my-ad"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.commission') ? 'active' : '' }}">
                        العمولات
                    </button>

                    <button onclick="window.location.href='{{route('moderator.sliders')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.sliders') ? 'active' : '' }} ">
                        السلايدر
                    </button>

                    <button onclick="window.location.href='{{route('moderator.pages')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.pages') ? 'active' : '' }}">
                        الصفحات الثابتة
                    </button>
                    <button onclick="window.location.href='{{route('moderator.moderators')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.moderators') ? 'active' : '' }}">
                        المشرفين
                    </button>
                    <button onclick="window.location.href='{{route('moderator.abuse')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.abuse') ? 'active' : '' }}">
                        الاساءات
                    </button>
                    <button onclick="window.location.href='{{route('moderator.consultations')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.consultations') ? 'active' : '' }}">
                        طلبات الاستشارة
                    </button>
                    <button onclick="window.location.href='{{route('moderator.contact-us')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.contact-us') ? 'active' : '' }}">
                        تواصل معنا
                    </button>
                    <button onclick="window.location.href='{{route('moderator.reports')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.reports') ? 'active' : '' }}">
                        التقارير
                    </button>
                    <button onclick="window.location.href='{{route('moderator.questionnaire')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.questionnaire') ? 'active' : '' }}">
                        الاستبيان
                    </button>
                    <button onclick="window.location.href='{{route('moderator.logout')}}'" id="chat"
                            class="btn btn-primary the-button w-100 py-3 {{ Request::routeIs('moderator.logout') ? 'active' : '' }}">
                        تسجيل الخروج
                    </button>
                </div>


            </div>
        </div>
    </div>
</div>

