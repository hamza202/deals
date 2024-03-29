<div class="footer text-right" style="background: #f8f9fa;" >
    <div class="container-fluid">
        <div class="d-block d-md-flex justify-content-between px-3 pt-4">
            <div class="align-items-center d-flex flex-wrap justify-content-center">
                <img class="ml-0 ml-md-4" src="{{ asset('front-end/images/Logo-footer.svg')}}" alt="logo">
                <div class="intrest-link mr-3 my-4 my-md-0">
                    <p class="text-center text-sm-right">روابط قد تهمك:</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{route('terms-and-conditions')}}" >
                            سياسة الخصوصية
                        </a>
                        <a href="{{route('terms-and-conditions')}}"  class="mx-3">
                            القوانين
                        </a>
                        <a href="{{route('terms-and-conditions')}}" >
                         الشروط و الأحكام
                        </a>
                    </div>
                </div>
            </div>
            <div class="align-items-center d-flex justify-content-center mb-3 mb-md-0">
                <p class="ml-3 follow-us">تابعنا:</p>
                @php
                    $row1 =  App\Models\Social::where('id',1)->first();
                    $row2 =  App\Models\Social::where('id',2)->first();
                    $row3 =  App\Models\Social::where('id',3)->first();
                    $row4 =  App\Models\Social::where('id',4)->first();
                @endphp
                <a  class="ml-2" href="{{$row4 -> link}}"><i class="fab fa-snapchat-ghost"></i></a>
                <a  class="ml-2" href="{{$row2 -> link}}"><i class="fab fa-twitter"></i></a>
                <a  class="ml-2" href="{{$row3 -> link}}"><i class="fab fa-instagram"></i></a>
                <a href="{{$row1 -> link}}"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="d-flex justify-content-center copy-rights pt-4">
            <p> 2020 جميع الحقوق محفوظة ©</p>
        </div>
    </div>
</div>
