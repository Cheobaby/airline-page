<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<objapi-rest>
    <resultado><?= $resultado ? "true" : "false" ?></resultado>
    <mensaje><?= $mensaje ?></mensaje>

<?php
foreach($promociones as $row) :
?>
    <promocion>
<?php
    foreach($row as $campo => $valor) :
?>
        <<?= $campo ?>><?= $valor ?></<?= $campo ?>>
<?php
    endforeach;
?>
    </promocion>
<?php
endforeach;
?>

</objapi-rest>