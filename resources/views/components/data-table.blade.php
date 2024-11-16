<table class="table table-bordered table-hover table-striped slim-table custome-table-style mb-0 display nowrap" id="group_table">
    <thead>
    <tr>
        @php
        $count = 0;
        @endphp
        @foreach($table_headers as $key => $table_header)
            <th id="column-head-{{ $count }}" data-index="{{ $count }}"
                class="column-{{ $count }} {{ $table_header['sorting'] ? 'sorting' : '' }}">
                {{ $table_header['title'] }}
            </th>
        @endforeach
        @php
            $count++;
        @endphp
    </tr>
    </thead>

    <tbody>

    </tbody>
</table>
