<?php require_once '../../modelo/receta.php'; 
$Id = $_GET['id'] ?? null;
$receta = $Id ? Receta::obtenerPorId($Id) : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Receta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Detalle de Receta</h1>

                <?php if ($receta): ?>
                <div class="card">
                    <div class="card-body">
                        <p><strong>ID:</strong> <?php echo $receta->Id; ?></p>
                        <p><strong>Nombre:</strong> <?php echo $receta->Nombre; ?></p>
                        <p><strong>Ingrediente:</strong> <?php echo $receta->Ingrediente; ?></p>
                        <p><strong>Tiempo Preparacion:</strong> <?php echo $receta->TiempoPreparacion; ?></p>
                        <p><strong>Porciones:</strong> <?php echo $receta->Porciones; ?></p>
                        <p><strong>Dificultad:</strong> <?php echo $receta->Dificultad; ?></p>
                        <p><strong>Calorias:</strong> <?php echo $receta->Calorias; ?></p>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="listar.php" class="btn btn-secondary">Volver</a>
                    <a href="editar.php?id=<?php echo $receta->Id; ?>" class="btn btn-warning">Editar</a>
                </div>
                <?php else: ?>
                <div class="alert alert-danger">Receta no encontrada</div>
                <a href="listar.php" class="btn btn-secondary">Volver</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
