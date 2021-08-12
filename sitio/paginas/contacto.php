<section id="contacto">
    <h1>Contactanos</h1>
    <p class="mensaje-pagina">No dudes en contactarnos y probar uno de nuestros deliciosos platos.</p>
    <form action="index.php?s=consulta-enviada" class="container-fluid" method="post" >
        <div id="contacto-nombre">
            <div>
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12 col-lg-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="col-md-12 col-lg-6">
                <label for="numero" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="numero" name="numero">
            </div>
        </div>
        <div class="m-3">
            <label for="motivo">Motivo</label>
            <select class="form-select " name="motivo" id="motivo">
                <option selected>Motivo de tu consulta</option>
                <option value="1">Marketing</option>
                <option value="2">Administración y finanzas</option>
                <option value="3">Sugerencia</option>
            </select>
        </div>
        
        <div class="m-3">
            <label for="comentario" class="form-label">Mensaje</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mx-auto px-5 ">Enviar</button>
        </div>
    </form>
</section>