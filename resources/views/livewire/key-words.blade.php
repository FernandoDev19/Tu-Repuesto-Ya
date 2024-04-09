<div>
    {{-- Alertas --}}
    @if ($openAlertSuccess == true)
        <div class="background-alert modal-open" id="success-alert">
            <div class="alert alert-info" id="success_message">

                <div id="btn-close-success" wire:click="closeAlert()">×</div>

                <div class="text-alert">
                    <i class="fa fa-check" style="color: #5593e8;"></i>
                    <strong>{{ $textAlert }}</strong>
                </div>

            </div>
        </div>

        <script>
            let btnClose = document.getElementById('btn-close-success');
            let message = document.getElementById('success-alert');
            btnClose.addEventListener('click', function() {
                enableScroll();
                message.remove();
            });

            function disableScroll() {
                // Previene el desplazamiento del mouse
                window.addEventListener('wheel', preventScroll, {
                    passive: false
                });

                document.addEventListener('touchmove', preventDefault, {
                    passive: false
                });

            }

            // Función para permitir el desplazamiento
            function enableScroll() {
                // Remueve el evento que previene el desplazamiento del mouse
                window.removeEventListener('wheel', preventScroll, {
                    passive: false
                });

                document.removeEventListener('touchmove', preventDefault, {
                    passive: false
                });

            }

            // Función que se llama para prevenir el desplazamiento
            function preventScroll(e) {
                e.preventDefault();
            }

            function preventDefault(e) {
                e.preventDefault();
            }

            if (message) {
                disableScroll();
            }
        </script>
    @endif

    @if ($openAlertError == true)
        <div class="background-alert modal-open" id="error-alert">
            <div class="alert alert-danger" id="error_message">

                <div id="btn-close-error" wire:click="closeAlert()">×</div>

                <div class="text-alert">
                    <i class="fa fa-ban"></i>
                    <strong>{{ $textAlert }}</strong>
                </div>

            </div>
        </div>

        <script>
            let btnClose = document.getElementById('btn-close-error');
            let message = document.getElementById('error-alert');
            btnClose.addEventListener('click', function() {
                enableScroll();
                message.remove();
            });

            function disableScroll() {
                // Previene el desplazamiento del mouse
                window.addEventListener('wheel', preventScroll, {
                    passive: false
                });

                document.addEventListener('touchmove', preventDefault, {
                    passive: false
                });

            }

            // Función para permitir el desplazamiento
            function enableScroll() {
                // Remueve el evento que previene el desplazamiento del mouse
                window.removeEventListener('wheel', preventScroll, {
                    passive: false
                });

                document.removeEventListener('touchmove', preventDefault, {
                    passive: false
                });

            }

            // Función que se llama para prevenir el desplazamiento
            function preventScroll(e) {
                e.preventDefault();
            }

            function preventDefault(e) {
                e.preventDefault();
            }

            if (message) {
                disableScroll();
            }
        </script>
    @endif

    @foreach ($category as $categoria)
            @if ($categoria->id == $id)
                @php
                    // Assuming $categoria->keyword is a Laravel collection
                    $keywords = $categoria->keyword->sortBy('palabra_clave');
                @endphp
            @foreach ($keywords as $keyword)
                <div class="card"
                    style="display: flex; flex-direction: row; justify-content: space-between; width: 100%; padding: 1rem; background-color: #5593E8; color: white;">

                    <h5>{{ $keyword->palabra_clave }}</h5>

                    <div style="display: flex; gap: 1rem;">
                        <a wire:click="edit()">
                            <button class="btn" style="color: white;"><i class="fas fa-edit"></i></button>
                        </a>
                        <a wire:click="delete({{$keyword->id}})" wire:confirm="¿Seguro que deseas eliminar esta palabra clave?">
                            <button class="btn btn_danger"><i class="fas fa-trash text-danger"></i></button>
                        </a>
                    </div>
                </div>
            @endforeach

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                  const input = document.getElementById('keyword');
                  let keyword = @json($key_words);
                  let keywordError = document.getElementById('keywordError');

                  function validar() {
                    const valor = input.value;
                    for(let i = 0; i < keyword.length; i++){
                        if (valor.toLowerCase() === keyword[i].palabra_clave.toLowerCase()) {
                            keywordError.textContent = 'Esta palabra clave ya está';
                            input.setCustomValidity('Esta palabra clave ya está');
                            return;
                        }
                    }

                    keywordError.textContent = '';
                    input.setCustomValidity('');
                  }

                  input.addEventListener('input', validar);
                });
              </script>
        @endif
    @endforeach

</div>
