<!-- Archivo: application/views/login.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>

    <h2>Iniciar Sesión</h2>
    <form method="post" action="<?=site_url('../../webservice/usuarios/acceso')?>">
        <label for="correo">Correo:</label>
        <input type="text" name="correo" required>
        <br>
        <label for="contrasenia">Contraseña:</label>
        <input type="password" name="pass" required>

        <br>

        <button type="submit">Iniciar Sesión</button>
    </form>
    <?php
    if($this->session->userdata('user')){
        redirect('frontend');
    }else{
        echo 'credenciales invalidas';
    }
    /*if ($this->session->userdata('resultado_acceso')){

    }*/

    //echo var_dump($this->session->userdata('resultado_acceso'));
    //redirect('acceso/cierrasesion');
    // Verificar si la variable de sesión existe y su resultado es true
    /*if ($this->session->userdata('resultado_acceso') && $this->session->userdata('resultado_acceso')['resultado']) {
        echo '<p>El acceso fue exitoso. Puedes mostrar mensajes u otras acciones aquí.</p>';
        // También puedes acceder a otros datos en $this->session->userdata('resultado_acceso')['data']
    }*/
    ?>

</body>
</html>
