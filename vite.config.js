import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/sweet-alert.css',
                'resources/js/app.js',
                'resources/js/sweet-alert.js',
                'resources/js/delUser.js',
                'resources/js/delRole.js',
                'resources/js/delPermission.js',
                'resources/js/setPermissions.js',
                'resources/js/setPerPages.js',
                'resources/js/setPermission2Roles.js',
                'resources/js/setRoles.js',
                'resources/js/setUser2Roles.js',
                'resources/js/setUser2Permissions.js',
                'resources/js/manageTable.js',
                'resources/js/manageFormTable.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
