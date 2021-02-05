<div class="container">
   
    <form method="post" action="recibe" class="panel-body no-padding">
        
    <div class="panel mb-0 panel-primary panel-flat border-left-primary">

        <h3 class="panel-heading ">Ingresa datos del producto</h3>
        <div >
            <label>Nombre</label>
            <input type="text" name="nombre_p" required="true" />
        </div>
       
        <div>
            <label>Descripción</label><br/>
            <textarea name="descripcion_p" required="true" rows="5" cols="40" placeholder="Escribe una descripción"></textarea>
            
        </div>
        
        <h3 class="panel-heading " >Ingresa datos del veneno</h3>
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre_v" required="true" />
        </div>
         <div>
            <label>Provoca</label><br/>
            <textarea name="provoca_p" required="true" rows="5" cols="40" placeholder="Escribe que provoca"></textarea>
            
        </div>
        <div>
            <label>Descripción</label><br/>
            <textarea name="descripcion_v" required="true" rows="5" cols="40" placeholder="Escribe una descripción"></textarea>
            
        </div>
        <div>
        <input class="btn btn-primary"  type="submit" name="registrar" value="Registrar" />
        </div>

    </div>


    </form>
</div>
