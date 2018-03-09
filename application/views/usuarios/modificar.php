<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="icon fa fa-edit"></i> Editar Usuario
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" maxlength="255" class="form-control" value="<?=$usuario['user']?>" id="usuario" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" maxlength="255" class="form-control" id="password"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar Contraseña</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" maxlength="255" class="form-control" id="password2"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" maxlength="255" class="form-control" value="<?=$usuario['email']?>" id="email"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" maxlength="255" class="form-control" value="<?=$usuario['first_name']?>" id="nombre" required> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" maxlength="255" class="form-control" value="<?=$usuario['last_name']?>" id="apellido" required> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Perfil</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="perfil" class="form-control chosen">
                                <?php foreach($perfiles as $p) { ?>
                                <option value="<?=$p['idperfil']?>"<?=($perfil['idperfil']==$p['idperfil'])?" selected":""?>><?=$p['perfil']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="idusuario" value="<?=$usuario['user_id']?>">
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button onclick="modificar();" class="btn btn-success">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="/assets/js/usuarios/modificar.js"></script>