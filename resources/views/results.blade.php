<table>
    <thead>
    <tr>
        {{--@foreach($headers as $header)
            <td>{{ $header->ext_header_name }}</td>
        @endforeach--}}
    </tr>
    </thead>

    <tbody>

    @foreach($ext_results_array as $result)
        <tr>
            <td>{{ $result[]->ext_result }}</td>
        </tr>
    @endforeach
    </tbody>

</table>


{{--
{{var_export($ext_results_array,true)}}--}}
