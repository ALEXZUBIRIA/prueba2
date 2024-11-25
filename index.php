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
<body>     <div class="container my-5">
    <h2 class="text-center mb-4">Servicios en la Nube</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <div class="col">
        <div class="card h-100">
          <div class="card-body text-center">
            <h5 class="card-title">AWS</h5>
            <p class="card-text">Amazon Web Services ofrece soluciones de nube para empresas y desarrolladores.</p>
            <a href="https://aws.amazon.com/" target="_blank" class="btn btn-primary">Visitar AWS</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body text-center">
            <h5 class="card-title">Google Cloud</h5>
            <p class="card-text">Plataforma de nube escalable de Google con servicios de IA y almacenamiento.</p>
            <a href="https://cloud.google.com/" target="_blank" class="btn btn-primary">Visitar Google Cloud</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body text-center">
            <h5 class="card-title">Microsoft Azure</h5>
            <p class="card-text">Infraestructura de nube de Microsoft para empresas y desarrolladores.</p>
            <a href="https://azure.microsoft.com/" target="_blank" class="btn btn-primary">Visitar Azure</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body text-center">
            <h5 class="card-title">Railway</h5>
            <p class="card-text">Plataforma para implementar y gestionar aplicaciones fácilmente.</p>
            <a href="https://railway.app/" target="_blank" class="btn btn-primary">Visitar Railway</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body text-center">
            <h5 class="card-title">Heroku</h5>
            <p class="card-text">Plataforma simple para desplegar y gestionar aplicaciones en la nube.</p>
            <a href="https://www.heroku.com/" target="_blank" class="btn btn-primary">Visitar Heroku</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body text-center">
            <h5 class="card-title">DigitalOcean</h5>
            <p class="card-text">Soluciones de nube fáciles de usar para desarrolladores.</p>
            <a href="https://www.digitalocean.com/" target="_blank" class="btn btn-primary">Visitar DigitalOcean</a>
          </div>
        </div>
      </div>
    </div>
  </div>
    <h1 class="text-center mb-4">Gestión de Registros</h1>
    <div class="container p-3 mb-2 bg-danger text-white bg-gradient">
        <form method="get" action="index.php" class="d-flex mb-4">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nombre" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
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
            document.getElementById('editName').value = name;
            document.getElementById('editDescription').value = description;
        }
        function hideEditForm() {
            document.getElementById('editForm').style.display = 'none';
        }
    </script>
</body>
</html>
