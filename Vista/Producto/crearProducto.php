<?php
$alert = 0;
if (isset($_POST["Crear"])) {
    $producto = new Producto("", $_POST["Nombre"], $_POST["Cantidad"],$_POST["Precio"],$_POST["Imagen"]);
    if($producto -> validarProducto()){
        $alert = 1;
    }else{
        $alert = 2;
        $producto->crearProducto();
    }    
}
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    <h4>Crear Producto</h4>
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-3">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAclBMVEX///8AAAC6urrIyMhFRUX8/Px3d3c8PDxQUFBMTExJSUnExMT29vZ0dHRubm6/v7+BgYHv7+9paWnZ2dmxsbEICAiPj4/p6ekYGBhiYmJTU1PT09MvLy8RERGmpqYdHR03NzeampqsrKwlJSWRkZFbW1tfL2LEAAAEq0lEQVR4nO2daVvqMBBGE6QiyF4WwQVB/f9/8YpYoWvSks7Cfc9X8mgOmemkQKbGAAAAAICYWTyJZ9yTaJF482qtfd3E3BNpi6lNmHJPpRWigT0ziLin0wKXgt+K3NMJTvRg0zzc2CpGfZulf1OK0SAneFu5WLCCN7aK2Rz8y0XuiQWiMERvKlC7pYLWdrknF4BcmcgEqv5VrBbUn4sVOXgjuVhcJtL0uSd5Da4Q1R6oJYW+YBW1Bqo7BxN03mk4ykQmUDWuYh1BjbkYVe1kiuhqW0X/HEzQlYu1cjBBVS42EdSUix5btWK0bOC8C30eJaW/WYie0BCojUP0hIJArVsHs0i/629UJtIILxrXC8rOxdpbtWIEb+Cuu8ickbqBC5CDCTJz8YpCn0di6b+yDmaRVxeDruARcasYLgcTZBWNwCF6QlSghqmDWeRs4AKWiTRiikZbglJysZUcTBCRi20KitjAtReiJ7gDNXihz8Nc+tsN0ROcgdpamUjDWDRoBPlysdUykYapaNAJ8uQiUQ4mMOQirSB9LhLmYAJxLm7JBa3dUgpO3fNpAcJf+D+zCFr7TGZ4z2R4TyUYvTAZvlBdbIZMgtYOiQxnbIZUh8KGr0yCr1RraL6YDL+oBM0bk+EbmSHTxZTsUvpNzGJIejDzjkHwjlKQQ5FY0JhHx4R28+n8yXf23S/ndzuP1IKuVdwci/Ns5OU3OCZYXF2CyFfwSNUqzn/HbDwEe79j5xVjGFbwSPkqjpIhaw/Dv0tk+YqzrOCRslUcnYe4U/HpPLhMkWkFjxQrji9GuL8dvvymdyxNsFjxUrCmYaEiq2CR4ij1ek3DgkBlFswrpgVrG+YU2QWzivPMq7UNM0VDgGC6aOQ+K6pvmPqci61MpIl7yYTyN3ANDM+3nz05bV4Wm51ddlfr/CtNDM161V3a3WbR/sTrEBXfnjYyLP9zAmlqqAcYwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwz1G7o7Zal+zIypPq51Ivvrfm2snIYr7ileifusqZADB42J3h2C72p+sl7GxGE44Z7g9ewrBfeEM4myhPrDi12p3y7YoRHH7KPOeNvLMdiuwjT1GR7GRU0YXsaHMJ08nlfbQX7623HnT3OxLH2T+wUHfRqRe4+Dxci6fFOx/A2R6rZWdL2ZmlHds+qnedahcghd15tmuLoBHTxaIo3c/4YRZ0+DoXMJrQ2Vim3gPu9/8Oh6ILkmu/YT1m7Mh3OM5K2xe2P/YcorRQJhM7/auNsbLo1zCF2nuwZ4dP+DIQyZgSEMYcgPDGEIQ35gCEMY8gNDGMKQHxj6GUr+0Nujja+HIfez3arweJ6Ph6Hgj/V9mvj6GA7IHklQk6HPE4t8DK3dd+7k0dl7zd3PUDMw1A8M9QND/cBQPzDUDwz1A0P9wFA/MNQPDPUDQ/3AUD//gaH3kzSV8mR67kGq6ZlP7im0zCfTw4vpiP0ehqqXjTFm5j41o5flz9nCmetAuV7ek8OTb+7+HBrpXj6scB1POrfFJJb7AwsAAACAnH/1OmMQfIjyjgAAAABJRU5ErkJggg==" width="100%" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Producto/crearProducto.php") ?>" method="POST">
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="Cantidad">Cantidad</label>
                                    <input type="number" class="form-control" name="Cantidad" id="Cantidad">
                                </div>
                                <div class="form-group">
                                    <label for="Precio">Precio</label>
                                    <input type="number" class="form-control" name="Precio" id="Precio">
                                </div>
                                <div class="form-group">
                                    <label for="Imagen">Direccion de Imagen</label>
                                    <input type="text" class="form-control" name="Imagen" id="Imagen">
                                </div>
                                <div class="form-group text-center">
                                    <input name="Crear" type="submit" class="btn btn-outline-dark" value="Crear">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($alert==1) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-danger m-0 d-flex'>";
    echo "<h5 class='modal-title flex-grow-1' id='exampleModalLabel'>Ya existe un producto con ese nombre nombre</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}else if($alert == 2){
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='modal-header alert alert-succes m-0 d-flex'>";
    echo "<h5 class='modal-title flex-grow-1' id='exampleModalLabel'>Producto creado correctamente</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>