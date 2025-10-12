@php
  // Extract configuration and attributes
  $dtConfig = $config;
  $isServerSide = $serverSide;

  // Exclude specific attributes from being rendered in the HTML element
  $renderedAttributes = $attributes->except(['config', 'data', 'server-side', 'hoverable', 'condensed', 'bordered', 'striped']);
@endphp

<div @if ($config['responsive']) class="table-responsive" @endif>
  <table
    id="{{ $id }}"
    {{ $renderedAttributes->class([
      'table w-full',
      'table-striped' => $striped,
      'table-hover' => $hoverable,
      'table-sm' => $condensed,
      'table-bordered' => $bordered,
    ]) }}>
    <thead>
      <tr>
        @foreach ($heads as $header)
          @php
            $isConfig = is_array($header);
            $labelText = $isConfig ? $header['label'] ?? '' : $header;

            $thAttributes = '';
            if ($isConfig) {
                if (isset($header['width'])) {
                    $thAttributes .= ' style="width:' . $header['width'] . '%"';
                }
            }
          @endphp

          <th {!! $thAttributes !!}>
            {{ $labelText }}
          </th>
        @endforeach
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

@push('page-styles')
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@push('page-scripts')
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const tableId = '{{ $id }}';
      const dtOptions = @json($dtConfig);
      const serverMode = @json($isServerSide);
      const localData = @json($tableData);

      // Adjust options based on server-side or client-side mode
      if (serverMode) {
        dtOptions.processing = true;
        dtOptions.serverSide = true;
      } else {
        dtOptions.serverSide = false;
        dtOptions.processing = false;

        // Use local data for client-side processing
        dtOptions.data = localData;

        if (dtOptions.ajax) {
          // Remove ajax option if local data is used
          delete dtOptions.ajax;
        }
      }

      if (typeof $ !== 'undefined' && typeof $.fn.DataTable !== 'undefined') {
        if (dtOptions.buttons && dtOptions.buttons.length > 0) {
          dtOptions.dom = dtOptions.dom ||
            "<'row mb-2'<'col-md-12'B>>" + // Button row
            "<'row mb-2'<'col-md-6'l><'col-md-6'f>>" + // Length and Filter row
            "<'row'<'col-md-12'tr>>" + // Table row
            "<'row'<'col-md-5'i><'col-md-7'p>>"; // Info and Pagination row
        } else {
          dtOptions.dom =
            "<'row mb-2'<'col-md-6'l><'col-md-6'f>>" + // Top row (Length and Filter)
            "<'row'<'col-md-12'tr>>" + // Middle row (Table)
            "<'row'<'col-md-5'i><'col-md-7'p>>"; // Bottom row (Info and Pagination)
        }

        $('#' + tableId).DataTable(dtOptions);
      } else {
        console.error('jQuery or DataTables is not loaded.');
      }
    });
  </script>
@endpush
