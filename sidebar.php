<div class="sidebar">
    <form action="activos.php" method="get">
        <button type="submit" class="sidebar-btn">Clientes Activos</button>
    </form>

    <form action="inactivos.php" method="get">
        <button type="submit" class="sidebar-btn">Clientes Inactivos</button>
    </form>

    <hr>

    <form action="exportar.php" method="post">
        <input type="hidden" name="formato" value="csv">
        <input type="hidden" name="estado" value="activo">
        <button type="submit" class="sidebar-btn">Exportar CSV</button>
    </form>

    <form action="exportar.php" method="post">
        <input type="hidden" name="formato" value="word">
        <input type="hidden" name="estado" value="activo">
        <button type="submit" class="sidebar-btn">Exportar Word</button>
    </form>

    <form action="exportar.php" method="post">
        <input type="hidden" name="formato" value="imprimir">
        <input type="hidden" name="estado" value="activo">
        <button type="submit" class="sidebar-btn">Imprimir</button>
    </form>
</div>

