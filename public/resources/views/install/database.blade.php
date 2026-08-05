<x-layouts.install title="Configuración de Base de Datos" step="2">
    <div class="space-y-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Configuración de Base de Datos</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Configura la conexión a tu base de datos. Se recomienda MySQL 8.0+ para producción.
            </p>
        </div>

        <form method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="db_connection" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Base de Datos</label>
                <select id="db_connection" name="db_connection" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" onchange="toggleDbFields()">
                    <option value="sqlite">SQLite (Desarrollo)</option>
                    <option value="mysql" selected>MySQL / MariaDB (Producción)</option>
                    <option value="pgsql">PostgreSQL</option>
                </select>
            </div>

            <div id="db-fields">
                <div>
                    <label for="db_host" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Host</label>
                    <input type="text" id="db_host" name="db_host" value="127.0.0.1" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                </div>

                <div>
                    <label for="db_port" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Puerto</label>
                    <input type="number" id="db_port" name="db_port" value="3306" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                </div>

                <div>
                    <label for="db_database" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de la Base de Datos</label>
                    <input type="text" id="db_database" name="db_database" value="tg_paygate" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                </div>

                <div>
                    <label for="db_username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Usuario</label>
                    <input type="text" id="db_username" name="db_username" value="root" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                </div>

                <div>
                    <label for="db_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contraseña</label>
                    <input type="password" id="db_password" name="db_password" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Dejar vacío si no tiene contraseña</p>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-4 rounded-lg transition-colors text-center">
                    Configurar y Continuar
                </button>
            </div>
        </form>
    </div>
</x-layouts.install>

<script>
function toggleDbFields() {
    const connection = document.getElementById('db_connection').value;
    const fields = document.getElementById('db-fields');
    if (connection === 'sqlite') {
        fields.style.display = 'none';
    } else {
        fields.style.display = 'block';
    }
}
document.addEventListener('DOMContentLoaded', toggleDbFields);
</script>