<section id="contacto">
    <h1>Contactanos</h1>
    <p class="mensaje-pagina">No dudes en contactarnos ante cualquier inquietud o sugerencia.</p>
    <form action="index.php?s=consulta-enviada" class="container-fluid " method="post" >
        <div class="row">
            <div id="contacto-nombre" class="col-12 my-2">
                <div>
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 my-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-12 col-lg-6 my-2">
                <label for="numero" class="form-label">Telefono (Opcional)</label>
                <input type="text" class="form-control" id="numero" name="numero">
            </div>
            <div class="col-12 my-2">
                <label for="motivo">Motivo</label>
                <select class="form-select " name="motivo" id="motivo" required>
                    <option selected value="" disabled hidden>Motivo de tu consulta</option>
                    <option value="1">Marketing</option>
                    <option value="2">Administración y finanzas</option>
                    <option value="3">Sugerencia</option>
                </select>
            </div>
            
            <div class="col-12 my-2">
                <label for="comentario" class="form-label">Mensaje</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
            </div>
            <div class="col-auto my-3">
                <button type="submit" class="btn btn-primary mx-auto px-5 ">Enviar</button>
            </div>
        </div>
        
    </form>
</section>