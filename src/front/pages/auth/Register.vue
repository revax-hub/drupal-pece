<template>
  <div class="mt-20 mb-40 w-full lg:w-3/6 mx-auto">
    <h1 class="font-bold text-4xl leading-none">
      Create an account
    </h1>
    <RegisterForm />
  </div>
</template>

<script>
export default {
  name: 'Register',

  components: {
    RegisterForm: () => import(/* webpackChunkName: "RegisterForm" */ '@/components/auth/Register')
  },

  head () {
    return {
      title: 'Create an account | PECE Project'
    }
  }
}
</script>

<style lang="scss"></style>
