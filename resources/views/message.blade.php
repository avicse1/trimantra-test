@if(Session::has('success'))
    <div class="alert alert-success fade-message-success" style="text-align: center;font-size: 20px;">
        {{ Session::get('success') }}
    </div>
    <script>
        $(function(){
            setTimeout(function() {
                $('.fade-message-success').slideUp(600);
            }, 3000);
        });
    </script>
@endif
@if(Session::has('wrong'))
    <div class="alert alert-danger fade-message-error" style="text-align: center;font-size: 20px;">
        {{ Session::get('wrong') }}
    </div>
    <script>
        $(function(){
            setTimeout(function() {
                $('.fade-message-error').slideUp(600);
            }, 3000);
        });
    </script>
@endif