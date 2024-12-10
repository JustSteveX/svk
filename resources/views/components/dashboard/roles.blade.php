@props(['roleList' => []])

<div x-data='roleManager({
        roles: @json($roleList),
        permissions: @json(config('permissions')),
    })' class="p-4 max-w-lg mx-auto">
    <h1 class="text-lg font-bold mb-4">Rollenverwaltung</h1>

    <!-- Rollen-Select -->
    <div class="relative">
        <input
            type="text"
            placeholder="Rolle auswählen oder neue Rolle erstellen..."
            x-model="roleInput"
            @click="showDropdown = true"
            @input="handleInputChange()"
            class="w-full p-2 border"
        >
        <ul
            x-show="showDropdown"
            @click.away="closeDropdown()"
            class="absolute bg-white border rounded-md w-full mt-1 z-10 shadow-md max-h-40 overflow-y-auto"
        >
            <template x-for="(role, index) in filteredRoles" :key="index">
                <li
                    @click="selectRole(role)"
                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                >
                    <span x-text="role.rolename"></span>
                </li>
            </template>
            <li x-show="filteredRoles.length === 0" class="px-4 py-2 text-gray-500">Keine Rollen gefunden</li>
        </ul>

        <span class="absolute top-[6px] right-[6px] text-primary">
          <button x-show="!roleExists && showDropdown && roleInput.length > 0" class="rounded-full hover:bg-gray-500/50 transition-all" @click="createNewRole(); showDropdown = false; event.preventDefault()"><x-bi-plus class="w-8 h-8"></x-bi-plus></button>
          <button x-show="roleExists" class="rounded-full hover:bg-gray-500/50 transition-all" @click="resetForm()"><x-eos-close class="w-8 h-8"></x-eos-close></button>
        </span>
    </div>

    <!-- Permissions Checkboxen -->
    <div class="mt-4">
        <h2 class="text-sm font-semibold mb-2">Berechtigungen:</h2>
        <div class="grid grid-cols-2 gap-2">
            <template x-for="(permissionName, index) in Object.keys(permissions)" :key="index">
                <label class="flex items-center space-x-2">
                    <input
                        type="checkbox"
                        :checked="currentPermissions.includes(permissionName)"
                        @change="togglePermission(permissionName)"
                    >
                    <span x-text="permissionName" class="text-sm"></span>
                </label>
            </template>
        </div>
    </div>

    <!-- Speichern Button -->
    <div class="mt-4">
      <x-primary-button @click="saveRole()">Speichern</x-primary-button>
    </div>
</div>

<script>
function roleManager({ roles, permissions }) {
    return {
        roles,
        permissions,
        currentRole: null,
        roleInput: '',
        currentPermissions: [], // Array von Berechtigungsnamen
        filteredRoles: roles,
        showDropdown: false,
        roleExists: false,

        filterRoles() {
            this.filteredRoles = this.roles.filter(role =>
                role.rolename.toLowerCase().includes(this.roleInput.toLowerCase())
            );
        },

        selectRole(role) {
            this.currentRole = role;
            this.roleInput = role.rolename;
            this.currentPermissions = role.permissions || []; // Übernimmt die Berechtigungsnamen
            this.showDropdown = false;
            this.roleExists = true;
        },

        togglePermission(permissionName) {
            if (this.currentPermissions.includes(permissionName)) {
                // Entferne Berechtigung
                this.currentPermissions = this.currentPermissions.filter(p => p !== permissionName);
            } else {
                // Füge Berechtigung hinzu
                this.currentPermissions.push(permissionName);
            }
        },

        saveRole() {
            const newRole = {
                id: this.currentRole?.id ?? null,
                name: this.roleInput,
                permissions: this.currentPermissions, // Nur die Strings werden gesendet
            };

            const endpoint = '{{route('role.create')}}';

            axios.post(endpoint, newRole)
                .then(response => {
                    location.reload(); // Erfolgreiches Speichern
                })
                .catch(error => {
                    alert('Fehler beim Speichern der Rolle.'); // Fehlerbehandlung
                });
        },

        resetForm() {
            this.currentRole = null;
            this.roleInput = '';
            this.currentPermissions = [];
            this.showDropdown = false;
            this.roleExists = false;
        },

        closeDropdown() {
            setTimeout(() => {
                this.showDropdown = false;
            }, 100);
        },

        handleInputChange() {
            this.currentRole = null;
            this.currentPermissions = [];
            this.filterRoles();
        },

        createNewRole() {
            this.currentRole = null;
            this.currentPermissions = [];
            this.filteredRoles = [];
            this.roleInput = this.roleInput.trim();
            this.roleExists = true;
        },
    };
}
</script>
