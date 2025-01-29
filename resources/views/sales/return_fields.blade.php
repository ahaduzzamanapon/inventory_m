<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group col-sm-12">
                {!! Form::label('sales_id', 'Select Sales:') !!}
                {!! Form::select('sales_id', $sales, null, ['class' => 'form-control', 'onchange' => 'get_return_sale_data(this.value)']) !!}
            </div>
        </div>
    </div>
    <div class="row" id="return_sale_data">
    </div>
</div>





@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sales_id').chosen();
        });
    </script>
    <script>
        function get_return_sale_data($sales_id) {
            $.ajax({
                url: "{{ route('sales.get_return_sale_data') }}",
                type: "POST",
                data: {
                    sales_id: $sales_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    //console.log(data);

                    $('#return_sale_data').html(data);
                }
            });

        }
    </script>


@endsection
