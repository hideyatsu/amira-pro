@if($responsive)
<div class="table-responsive">
@endif

<table {{ $attributes->class([
    'table',
    'table-striped' => $striped,
    'table-bordered' => $bordered,
    'table-hover' => $hover,
    'table-sm' => $size === 'sm',
    'table-lg' => $size === 'lg'
]) }}>
    @if($caption)
        <caption>{{ $caption }}</caption>
    @endif

    @if(!empty($headers))
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>
                        @if(is_array($header))
                            {{ $header['text'] ?? $header['label'] ?? '' }}
                        @else
                            {{ $header }}
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
    @endif

    <tbody>
        @if(!empty($tableData))
            @foreach($tableData as $row)
                <tr>
                    @if(is_array($row))
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    @else
                        <td>{{ $row }}</td>
                    @endif
                </tr>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </tbody>
</table>

@if($responsive)
</div>
@endif
