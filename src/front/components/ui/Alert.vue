<template functional>
  <div
    :class="{
      'bg-teal-100 border-teal-500': props.type === 'info',
      'bg-red-100 border-red-500': props.type === 'error',
      'bg-indigo-100 border-accent': props.type === 'notify',
    }"
    class=" border-t-4 rounded-b text-teal-900 px-4 py-3"
    role="alert"
    data-nw="alert"
    aria-atomic="true"
  >
    <div class="flex">
      <div
        v-if="props.icon"
        class="py-1"
        aria-hidden="true"
      >
        <svg
          :class="{
            'text-teal-500': props.type === 'info',
            'text-red-500': props.type === 'error',
            'text-accent': props.type === 'notify',
          }"
          focusable="false"
          role="presentation"
          aria-hidden="true"
          class="fill-current h-6 w-6 mr-4"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
        >
          <path v-if="props.type === 'info'" d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
          <path v-if="props.type === 'error'" d="M10.185,1.417c-4.741,0-8.583,3.842-8.583,8.583c0,4.74,3.842,8.582,8.583,8.582S18.768,14.74,18.768,10C18.768,5.259,14.926,1.417,10.185,1.417 M10.185,17.68c-4.235,0-7.679-3.445-7.679-7.68c0-4.235,3.444-7.679,7.679-7.679S17.864,5.765,17.864,10C17.864,14.234,14.42,17.68,10.185,17.68 M10.824,10l2.842-2.844c0.178-0.176,0.178-0.46,0-0.637c-0.177-0.178-0.461-0.178-0.637,0l-2.844,2.841L7.341,6.52c-0.176-0.178-0.46-0.178-0.637,0c-0.178,0.176-0.178,0.461,0,0.637L9.546,10l-2.841,2.844c-0.178,0.176-0.178,0.461,0,0.637c0.178,0.178,0.459,0.178,0.637,0l2.844-2.841l2.844,2.841c0.178,0.178,0.459,0.178,0.637,0c0.178-0.176,0.178-0.461,0-0.637L10.824,10z" />
          <path v-if="props.type === 'notify'" d="M14.38,3.467l0.232-0.633c0.086-0.226-0.031-0.477-0.264-0.559c-0.229-0.081-0.48,0.033-0.562,0.262l-0.234,0.631C10.695,2.38,7.648,3.89,6.616,6.689l-1.447,3.93l-2.664,1.227c-0.354,0.166-0.337,0.672,0.035,0.805l4.811,1.729c-0.19,1.119,0.445,2.25,1.561,2.65c1.119,0.402,2.341-0.059,2.923-1.039l4.811,1.73c0,0.002,0.002,0.002,0.002,0.002c0.23,0.082,0.484-0.033,0.568-0.262c0.049-0.129,0.029-0.266-0.041-0.377l-1.219-2.586l1.447-3.932C18.435,7.768,17.085,4.676,14.38,3.467 M9.215,16.211c-0.658-0.234-1.054-0.869-1.014-1.523l2.784,0.998C10.588,16.215,9.871,16.447,9.215,16.211 M16.573,10.27l-1.51,4.1c-0.041,0.107-0.037,0.227,0.012,0.33l0.871,1.844l-4.184-1.506l-3.734-1.342l-4.185-1.504l1.864-0.857c0.104-0.049,0.188-0.139,0.229-0.248l1.51-4.098c0.916-2.487,3.708-3.773,6.222-2.868C16.187,5.024,17.489,7.783,16.573,10.27" />
        </svg>
      </div>
      <div>
        <p class="font-bold">
          <slot name="title">
            {{ props.title }}
          </slot>
        </p>
        <p class="text-sm mt-2">
          <slot name="description">
            {{ props.description }}
          </slot>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Alert',

  props: {
    title: {
      type: String,
      default: ''
    },
    description: {
      type: String,
      default: ''
    },
    icon: {
      type: Boolean,
      default: true
    },
    type: {
      type: String,
      default: 'error'
    }
  }
}
</script>
