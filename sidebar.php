<div class="sidebar">
    <a href="activos.php">
        <button>Clientes Activos</button>
    </a>
    <a href="inactivos.php">
        <button>Clientes Inactivos</button>
    </a>

    <hr>

    <form action="exportar.php" method="POST">
        <input type="hidden" name="formato" value="csv">
        <button type="submit">Exportar CSV</button>
    </form>

    <form action="exportar.php" method="POST">
        <input type="hidden" name="formato" value="word">
        <button type="submit">Exportar Word</button>
    </form>

    <form action="exportar.php" method="POST">
        <input type="hidden" name="formato" value="imprimir">
        <button type="submit">Imprimir</button>
    </form>
</div>
