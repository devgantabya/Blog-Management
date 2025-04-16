<script setup lang="ts">
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useAuth } from "@/hooks/useAuth";

defineOptions({ layout: MainLayout });

const { isAuthenticated } = useAuth(); // Assuming you have a useAuth composable to check authentication status
</script>

<template>
    <Head title="Home" />

    <div class="container container-lg mx-auto  px-4 sm:px-6 lg:px-8">
        <div class=" text-left">

            <div class="col-span-1 md:col-span-8 lg:col-span-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        Welcome to The Blogging Network!


                    </h1>
                    <h2 class="text-xl text-indigo-600 font-semibold mb-6">
                        Your Ultimate Blog Management Solution
                    </h2>
                    <p class="text-gray-700 text-lg mb-12">
                        Effortlessly create, manage, and grow your blog with our powerful and user-friendly platform. Whether you're a solo writer or managing a team, BlogSphere helps you publish high-quality content, engage your audience, and stay organized — all in one place.
                    </p>
                    <div class="text-left space-y-6">
      <div>
        <h3 class="text-lg font-semibold text-gray-800">✍️ Easy Post Creation</h3>
        <p class="text-gray-600">Write, format, and publish posts with our intuitive editor.</p>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-gray-800">🔖 Tag & Categorize Content</h3>
        <p class="text-gray-600">Keep your blog organized and searchable with smart tags and categories.</p>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-gray-800">💬 Real-time Comments & Notifications</h3>
        <p class="text-gray-600">Engage with readers and stay updated with instant alerts.</p>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-gray-800">📊 Insights & Analytics</h3>
        <p class="text-gray-600">Track your growth and performance with real-time stats.</p>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-gray-800">🔐 Secure & Scalable</h3>
        <p class="text-gray-600">Built with modern frameworks for speed, security, and scalability.</p>
      </div>
    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>
/* Add page-specific styles if needed */
</style>
