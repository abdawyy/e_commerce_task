@props([
    'ajaxUrl',
    'columns',
    'renderComponents' => false,
    'customActionsView' => ''
])

<style>
/* Native responsive table */
@media (max-width: 768px) {
    table.responsive-table thead {
        display: none; /* Hide table header */
    }

    table.responsive-table, 
    table.responsive-table tbody, 
    table.responsive-table tr, 
    table.responsive-table td {
        display: block;
        width: 100%;
    }

    table.responsive-table tr {
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0.5rem;
    }

    table.responsive-table td {
        text-align: right;
        position: relative;
        padding-left: 50%;
    }

    table.responsive-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
        font-weight: bold;
        text-align: left;
    }
}
</style>

<div>
    <table class="table table-bordered responsive-table" id="datatable" style="width: 100%;">
        <thead>
            <tr>
                @foreach ($columns as $col)
                    <th>{{ ucwords(str_replace(['.', '_'], ' ', $col)) }}</th>
                @endforeach
                @if ($renderComponents && !empty($customActionsView))
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <!-- Data will be filled by DataTables -->
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ $ajaxUrl }}',
        columns: [
            @foreach ($columns as $col)
                { 
                    data: '{{ $col }}', 
                    name: '{{ $col }}',
                    render: function (data, type, row) {
                        return `<td data-label="{{ ucwords(str_replace(['.', '_'], ' ', $col)) }}">${data ?? ''}</td>`;
                    }
                },
            @endforeach
            @if ($renderComponents && !empty($customActionsView))
                { 
                    data: 'actions', 
                    orderable: false, 
                    searchable: false,
                    render: function (data) {
                        return `<td data-label="Actions">${data}</td>`;
                    }
                }
            @endif
        ],
        createdRow: function (row) {
            // Ensure <td> keeps data-label for native responsive
            $(row).find('td').each(function(index) {
                let header = $('#datatable thead th').eq(index).text();
                $(this).attr('data-label', header);
            });
        }
    });
});
</script>
