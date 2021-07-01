@isset($id)
    <?php
    $messeges = \App\Models\Chat::where([
        'advertiser_id' => advertiser()->id,
        'sender_id' => $id
    ])
        ->orderby('created_at', 'ASC')
        ->get();

    $messeges2 = \App\Models\Chat::where([
        'advertiser_id' => $id,
        'sender_id' => advertiser()->id
    ])
        ->orderby('created_at', 'ASC')
        ->get();

    $messeges = $messeges->merge($messeges2)->sortBy('created_at');

    ?>
<div style="max-height: 70vh; overflow-y: auto;" id="chat-scroll">

        @foreach($messeges as $messege)
            @if($messege->sender_id != advertiser()->id)
                <div class="first-user col-lg-12">
                    <div class="messeges">
                        <p class="messege-date px-2">{{   $messege ->created_at ->format('h:iA')   }}</p>
                        <p class="messege-body px-3 py-2">
                            {{$messege -> message}}
                        </p>
                        <img
                            class="user-image mx-3"
                            src="{{ asset($messege->sender ->photo)}}"
                        />
                    </div>
                </div>
                <br>
            @else
                <div class="second-user col-lg-12">
                    <div class="messeges">
                        <img
                            class="user-image mx-3"
                            src="{{ asset($messege->sender ->photo)}}"                            />

                        <p class="messege-body px-3 py-2">
                            {{$messege -> message}}
                        </p>
                        <p class="messege-date px-2">{{   $messege ->created_at ->format('h:iA')   }}</p>

                    </div>
                </div>
                <br>
            @endif
        @endforeach


</div>
<!-- send input -->

<div class="messeges-box">
    <div class="input-group my-4 w-100 mb-3">
        <div class="input-group-prepend">
        </div>
        <form class="input-group-prepend w-100" id="paramsForms" method="POST">
            @csrf
            <input type="hidden" name="sender_id" value="{{$messeges[0]->sender_id}}">
            <input type="hidden" name="advertiser_id" value="{{$messeges[0]->advertiser_id}}">
            <input
                class="form-control rounded-0 send-input py-4"
                placeholder="اكتب شيئا..."
                name="message"
            />
            <?php
            if ($messeges[0]->sender_id != advertiser()->id)
            $user = $messeges[0]->sender_id;
            else
             $user =   $messeges[0]->advertiser_id;
            ?>
            <div class="input-group-prepend">
                <button type="submit" onClick="renderTable({{$user}})">
                <span
                    class="input-group-text send"
                    id="basic-addon1"
                    style="background-color: #fff;"
                >
                  <i class="fas fa-paper-plane" style="color: #707070;"></i>
                </span>
                </button>
            </div>
        </form>


    </div>
</div>

<script>
    $("#paramsForms").on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route("messages.store") }}',
            method: "POST",
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend:function() {
                $("#save").attr('disabled', 'disabled');
            },
            success:function (data) {
                console.log(data);
                alert('تم ارسال الرسالة');
            },
            error:function (error) {
                console.log(error)
                alert('Data not saved');
            }
        })
    })
</script>
@endisset
