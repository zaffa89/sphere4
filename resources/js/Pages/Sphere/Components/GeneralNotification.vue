<template>
  <div
    class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-t-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
  >
    <div class="p-4">
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <CheckCircleIcon
            v-if="data.type === 'success'"
            class="h-6 w-6 text-green-400"
            aria-hidden="true"
          />
          <ExclamationTriangleIcon
            v-if="data.type === 'warning'"
            class="h-6 w-6 text-yellow-400"
            aria-hidden="true"
          />
          <XCircleIcon
            v-if="data.type === 'error'"
            class="h-6 w-6 text-red-400"
            aria-hidden="true"
          />
        </div>
        <div class="ml-3 w-0 flex-1 pt-0.5">
          <p class="text-sm font-medium text-gray-900">{{ data.title }}</p>
          <p class="mt-1 text-sm text-gray-500">{{ data.text }}</p>
        </div>
        <div class="ml-4 flex flex-shrink-0">
          <button
            type="button"
            class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            @click="$emit('dismiss', data.id)"
          >
            <XMarkIcon
              class="h-5 w-5"
              aria-hidden="true"
            />
          </button>
        </div>
      </div>
    </div>
    <div class="overflow-hidden rounded-none">
      <div
        class="h-1 rounded-none bg-blue-600"
        :style="'width: ' + (100 - timer) + '%'"
      />
    </div>
  </div>
</template>

<script setup>
import { XMarkIcon, ExclamationTriangleIcon, CheckCircleIcon, XCircleIcon } from '@heroicons/vue/24/solid';
</script>

<script>
export default {
    props: ['data'],
    emits: ['dismiss'],
    data() {
        return {
            timer: 0,
            duration: 3,
        };
    },
    watch: {
        timer: {
            handler(value) {

                if (value < 100) {
                    setTimeout(() => {
                        this.timer = this.timer + (1 / this.duration);
                    }, 10);
                }
                else {
                    this.$emit('dismiss', this.data.id);
                }

            },
            immediate: true,
        },
    },
};
</script>

