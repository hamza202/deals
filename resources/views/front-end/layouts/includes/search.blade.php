    <form class="mt-5 first-form pt-3" method="POST" action="{{route('index.third_search')}}">
        @csrf
    <div class="background-form" style="">
        <div class="row">
            <div class="form-group col-lg-6 mb-3">
                <div
                    class="d-flex d-flex pl-2 rounded search-container py-1"
                >
                    <input
                        class="input-search form-control border-0"
                        type="search"
                        placeholder="ابحث عن السلعة ..."
                        aria-label="Search"
                        name="name"
                    />
                </div>
            </div>
            <div class="form-group col-lg-6 mb-3">
                <div class="">
                    <select
                        id=" "
                        class="form-control h-100 px-3 select2"
                        name="city_id"
                        style="width: 100%;"
                    >
                        @foreach($cities as $city)
                            <option value="{{$city -> id}}">{{$city -> name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <div class="mb-3 mb-lg-0">
                    <select style="width: 100%"
                        id="country"
                        class="form-control h-100 select2"
                        name="category_id"

                    >
                        <option value="" selected disabled>اختر القسم الرئيسي</option>
                        @foreach($main_category as $key => $country)
                            <option value="{{$key}}"> {{$country}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <div class="">
                    <select style="width: 100%"
                            name=state id="state" class="form-control h-100 select2">
                        <option value="" selected disabled>اختر القسم الفرعي</option>
                    </select>
                </div>
            </div>


        </div>
        <br>
        <div class="form-row pt-1" >

            <button type="submit"  class="btn btn-primary mx-auto shadow-sm" id="btn-nav" >
                &nbsp;     بحث  <i class="fas fa-search" ></i>
            </button>

        </div>
    </div>
</form>
