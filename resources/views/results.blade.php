<table>
    <thead>
    <tr>
        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">№
        </th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Browser: activate to sort column ascending">Выходной заголовок
        </th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Browser: activate to sort column ascending">Результат
        </th>
    </tr>
    </thead>

    <tbody>

    @php
        $i = 0;
    @endphp

    @foreach($all as $result)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $result->ext_header_name }}</td>
            <td>{{ $result->ext_result }}</td>
            <td>{{ $result->ext_url }}</td>
        </tr>
    @endforeach
    </tbody>

</table>


{{--
{{var_export($ext_results_array,true)}}--}}
