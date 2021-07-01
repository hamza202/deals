<script>
$(window).on('load',function(){
var delayMs = 1500; // delay in milliseconds

setTimeout(function(){
$('#myModal').modal('show');
}, delayMs);
});
</script>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">My Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
