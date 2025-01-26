@include('report.report_header')
<div style="place-items: anchor-center;place-self: center;">
    <h5 class="text-primary">{{$report_title}}</h5>
</div>
<div id="report-data-view">
    <table id="report-table" class="table table-hover table-striped">
        <thead>
            <tr>
                @foreach($headers as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $row)
                <tr>
                    @foreach($row as $column)
                        <td>{{ $column }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                @foreach($footers as $column)
                    <td>{{ $column }}</td>
                @endforeach
            </tr>
        </tfoot>
    </table>
</div>
