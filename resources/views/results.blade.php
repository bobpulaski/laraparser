<table>
    <thead>
    <tr>


        {{--<pre><code>{{ json_encode($ext_results_array, JSON_PRETTY_PRINT) }}</code></pre>--}}

        {{--@foreach($ext_results_array as $ext_headers)
            <td>{{ $ext_headers->ext_header_name }}</td>
        @endforeach--}}

        @php
            $i = 0;
        @endphp

        @foreach($ext_results_array as $ext_headers)
            <td>{{ $ext_headers->ext_header_name }}</td>
            <td>{{ $ext_headers->ext_result }}</td>
        @endforeach



    </tr>
    </thead>
</table>
