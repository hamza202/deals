//google map
$("#pickup_country").PlacePicker({
    key: "AIzaSyAPceSsErOlOqRVJ7qIb2ZnbKTPnXb4uP0",
    title: "اختيار الموقع",
    btnClass: "btn btn-transparent btn-sm",
    center: { lat: 24.7245049, lng: 46.6960525 },
    zoom: 14,
    success: function (data, address ,lat ,lng) {
      $("#pickup_country").val(data.formatted_address);
        $('#latitude').val('lat'),
       $('#longitude').val('lng'),
      console.log(address, data ,lat ,lng);
    },
  });
