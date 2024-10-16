<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text">
            {{ __('Deletar a conta') }}
        </h2>

        <p class="mt-1 text-sm text">
            {{ __('Uma vez deletada a conta, você perderá todos os seus dados.') }}
        </p>
    </header>

    <button class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Deletar a conta') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text">
                {{ __('Tem certeza de que deseja deletar sua conta?') }}
            </h2>

            <p class="mt-1 text-sm text">
                {{ __('Uma vez deletada, todos os dados serão permanentemente perdidos. Insira sua senha para confirmar.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="form-label sr-only">{{ __('Senha') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control mt-1 block w-3/4"
                    placeholder="{{ __('Senha') }}"
                />

                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </button>

                <button type="submit" class="btn btn-danger ms-3">
                    {{ __('Deletar Conta') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
