<script setup>
import { usePage } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import Footer from "@/Layouts/Footer.vue";

defineProps({
    adminExists: Boolean,
});

const page = usePage();
const tenant = page.props.tenant || {};

// 現在のURLが特定のパスかをチェック
const guestTenantUrl =
    import.meta.env.VITE_GUEST_TENANT_URL ||
    "http://guestdemo.localhost" ||
    "https://guestdemo.communi-care.jp";
const isGuestHome = window.location.href === `${guestTenantUrl}/home`;
</script>

<template>
    <div
        class="min-h-screen bg-gradient-to-b from-blue-50 to-white flex flex-col justify-center items-center text-center px-4"
    >
        <!-- メインコンテンツ -->
        <div
            class="flex flex-col sm:flex-row items-center justify-center w-full max-w-7xl gap-8 sm:gap-16"
        >
            <!-- 左側の画像 -->
            <img
                src="/images/top_image.png"
                alt="Welcome Image"
                class="w-full max-w-sm sm:w-2/3 lg:w-1/3 object-contain"
            />

            <!-- 右側のタイトルと説明文 -->
            <div
                class="flex flex-col items-center sm:items-start text-center sm:text-left mt-6 sm:mt-0"
            >
                <!-- タイトルロゴ -->
                <div class="mb-6 w-full max-w-md">
                    <ApplicationLogo
                        class="w-full text-blue-900 text-5xl md:text-5xl"
                    />
                    <div
                        class="w-1/2 sm:w-full h-1 bg-blue-900 mx-auto sm:mx-0 mt-4"
                    ></div>
                </div>

                <!-- タイトル -->
                <h2
                    class="text-blue-900 text-xl sm:text-2xl font-semibold mb-4 sm:mb-6"
                >
                    職員の効率的なコミュニケーションと情報管理を支援
                </h2>

                <!-- 説明文 -->
                <p
                    class="text-gray-700 text-base sm:text-lg max-w-sm sm:max-w-lg mb-6 leading-relaxed"
                >
                    CommuniCareは、介護施設の運営を効率化するために、
                    職員間のスムーズなコミュニケーションと利用者様の情報を一元管理する
                    プラットフォームです。
                </p>

                <!-- テナント名 -->
                <div
                    v-if="tenant?.business_name"
                    class="text-blue-900 text-lg sm:text-xl font-medium bg-blue-50 px-6 py-2 rounded-lg shadow-sm border border-blue-100 mb-6"
                >
                    {{ tenant.business_name }}
                </div>

                <!-- ボタンセクション -->
                <div
                    class="flex flex-wrap justify-center sm:justify-start gap-4"
                >
                    <!-- ボタンの切り替え -->
                    <Link
                        v-if="isGuestHome"
                        :href="route('guest.user.login')"
                        class="bg-blue-100 text-blue-700 hover:bg-blue-300 hover:text-white text-base sm:text-lg py-3 px-6 sm:py-4 sm:px-8 rounded-lg shadow-lg"
                    >
                        ゲストユーザーとしてログイン
                    </Link>
                    <Link
                        v-else
                        :href="route('login')"
                        class="bg-gray-200 text-gray-700 hover:bg-gray-400 hover:text-white text-base sm:text-lg py-3 px-6 sm:py-4 sm:px-8 rounded-lg shadow-lg"
                    >
                        ログイン
                    </Link>

                    <!-- 管理者登録ボタン -->
                    <Link
                        v-if="!adminExists"
                        :href="route('register-admin.form')"
                        class="bg-blue-100 text-blue-700 hover:bg-blue-300 hover:text-white text-base sm:text-lg py-3 px-6 sm:py-4 sm:px-8 rounded-lg shadow-lg"
                    >
                        管理者登録
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>
