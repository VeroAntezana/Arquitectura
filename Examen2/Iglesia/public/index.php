    <?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once('../app/controladores/CHome.php');
    require_once('../app/controladores/CCargo.php');
    require_once('../app/controladores/CMinisterio.php');
    require_once('../app/controladores/CTipoRelacion.php');
    require_once('../app/controladores/CUsuario.php');
    require_once('../app/controladores/CParentesco.php');
    require_once('../app/controladores/CEvento.php');
    require_once('../app/controladores/CRegistroEvento.php');
    require_once('../app/controladores/CDetalleEvento.php');
    require_once('../app/adapters/CertificadoTarget.php');
    require_once('../app/adapters/PDFAdapter.php');
    require_once('../app/adapters/HTMLAdapter.php');
    require_once('../app/adapters/ImagenAdapter.php');


  
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/menu') {
        $menu = new CHome();
        $menu->menu();
        return;
    }

    /*CARGOS */

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/cargos') { // Cambiado a '/cargos'
        $cargo = new CCargo(); 
        $cargo->listarCargosC(); // Cambiado a listar
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/cargos') { // Cambiado a '/cargos'
        $cargo = new CCargo(); 
        
        $cargo->crearCargoC($_POST['nombre'], $_POST['descripcion'], $_POST['ministerio']); // Cambiado a crear
        
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_cargo') { // Cambiado a '/eliminar_cargo'
        $cargo = new CCargo(); 
        $cargo->eliminarCargoC($_POST['id']); // Cambiado a eliminarCargoC
        // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_cargo\?id=\d+/', $_SERVER['REQUEST_URI'])) { // Cambiado a '/editar_cargo'
        
        $params = $_GET;
        $id = $params['id'];

        $cargo = new CCargo(); 
        $cargo->updateCargoC($id); // Cambiado a mostrarFormularioEdicionC
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_cargo') { 
        $cargo = new CCargo(); 
        $cargo->editarCargoC($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['ministerio']); // Cambiado a editarCargoC
            
        return;
    }

    /*MINISTERIOS */
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/ministerios') { // Cambiado a '/cargos'
        $ministerio = new CMinisterio(); 
        $ministerio->listarMinisteriosC(); // Cambiado a listar
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/ministerios') { // Cambiado a '/cargos'
        $ministerio = new CMinisterio(); 
        
        $ministerio->crearMinisterioC($_POST['nombre'], $_POST['descripcion']); // Cambiado a crear
        
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_ministerio') { // Cambiado a '/eliminar_cargo'
        $ministerio = new CMinisterio(); 
        $ministerio->eliminarMinisterioC($_POST['id']); // Cambiado a eliminarCargoC
        // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_ministerio\?id=\d+/', $_SERVER['REQUEST_URI'])) { // Cambiado a '/editar_cargo'
        
        $params = $_GET;
        $id = $params['id'];

        $ministerio = new CMinisterio(); 
        $ministerio->updateMinisterioC($id); // Cambiado a mostrarFormularioEdicionC
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_ministerio') { 
        $ministerio = new CMinisterio(); 
        $ministerio->editarMinisterioC($_POST['id'], $_POST['nombre'], $_POST['descripcion']); // Cambiado a editarCargoC
            
        return;
    }

    /*TIPO_RELACION */

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/tipo_relacion') {
        $tipo_relacion = new CTipoRelacion();
        $tipo_relacion->listarTipoRelacionC();
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/tipo_relacion') {
        $tipo_relacion = new CTipoRelacion();
        $tipo_relacion->crearTipoRelacionC($_POST['nombre']);
        
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_tipo_relacion') {
        $categoria = new CTipoRelacion();
        $categoria->eliminarTipoRelacionC($_POST['id']);
        // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
        return;
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_tipo_relacion\?id=\d+/', $_SERVER['REQUEST_URI'])) {
        
        $params = $_GET;
        $id = $params['id'];

        $categoria = new CTipoRelacion();
        $categoria->updateTipoRelacionC($id);
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_tipo_relacion') {
        $categoria = new CTipoRelacion();
        $categoria->editarTipoRelacionC($_POST['id'], $_POST['nombre']);
            
        return;
    }
    if ($_SERVER['REQUEST_URI'] == '/') {
        header("Location: /login");
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/login') { // entra a la vista de Login
        $cargo = new CUsuario(); 
        $cargo->IniciarSesion(); 
        return;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/verificar') {
        $usuario = new CUsuario();
        $usuario->login($_POST['identificador'], $_POST['password']);
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/verificarCorreo') { 
        $cargo = new CUsuario(); 
        $cargo->LoginUsuario($_POST['identificador'], $_POST['password']); 
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/verificarTelefono') { 
        $cargo = new CUsuario(); 
        $cargo->LoginCelular($_POST['identificador'], $_POST['password']); 
        return;
    }
    /** USUARIO*/
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/usuarios') { // Cambiado a '/cargos'
        $cargo = new CUsuario(); 
        $cargo->listarUsuariosC(); 
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/usuarios') { 
        $cargo = new CUsuario(); 
        $cargo->agregarUsuarioC($_POST['nombre'], $_POST['apellido'], $_POST['fechanacimiento'], $_POST['ci'], $_POST['telefono'], $_POST['cargo']); // Cambiado a agregarCargoC
        
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_usuario') { // Cambiado a '/eliminar_cargo'
        $cargo = new CUsuario(); 
        $cargo->eliminarUsuarioC($_POST['id']); // Cambiado a eliminarCargoC
        // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_usuario\?id=\d+/', $_SERVER['REQUEST_URI'])) { // Cambiado a '/editar_cargo'
        
        $params = $_GET;
        $id = $params['id'];

        $cargo = new CUsuario(); 
        $cargo->updateUsuarioC($id); // Cambiado a mostrarFormularioEdicionC
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_usuario') { // Cambiado a '/actualizar_cargo'
        $cargo = new CUsuario(); 
        $cargo->editarUsuarioC($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['fechanacimiento'], $_POST['ci'], $_POST['telefono'], $_POST['cargo']); // Cambiado a editarCargoC
            
        return;
    }

    /**PARENTESCOS */
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/parentescos') {
        $relacion = new CParentesco();
        $relacion->listarParentescosC();
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/parentescos') {
        $relacion = new CParentesco();
        $relacion->agregarParentescoC($_POST['usuarioA'], $_POST['usuarioB'], $_POST['tipoRelacionA']);
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_parentesco') {
        $relacion = new CParentesco();
        $relacion->eliminarRelacionC($_POST['id']);
        // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_parentesco\?id=\d+/', $_SERVER['REQUEST_URI'])) {
        $params = $_GET;
        $id = $params['id'];
        $relacion = new CParentesco();
        $relacion->updateRelacionC($id);
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_parentesco') {
        $relacion = new CParentesco();
        $relacion->editarRelacionC($_POST['id'], $_POST['usuarioA'], $_POST['usuarioB'], $_POST['tipoRelacionA']);
        return;
    }

    /*EVENTOS */

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/eventos') { 
        $evento = new CEvento(); 
        $evento->listarEventosC(); // Cambiado a listar
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eventos') { 
        $evento = new CEvento(); 
        
        $evento->crearEventoC($_POST['nombre'], $_POST['descripcion']); 
        
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_evento') { 
        $evento = new CEvento(); 
        $evento->eliminarEventoC($_POST['id']); 
        // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_evento\?id=\d+/', $_SERVER['REQUEST_URI'])) { // Cambiado a '/editar_cargo'
        
        $params = $_GET;
        $id = $params['id'];

        $evento = new CEvento(); 
        $evento->updateEventoC($id); // Cambiado a mostrarFormularioEdicionC
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_evento') { 
        $evento = new CEvento(); 
        $evento->editarEventoC($_POST['id'], $_POST['nombre'], $_POST['descripcion']); // Cambiado a editarCargoC
            
        return;
    }

    /*REGISTRO DE EVENTOS */

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/registro_evento') { // Cambiado a '/cargos'
        $registro = new CRegistroEvento(); 
        $registro->listarRegistroEventosC(); // Cambiado a listar
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/registro_evento') { // Cambiado a '/cargos'
        $registro = new CRegistroEvento(); 
        
        $registro->crearRegistroEventoC($_POST['lugar'], $_POST['nota'], $_POST['fecha'],$_POST['evento']); // Cambiado a crear
        
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_registro_evento') { // Cambiado a '/eliminar_cargo'
        $registro = new CRegistroEvento(); 
        $registro->eliminarRegistroEventoC($_POST['id']); // Cambiado a eliminarCargoC
        // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_registro_evento\?id=\d+/', $_SERVER['REQUEST_URI'])) { // Cambiado a '/editar_cargo'
        
        $params = $_GET;
        $id = $params['id'];

        $registro = new CRegistroEvento(); 
        $registro->updateRegistroEventoC($id); // Cambiado a mostrarFormularioEdicionC
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_registro_evento') { 
        $registro = new CRegistroEvento(); 
        $registro->editarRegistroEventoC($_POST['id'], $_POST['lugar'], $_POST['nota'], $_POST['fecha'], $_POST['evento']); // Cambiado a editarCargoC
            
        return;
    }

    /**DETALLE EVENTO */
   
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/agregar_usuario\?id=\d+/', $_SERVER['REQUEST_URI'])) {
        $params = $_GET;
        $id = (int)$params['id']; // Convertir a entero
        $detalleEvento = new CRegistroEvento(); 
        $detalleEvento->agregarUsuario($id);
        return;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/guardar_usuario_detalle_evento') {
        $detalleEvento = new CRegistroEvento(); 
        $detalleEvento->guardarUsuarioDetalleEvento((int)$_POST['registro_evento_id'], (int)$_POST['usuario_id']); // Convertir a entero
        return;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/ver_usuarios\?id=\d+/', $_SERVER['REQUEST_URI'])) {
        $params = $_GET;
        $id = (int)$params['id']; // Convertir a entero
        $detalleEvento = new CRegistroEvento(); 
        $detalleEvento->verUsuariosDetalleEvento($id);
        return;
    }
//Certificados
if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/ver_certificado\?id=\d+&formato=(pdf|html|imagen)&accion=mostrar/', $_SERVER['REQUEST_URI'])) {
    $params = $_GET;
    $id = (int)$params['id'];
    $formato = $params['formato'];
    $registro = new CRegistroEvento();
    $registro->mostrarFormularioCertificado($id, $formato);
    return;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/descargar_certificado\?id=\d+&formato=(pdf|html|imagen)/', $_SERVER['REQUEST_URI'])) {
    $params = $_GET;
    $id = (int)$params['id'];
    $formato = $params['formato'];
    $registro = new CRegistroEvento();
    $registro->downloadCertificado($id, $formato);
    return;
}






