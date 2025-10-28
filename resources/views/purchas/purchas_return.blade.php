@extends('layouts.default')

@section('title', 'Purchase Return')

@section('content')
<section class="content-header">
    <h1>Purchase Return</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'purchas.return_store_p', 'files' => true,'class' => 'form-horizontal']) !!}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group col-sm-12">
                            {!! Form::label('purchas_id', 'Select Purchase ID:') !!}
                            {!! Form::select('purchas_id', $purchases, null, ['class' => 'form-control', 'onchange' => 'get_return_purchas_data(this.value)'])
 !!}
                        </div>
                    </div>
                </div>
                <div class="row" id="return_purchas_data">
                </div>
                <div class="form-group col-sm-12" style="text-align-last: right;">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary'])
 !!}
                    <a href="{{ route('purchas.purchas_list') }}" class="btn btn-danger">Cancel</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#purchas_id').chosen();
        });
    </script>
    <script>
        function get_return_purchas_data($purchas_id) {
            $.ajax({
                url: "{{ route('purchas.get_return_purchas_data') }}",
                type: "POST",
                data: {
                    purchas_id: $purchas_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#return_purchas_data').html(data);
                }
            });

        }
    </script>
@endsection
@endsection
