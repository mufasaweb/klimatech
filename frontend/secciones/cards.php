<?php
foreach ($rutas as $ruta):
    $fecha = $ruta['fecha'];
    $ruta_id = $ruta['id'] ?? null;
    if (!$ruta_id) continue;

    $stmtV = $mysqli->prepare(
        "SELECT v.*, c.nombre AS nombre_cliente, c.direccion AS direccion_cliente, c.telefono, c.email
        FROM visitas v
        JOIN clientes c ON v.cliente_id = c.id
        WHERE v.ruta_id = ? AND v.tecnico_id = ?
        ORDER BY v.orden ASC"
    );
    $stmtV->bind_param("ii", $ruta_id, $usuario_id);
    $stmtV->execute();
    $visitas = $stmtV->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmtV->close();

    if (empty($visitas)) continue;
?>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <strong>
                <?= fechaConDia($fecha); ?>
            </strong>
        </div>
        <div class="card-body">
            <h6 class="card-title mb-3"><i class="bi bi-diagram-3"></i> Visitas asignadas</h6>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Realizado</th>
                            <th>Datos</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($visitas as $idx => $v): 
                        $modalId = "datosClienteModal_" . $ruta_id . "_" . $v['id'];
                    ?>
                        <tr>
                            <td><?= $v['orden'] ?></td>
                            <td><?= htmlspecialchars($v['nombre_cliente']) ?></td>
                            <td>
                                <?php if ($v['realizado']): ?>
                                    <span class="badge bg-success">Sí</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">No</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#<?=$modalId?>">
                                    Ver
                                </button>
                                <!-- Modal de datos del cliente -->
                                <div class="modal fade" id="<?=$modalId?>" tabindex="-1" aria-labelledby="<?=$modalId?>Label" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title" id="<?=$modalId?>Label">
                                            Datos del Cliente
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                      </div>
                                      <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Nombre:</strong> <?=htmlspecialchars($v['nombre_cliente'])?></li>
                                            <li class="list-group-item"><strong>Dirección:</strong> <?=htmlspecialchars($v['direccion_cliente'])?></li>
                                            <li class="list-group-item"><strong>Teléfono:</strong> <?=htmlspecialchars($v['telefono'])?></li>
                                            <li class="list-group-item"><strong>Email:</strong> <?=htmlspecialchars($v['email'])?></li>
                                        </ul>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <!-- Botón realizar informe -->
                                        <a href="informe.php?visita_id=<?=$v['id']?>" class="btn btn-success">
                                            Realizar informe
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Bootstrap Bundle JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>