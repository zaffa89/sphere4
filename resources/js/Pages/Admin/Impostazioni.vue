<template>
    <AppLayout :hideSidebar="true">
        <template #main>
            <AdminLayout>
                
            </AdminLayout>   
        </template>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import AdminLayout from '../../Layouts/AdminLayout.vue';
</script>

<script>
export default {
    
}
</script>