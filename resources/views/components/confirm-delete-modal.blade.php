<!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content px-3">
            <div class="modal-header border-bottom-0">
                <div class="modal-title text-left fw-bold h5" id="modalTitle" style="font-weight: 400"> ¡Atención!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="line ms-3"></div>
            <div class="modal-body">
                {{-- <div class="modal-title text-center fw-bold titulo col-12" id="modalTitle" style="font-weight: 400"> ¡Atención!</div> --}}
                <div class="row">
                    <div class="col-12 my-4 text-center">
                        <form action="#" method="POST" id="modalForm">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <h6 class="subtitulo text-center">¿Desea eliminar {{ $message }}?</h6>
                            </div>
                        </form>
                    </div>
                    <div class="col-6 text-end">
                        <button type="button" class="btn btn-secondary me-2 py-1" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary me-2 py-1" form="modalForm">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var deleteModal = document.getElementById('deleteModal')
    deleteModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever');
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = deleteModal.querySelector('.modal-title');
        var modalForm = deleteModal.querySelector('#modalForm');

        modalTitle.textContent = `Estás por eliminar {{ $message }} #${recipient}`;
        // `¿Esta seguro de eliminar {{ $message }} #${recipient}?`;
        modalForm.setAttribute('action', `/{{ $route }}/${recipient}`);
    })
</script>
