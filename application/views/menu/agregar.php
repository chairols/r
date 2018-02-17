<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="icon fa fa-plus-square"></i> Nuevo Menú
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Título</h3>
            </div>
            <div class="box-body">
                <form method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ícono</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" maxlength="50" class="form-control" name="icono" placeholder="fa fa-plus-square" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Menú</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" maxlength="50" class="form-control" name="menu" placeholder="Menú-Agregar" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Título</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" maxlength="100" class="form-control" name="titulo" placeholder="Nuevo Menú" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Href</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" maxlength="100" class="form-control" name="href" placeholder="/menu/agregar/" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Orden</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" maxlength="11" class="form-control" name="orden" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Padre</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="padre" class="form-control chosen">
                                <option value="0" selected>--- No tiene ---</option>
                                <?php foreach($padres as $padre) { ?>
                                <option value="<?=$padre['idmenu']?>"><?=$padre['titulo']?></option>
                                <?php foreach($padre['hijos'] as $hijo) { ?>
                                <option value="<?=$hijo['idmenu']?>">↳ <?=$padre['titulo']?> → <?=$hijo['titulo']?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Visible</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="checkbox" class="icheckbox_minimal-blue" name="visible">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Agregar</button>
                            <button type="reset" class="btn btn-primary">Limpiar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>




<script type="text/javascript" src="/assets/js/menu/agregar.js"></script>