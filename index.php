<?php
require 'process.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Registros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="text-center mb-4">Gestión de Registros</h1>
    <div class="container p-3 mb-2 bg-danger text-white bg-gradient">
        <form method="get" action="index.php" class="d-flex mb-4">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nombre" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    <!-- Formulario para agregar un nuevo registro -->
    <div class="container p-3 mb-2 bg-danger text-white bg-gradient">
        <form method="post" action="process.php" class="mb-4">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" class="form-control" placeholder="Descripción" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
        </form>
    </div>
    <form id="editForm" method="post" action="process.php" style="display: none;" class="card p-4 mb-4">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" id="editId">
        <div class="container p-3 mb-2 bg-danger text-white bg-gradient">
            <label for="editName" class="form-label">Nombre</label>
            <input type="text" name="name" id="editName" class="form-control" placeholder="Nombre" required>
        </div>
        <div class="container p-3 mb-2 bg-danger text-white bg-gradient">
            <label for="editDescription" class="form-label">Descripción</label>
            <textarea name="description" id="editDescription" class="form-control" placeholder="Descripción" required></textarea>
        </div>
        <div class="container p-3 mb-2 bg-danger text-white bg-gradient">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <button type="button" class="btn btn-secondary" onclick="hideEditForm()">Cancelar</button>
        </div>
    </form>
    <div class="container p-3 mb-2 bg-danger text-white bg-gradient">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['name']); ?></td>
                    <td><?php echo htmlspecialchars($record['description']); ?></td>
                    <td><?php echo $record['created_at']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="showEditForm(<?php echo $record['id']; ?>, '<?php echo htmlspecialchars($record['name']); ?>', '<?php echo htmlspecialchars($record['description']); ?>')">Editar</button>
                        <a href="process.php?action=delete&id=<?php echo $record['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este registro?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer class="container p-3 mb-2 bg-dark text-white bg-gradient">
        <ul class="list-unstyled">
            <li>Conceptualización de servicios en la nube</li>
            <li>HECTOR ALEJANDRO ZUBIRIA PEREZ</li>
            <li>222959514</li>
            <li>Awexzubiria@gmail.com</li>
        </ul>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showEditForm(id, name, description) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('editId').value = id;
