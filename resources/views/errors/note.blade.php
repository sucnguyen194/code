@if (Session::has('message'))
    <script type="text/javascript">
        $(document).ready(function(){
            flash( @json(session('message')) );
        });
    </script>
@endif

@if ($errors->any())
    @foreach($errors->all() as $error)
        <script type="text/javascript">
            $(document).ready(function(){
                let obj = {
                    'message' : '{{$error}}',
                    'type' : 'error'
                }
                flash(obj);
            });
        </script>
    @endforeach
@endif


