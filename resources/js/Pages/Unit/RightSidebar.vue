<!-- RightSidebar.vue -->
<script setup>

const props = defineProps({
    unitUsers: {
        type: Array,
        default: () => [],
    },
    unitName: {
        type: String,
        default: "",
    },
});
console.log("props.unitUsers", props.unitUsers);
console.log("props.unitName", props.unitName);
</script>

<template>
    <div
        class="right-sidebar desktop-only bg-gray-100 w-56 h-screen p-4 shadow-lg"
    >
        <h2 class="text-lg font-bold mb-4">
            {{ unitName + "職員" || "部署メンバー" }}
        </h2>
        <ul v-if="unitUsers && unitUsers.length > 0">
            <li
                v-for="user in unitUsers"
                :key="user.id"
                class="mb-2 p-2 rounded hover:bg-gray-200 cursor-pointer flex items-center space-x-4 font-bold"
                @click="$emit('user-selected', user)"
            >
                <img
                    v-if="user.icon"
                    :src="
                        user.icon.startsWith('/storage/')
                            ? user.icon
                            : `/storage/${user.icon}`
                    "
                    alt="User Icon"
                    class="w-12 h-12 rounded-full"
                />
                <img
                    v-else
                    src="https://via.placeholder.com/40"
                    alt="Default Icon"
                    class="w-12 h-12 rounded-full"
                />
                <span>{{ user.name }}</span>
            </li>
        </ul>
        <p v-else>メンバーが見つかりません。</p>
    </div>
</template>

<style scoped>
.right-sidebar {
    padding: 16px;
    background-color: #f8f9fa;
    position: fixed;
    right: 0;
    top: 0;
    background-color: #f7fafc;
}

/* デスクトップ画面にのみ表示 */
.desktop-only {
    display: block;
}

@media (max-width: 1366px) {
    /* モバイル画面では非表示 */
    .desktop-only {
        display: none;
    }
}
</style>
