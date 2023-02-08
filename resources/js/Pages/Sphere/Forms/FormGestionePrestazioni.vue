<template>
    <div>
        <div>
            <div class="sm:hidden">                
                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                <select id="tabs" name="tabs" @change="changeTab(index)" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option v-for="(tab , index) in tabs" :key="index" :selected="currentTab === index">{{ tab }}</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <button v-for="(tab , index) in tabs" :key="index" @click="changeTab(index)" :class="[currentTab === index ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm']">
                            {{ tab }}
                        </button>
                    </nav>
                </div>
            </div>
        </div>
        <div class="bg-white h-full">
            <div v-if="currentTab === 0">
                medsport
            </div>
            <div v-if="currentTab === 1">
                ambu
            </div>
        </div>
        
    </div>
</template>
<script setup>
    
</script>

<script>
    export default {
        data() {
            return {
                currentTab: 0,
                tabs: ['Medicina dello Sport' , 'Ambulatoriale'],                                    
            }
        },
        methods: {
            changeTab(index) {
                this.currentTab = index
            }
        }
    }
</script>