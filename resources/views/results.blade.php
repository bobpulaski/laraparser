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
            <td>{{ $result['jopa']['title'] }}</td>
        </tr>
    @endforeach
    </tbody>

</table>
