<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { redirectToForum } from "@/Utils/redirectToForum";
import Footer from "@/Layouts/Footer.vue";

const page = usePage();
const units = page.props.units || []; // Inertiaから`units`を取得
const users = page.props.users || []; // Inertiaから`users`を取得
const isGuest = page.props.isGuest || false; // Inertiaから`isGuest`を取得

console.log("isGuest", isGuest);

// CSRFトークンを取得
const csrfToken = ref(
    document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content") || ""
);

const showingNavigationDropdown = ref(false);

// Inertiaからユーザー情報を取得
const auth = page.props.auth || { user: {} }; // userがnullの場合、デフォルト値を設定
const userUnitId = auth.user?.unit_id || null;

// ユーザーの情報を確認
console.log("Logged in user data:", auth.user);
console.log("auth.user.unit_id:", userUnitId);

const navigateToForum = () => {
    redirectToForum(units, users, userUnitId);
};

// ゲストログアウト時の確認アラート
const confirmGuestLogout = (event) => {
    if (auth.user.guest_session_id) {
        const confirmed = window.confirm(
            "ログアウトするとゲストユーザーが削除されます。本当にログアウトしてよろしいですか？"
        );
        if (!confirmed) {
            event.preventDefault(); // ログアウト処理をキャンセル
        }
    }
};
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 pb-16">
            <nav
                class="bg-white border-b border-gray-100 fixed top-0 left-0 w-full z-10"
            >
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <div
                                    @click="navigateToForum"
                                    class="cursor-pointer"
                                >
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-blue-900"
                                    />
                                </div>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    {{ $t("Dashboard") }}
                                </NavLink>

                                <NavLink
                                    :href="route('residents.index')"
                                    :active="route().current('residents.index')"
                                >
                                    {{ $t("Residents") }}
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                <!-- user.nameがnullでないことを確認 -->
                                                <span v-if="auth.user">
                                                    {{ auth.user.name }}
                                                </span>
                                                <span v-else> ゲスト </span>

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                            class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                        >
                                            {{ $t("Profile") }}
                                        </DropdownLink>
                                        <form
                                            :action="
                                                isGuest
                                                    ? route('logout-guest')
                                                    : route('logout')
                                            "
                                            method="post"
                                            class="inline"
                                        >
                                            <input
                                                type="hidden"
                                                name="_token"
                                                :value="csrfToken"
                                            />
                                            <button
                                                type="submit"
                                                class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                @click="confirmGuestLogout"
                                            >
                                                {{ $t("Log Out") }}
                                            </button>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            {{ $t("Dashboard") }}
                        </ResponsiveNavLink>
                    </div>

                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('residents.index')"
                            :active="route().current('residents.index')"
                        >
                            {{ $t("Residents") }}
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <!-- user.nameがnullでないことを確認 -->
                            <div v-if="auth.user">
                                <div
                                    class="font-medium text-base text-gray-800"
                                >
                                    {{ auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ auth.user.email }}
                                </div>
                            </div>
                            <div v-else>
                                <!-- ゲストセッションの切断など、予期せぬauth.userのnull状態に対応するため保持 -->
                                <div
                                    class="font-medium text-base text-gray-800"
                                >
                                    ゲスト
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink
                                :href="route('profile.edit')"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                            >
                                {{ $t("Profile") }}
                            </ResponsiveNavLink>
                            <form
                                :action="route('logout')"
                                method="post"
                                class="inline"
                            >
                                <input
                                    type="hidden"
                                    name="_token"
                                    :value="csrfToken"
                                />
                                <button
                                    type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                    @click="confirmGuestLogout"
                                >
                                    {{ $t("Log Out") }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>

        <Footer />
    </div>
</template>
