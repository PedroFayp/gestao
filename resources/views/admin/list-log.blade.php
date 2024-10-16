@extends('layouts.app')

@section('title', 'Entradas e Saídas')

@section('content')
<div class="mb-3 row p-3">
    <div class="col-auto">
        <input type="text" id="search" placeholder="Buscar por nome" class="form-control" onkeyup="filterTable()">
    </div>
    <div class="col-auto">
        <select id="filterType" class="form-control" onchange="filterTable()">
            <option value="">Selecionar tipo</option>
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select>
    </div>
    
    <div class="col-auto ms-auto">
        <button id="exportCsv" class="btn btn-primary btn-sm" onclick="exportCSV()">
            <i class="fas fa-print"></i>
            Exportar CSV
        </button>
    </div>
</div>

<table class="container table table-light">
    <thead>
        <tr>
            <th onclick="sortTable(0)">Produto</th>
            <th onclick="sortTable(1)">Tipo</th>
            <th onclick="sortTable(2)">Quantidade</th>
            <th onclick="sortTable(3)">Data</th>
        </tr>
    </thead>
    <tbody id="movementsTableBody">
        @foreach($movements as $movement)
            <tr>
                <td>{{ $movement->product->name }}</td>
                <td>{{ $movement->type }}</td>
                <td>{{ $movement->quantity }}</td>
                <td>{{ $movement->created_at->format('d/m/Y H:i:s') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item {{ $movements->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $movements->previousPageUrl() }}">Anterior</a>
            </li>
            @for ($i = 1; $i <= $movements->lastPage(); $i++)
                <li class="page-item {{ $movements->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $movements->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $movements->onLastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $movements->nextPageUrl() }}">Próximo</a>
            </li>
        </ul>
    </nav>
</div>
<script>
    function filterTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const filterType = document.getElementById('filterType').value;
        const tableRows = document.querySelectorAll('#movementsTableBody tr');

        tableRows.forEach(row => {
            const productName = row.cells[0].textContent.toLowerCase();
            const type = row.cells[1].textContent.toLowerCase();
            const matchesSearch = productName.includes(searchInput);
            const matchesType = filterType === '' || type === filterType;

            if (matchesSearch && matchesType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function sortTable(columnIndex) {
        const table = document.getElementById('movementsTableBody');
        const rows = Array.from(table.rows);
        const sortedRows = rows.sort((a, b) => {
            const aText = a.cells[columnIndex].textContent;
            const bText = b.cells[columnIndex].textContent;

            return aText.localeCompare(bText);
        });

        table.innerHTML = '';
        sortedRows.forEach(row => table.appendChild(row));
    }

    function exportCSV() {
        window.location.href = '{{ route("movements.export") }}';
    }
</script>
@endsection
