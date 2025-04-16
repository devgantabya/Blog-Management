<script setup lang="ts">
import GuestLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  user: Object,
})

const preview = ref(null)
const file = ref(null)
const uploading = ref(false)

function handleFileChange(event) {
  const selectedFile = event.target.files[0]
  if (selectedFile) {
    file.value = selectedFile
    preview.value = URL.createObjectURL(selectedFile)
  }
}

function submitProfileImage() {
  if (!file.value) return

  uploading.value = true

  const formData = new FormData()
  formData.append('image', file.value)

  router.post('/profile/image', formData, {
    preserveScroll: true,
    forceFormData: true,
    onSuccess: () => {
      uploading.value = false
      preview.value = null
    },
    onError: () => {
      uploading.value = false
    },
  })
}

// defineProps<{
//     mustVerifyEmail?: boolean;
//     status?: string;
// }>();
</script>

<template>
    <Head title="Profile" />

    <GuestLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8">
                    <h2 class="text-lg font-semibold mb-4">Profile Picture</h2>
                    <form @submit.prevent="submitProfileImage" class="space-y-4">
                        <input type="file" @change="handleFileChange" accept="image/*" />
                        <div v-if="preview" class="mt-2">
                            <p class="text-sm text-gray-600">Preview:</p>
                            <img :src="preview" class="w-24 h-24 rounded-full object-cover border mt-1" />
                        </div>
                        <button
                        type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition"
                        :disabled="uploading"
                        >
                        {{ uploading ? "Uploading..." : "Upload" }}
                        </button>
                    </form>


                </div>

                <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>



                <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
