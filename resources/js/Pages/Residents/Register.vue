<script setup>
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    units: Array,
});

const form = useForm({
    name: "",
    unit_id: "",
});

const submit = () => {
    form.post(route("residents.store"));
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $t("Resident Registration") }}
            </h2>
        </template>
        <Head :title="$t('Resident Registration')" />
        <div
            class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8 mt-16"
        >
            <!-- 利用者登録フォーム -->
            <form
                @submit.prevent="submit"
                class="bg-white p-6 rounded-lg shadow"
            >
                <div class="mb-4">
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ $t("Resident Name") }}
                    </label>
                    <input
                        type="text"
                        id="name"
                        v-model="form.name"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500"
                        placeholder="利用者名を入力してください"
                    />
                    <div
                        v-if="form.errors.name"
                        class="text-red-600 text-sm mt-1"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        for="unit_id"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ $t("Unit") }}
                    </label>
                    <select
                        id="unit_id"
                        v-model="form.unit_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500"
                        placeholder="所属部署を選択してください"
                    >
                        <option value="" disabled selected>
                            {{ $t("Select your unit") }}
                        </option>
                        <option
                            v-for="unit in units"
                            :key="unit.id"
                            :value="unit.id"
                        >
                            {{ unit.name }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.unit_id"
                        class="text-red-600 text-sm mt-1"
                    >
                        {{ form.errors.unit_id }}
                    </div>
                </div>

                <button
                    type="submit"
                    class="bg-blue-100 text-blue-700 font-medium py-2 px-4 rounded-md transition hover:bg-blue-300 hover:text-white focus:outline-none focus:shadow-outline"
                >
                    {{ $t("Register Resident") }}
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
