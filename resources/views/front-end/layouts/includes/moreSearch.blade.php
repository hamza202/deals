<!DOCTYPE html>
<html>
<head>
    <title>Ajax dynamic dependent country state city dropdown using jquery ajax in Laravel 5.6</title>
    <link rel="stylesheet" href="//www.codermen.com/css/bootstrap.min.css">
    <script src=//www.codermen.com/js/jquery.js></script>
</head>
<body>
<div >
    <div >
        <div >
            <div >
                <select id="country" name=category_id  >
                    <option value="" selected disabled>Select</option>
                    @foreach($main_category as $key => $country)
                        <option value="{{$key}}"> {{$country}}</option>
                    @endforeach
                </select>
            </div>
            <div >
                <label for="title">Select State:</label>
                <select name=state id="state" >
                </select>
            </div>


        </div>
    </div>
</div>
<script type=text/javascript>
    $('#country').change(function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('get-state-list')}}?country_id="+countryID,
                success:function(res){
                    if(res){
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            $("#state").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#state").empty();
                    }
                }
            });
        }else{
            $("#state").empty();
                 }
    });
</script>
</body>
</html>
