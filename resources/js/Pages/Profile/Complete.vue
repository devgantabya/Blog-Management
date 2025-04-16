<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { toast } from 'vue-sonner';

const form = useForm({
    image: null,
});

const preview = ref(null);

const handleImageChange = (e) => {
    const file = e.target.files[0];
    form.image = file;

    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const submit = () => {
    form.post(route('profile.store'), {
        forceFormData: true,
        onSuccess: () => {
            toast.success('Profile image uploaded!');
        },
        onError: () => {
            toast.error('Upload failed. Try again.');
        },
    });
};
</script>

<template>
    <div class="max-w-md mx-auto mt-16 bg-white p-8 shadow rounded-xl">
        <h2 class="text-xl font-bold mb-4 text-center">Complete Your Profile</h2>
        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Profile Image</label>
                <Input type="file" accept="image/*" @change="handleImageChange" />
                <p v-if="form.errors.image" class="text-red-600 text-sm mt-1">
                    {{ form.errors.image }}
                </p>
            </div>

            <div v-if="preview" class="mt-4">
                <p class="text-sm mb-1">Preview:</p>
                <img :src="preview" class="rounded-full w-24 h-24 object-cover" />
            </div>

            <Button type="submit" :disabled="form.processing" class="w-full">
                {{ form.processing ? 'Uploading...' : 'Submit' }}
            </Button>
        </form>
    </div>
</template>
