<!DOCTYPE html>
<html lang="en">
<head>
    <title>تعديل الإعلان</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">

    <!-- Bootstrap CSS -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('front-end/css/custome.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/create-ad.css')}}"/>

    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"
        rel="stylesheet"
    />
</head>


<body class="text-right" dir="rtl">
@include('front-end.layouts.includes._header')

<section class="container pt-5 contain-form mt-5">
    <h3 class="text-center mb-5">تعديل الإعلان :</h3>

    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')

    <form class="mt-3" action="{{route('advertising.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  value="{{$row -> lat}}" id="latitude" name="latitude">
        <input type="hidden" value="{{$row -> lng}}" id="longitude"  name="longitude">

        <input type="hidden" name="id" value="{{$row -> id}}">
        <div class="d-flex justify-content-center">
            <div class="Neon Neon-theme-dragdropbox">
                <input
                    style="
              z-index: 999;
              opacity: 0;
              width: 250px;
              height: 145px;
              position: absolute;
              right: 0px;
              left: 0px;
              margin-right: auto;
              margin-left: auto;
              cursor: pointer;
              "
                    name="files[]"
                    id="filer_input2"
                    multiple="multiple"
                    type="file"
                />

                @error('files')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="Neon-input-dragDrop">
                    <div
                        class="Neon-input-inner d-flex align-items-center justify-content-center"
                    >
                        <div class="Neon-input-text">
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <span
                                style="
                      display: inline-block;
                      margin-top: 30px;
                      font-size: 1.2rem;
                    "
                            >أضف صورة الإعلان</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="d-flex justify-content-center text-center img-extention mb-5"
        >
            <div>
                <p class="mb-2">يمكنك رفع صور من نوع</p>
                <p>png - jpeg - gif</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-lg-6">
                <label for="name">اسم الإعلان</label>
                <input
                    type="text"
                    class="form-control input"
                    id="name"
                    required
                    value="{{$row -> title}}"
                    name="title"
                    placeholder="ضع اسم الإعلان"
                />
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label for="city">مدينه الإعلان</label>

                <select
                    style="width: 100%"
                    class="form-control select2"
                    name="city_id"
                    id="city"
                    required
                >
                    @error('city_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <option selected>اختر المدينة</option>
                    @isset($cities)
                        @foreach($cities as $city)

                            <option
                                @if($row -> city_id == $city -> id)
                                selected
                                @endif
                                value="{{$city -> id}}"

                            >{{$city -> name}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-lg-6">
                <label for="price">السعر</label>
                <input
                    type="number"
                    class="form-control input"
                    id="price"
                    placeholder="ضع السعر"
                    required
                    value="{{$row -> price}}"
                    name="price"
                />

                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label for="insurance">مبلغ التأمين</label>
                <input type="number" value="{{$row -> insurance_price}}" name="insurance_price"
                       class="form-control input" id="insurance"/>

                @error('insurance_price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-lg-6">
                <label for="phone">رقم الجوال</label>
                <input type="number" value="{{$row -> phone}}" name="phone" class="form-control input" id="phone"
                       placeholder="××××××××05"/>
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror

                <div class="form-check">
                    <input class="form-check-input" name="is_phone" type="checkbox" id="gridCheck"/>
                    <label class="form-check-label" for="gridCheck">
                        إظهار رقم الجوال
                    </label>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-lg-6">
                <label for="details">التفاصيل</label>
                <textarea class="form-control" name="description" id="details"
                          required> {{$row -> description}} </textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label for="vedio-url">رابط الفيديو ( يوتيوب )</label>
                <input value="{{$row -> vedio_url}}" type="url" name="vedio_url" class="form-control input"
                       id="vedio-url"
                       placeholder="http://youtube.com/watch?v=8Opqkaj563"/>
                @error('vedio-url')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-lg-6">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="conditions-ad"
                        checked
                        name="is_specialconditions"
                    />
                    <label class="form-check-label " for="conditions-ad">
                        هل لديك شروط خاصة لإعلانك؟
                    </label>
                </div>
                <label class="form-check-label sub-label mb-2">
                    (اضافة شروط ليست اجبارية)
                </label>
                <textarea class="form-control" id="details"
                          name="special_conditions">{{$row -> special_conditions}}</textarea>
                <div class="my-4">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="act-comments"
                            checked
                            name="comments"
                        />
                        <label class="form-check-label " for="act-comments">
                            تفعيل التعليقات
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="agreement"
                            name="condition"
                            checked
                            required
                        />
                        <label class="form-check-label" for="agreement">
                            اوافق على جميع الشروط والاحكام
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row mb-3">
            <button
                id="sub-btn"
                type="submit"
                class="btn btn-primary mx-auto w-50 py-2 btn-create-ad rounded-pill"
            >
                تحديث
            </button>
        </div>
    </form>
</section>
@include('front-end.layouts.includes._footer')


<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    crossorigin="anonymous"
></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"
></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"
></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('b[role="presentation"]').hide();

        $(".select2-selection__arrow").append(
            '<i class="fa fa-angle-down"></i>'
        );
    });
</script>
<script src="{{ asset('front-end/js/PlacePicker.js')}}"></script>
<script src="{{ asset('front-end/js/nav-footer.js.js')}}"></script>
<script src="{{ asset('front-end/js/map.js')}}"></script>


<script>
    $('#country').change(function () {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-state-list')}}?country_id=" + countryID,
                success: function (res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('');
                        $.each(res, function (key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
        }
    });

</script>
<script type="text/javascript">
    $('#category').change(function () {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('/get-state-list')}}?category_id=" + countryID,
                success: function (res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('');
                        $.each(res, function (key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
        }
    });
</script>
<script>
    $("#pac-input").focusin(function() {
        $(this).val('');
    });
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    function initAutocomplete() {
        var pos = {lat:   {{ $row->lat }} ,  lng: {{ $row->lng }} };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: pos
        });
        infoWindow = new google.maps.InfoWindow;
        geocoder = new google.maps.Geocoder();
        marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: '{{ $row->title }}'
        });
        infoWindow.setContent('{{ $row->title }}');
        infoWindow.open(map, marker);
        // move pin and current location
        infoWindow = new google.maps.InfoWindow;
        geocoder = new google.maps.Geocoder();
        var geocoder = new google.maps.Geocoder();
        google.maps.event.addListener(map, 'click', function(event) {
            SelectedLatLng = event.latLng;
            geocoder.geocode({
                'latLng': event.latLng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        deleteMarkers();
                        addMarkerRunTime(event.latLng);
                        SelectedLocation = results[0].formatted_address;
                        console.log( results[0].formatted_address);
                        splitLatLng(String(event.latLng));
                        $("#pac-input").val(results[0].formatted_address);
                    }
                }
            });
        });
        function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
            var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
            /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
            $('#latitude').val(markerCurrent.position.lat());
            $('#longitude').val(markerCurrent.position.lng());
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setZoom(8);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        markers.push(marker);
                        infowindow.setContent(results[0].formatted_address);
                        SelectedLocation = results[0].formatted_address;
                        $("#pac-input").val(results[0].formatted_address);
                        infowindow.open(map, marker);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
            SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
        }
        function addMarkerRunTime(location) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        }
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }
        function clearMarkers() {
            setMapOnAll(null);
        }
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        $("#pac-input").val("{{ $row->address }} ");
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(100, 100),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };
                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));
                $('#latitude').val(place.geometry.location.lat());
                $('#longitude').val(place.geometry.location.lng());
                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }
    function splitLatLng(latLng){
        var newString = latLng.substring(0, latLng.length-1);
        var newString2 = newString.substring(1);
        var trainindIdArray = newString2.split(',');
        var lat = trainindIdArray[0];
        var Lng  = trainindIdArray[1];
        $("#latitude").val(lat);
        $("#longitude").val(Lng);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPceSsErOlOqRVJ7qIb2ZnbKTPnXb4uP0&libraries=places&callback=initAutocomplete&language=ar&region=SA
         async defer"></script>
</body>
</html>
