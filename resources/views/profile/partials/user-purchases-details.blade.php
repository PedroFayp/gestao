<section>
    <header>
        <h2 class="text-lg font-medium text">
            {{ __('Minhas compras') }}
        </h2>
    </header>

    <table class="table table-light mt-4">
        <thead>
            <tr>
                <th class="text-sm">{{ __('Nº da compra') }}</th>
                <th class="text-sm">{{ __('Cod. do Produto') }}</th>
                <th class="text-sm">{{ __('Quantidade') }}</th>
                <th class="text-sm">{{ __('Preço') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($purchases->isEmpty())
                <tr>
                    <td colspan="4" class="text-center text-sm">
                        {{ __('Nenhuma compra realizada.') }}
                    </td>
                </tr>
            @else
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->sales_id }}</td>
                        <td>{{ $purchase->product_id }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ $purchase->price }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</section>
