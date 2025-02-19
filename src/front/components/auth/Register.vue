<template>
  <FormObserveValidate
    @submitted="register"
    name="form-register"
    data-nw="form-register"
  >
    <template v-slot="{ invalid }">
      <div
        ref="alert"
        v-if="serverErrors.length"
        data-nw="error-alert"
        tabindex="-1"
        class="mt-6"
      >
        <Alert>
          <span slot="title">
            Some errors occurred while registering
          </span>
          <ul
            slot="description"
            data-nw="error-alert-list"
            class="list-disc ml-4"
          >
            <li v-for="(error, index) in serverErrors" :key="`server-error${index}`">
              {{ error.message }}
            </li>
          </ul>
        </Alert>
      </div>
      <section class="mt-8">
        <FormControlValidate
          v-slot="{ errors }"
          rules="required|email"
          name="email"
          class="mt-8"
        >
          <FormLabel
            for="email"
            class="pb-0"
          >
            Email
          </FormLabel>
          <FormInput
            id="email"
            v-model="mail"
            type="email"
            name="email"
            data-nw="email"
            aria-describedby="email-help-text"
          />
          <FormErrorMessage :errors="errors" />
        </FormControlValidate>
        <p id="email-help-text" class="text-xs mt-2">
          A valid e-mail address. All e-mails from the system will be sent to this address. The e-mail address is not made public and will only be used if you wish to receive a new password or wish to receive certain news or notifications by e-mail.
        </p>
        <FormControlValidate
          v-slot="{ errors }"
          rules="required|min:8"
          name="password"
          class="mt-8"
        >
          <FormLabel
            for="password"
            class="pb-0"
          >
            Password
          </FormLabel>
          <FormInput
            id="password"
            v-model="password"
            type="password"
            name="password"
            data-nw="password"
            aria-describedby="password-help-text"
          />
          <FormErrorMessage :errors="errors" />
        </FormControlValidate>
        <p id="password-help-text" class="text-xs mt-2">
          Enter a password with at least 8 characters.
        </p>
        <FormControlValidate
          v-slot="{ errors }"
          rules="required|min:8|confirmed:password"
          name="Password confirm"
          class="mt-8"
        >
          <FormLabel
            for="password_confirm"
            class="pb-0"
          >
            Password confirm
          </FormLabel>
          <FormInput
            id="password_confirm"
            v-model="password_confirm"
            type="password"
            name="password_confirm"
            data-nw="password_confirm"
            aria-describedby="password-confirm-help-text"
          />
          <FormErrorMessage :errors="errors" />
        </FormControlValidate>
        <p id="password-confirm-help-text" class="text-xs mt-2">
          Repeat password again password for confirmation.
        </p>
        <FormControl class="mt-8">
          <FormLabel
            for="zotero"
            class="pb-0"
          >
            Zotero username
          </FormLabel>
          <FormInput
            id="zotero"
            v-model="zotero"
            type="text"
            name="zotero"
            data-nw="zotero"
            aria-describedby="zotero-help-text"
          />
        </FormControl>
        <p id="zotero-help-text" class="text-xs mt-2">
          This field will be used to map authorship for the bibliography imported from the Zotero platform.
        </p>
      </section>
      <div class="my-12">
        <Divider />
      </div>
      <button
        :disabled="invalid || saveLoading"
        :class="{ 'opacity-50': invalid }"
        type="submit"
        class="btn-accent"
        data-nw="btn-submit"
      >
        Create new account
      </button>
    </template>
  </FormObserveValidate>
</template>

<script>
import { ref, reactive, toRefs } from '@vue/composition-api'
import { CREATE_USER } from '@/graphql/queries/user'

export default {
  name: 'RegisterForm',

  setup (_, { root, refs }) {
    const serverErrors = ref([])
    const saveLoading = ref(false)

    const state = reactive({
      mail: null,
      zotero: null,
      password: null,
      password_confirm: null
    })

    async function register (isValid) {
      if (isValid) {
        try {
          saveLoading.value = true
          serverErrors.value = []

          const res = await root.$apollo.mutate({
            mutation: CREATE_USER,
            variables: {
              mail: state.mail,
              username: state.mail,
              pass: state.password,
              zotero: state.zotero
            }
          })

          if (res.extensions && res.extensions.length) {
            throw new Error(res.extensions[0].message || `Error saving the user ${state.username}`)
          }
          const successMessage = 'Registration complete!'
          root.$swal(successMessage, 'You have to wait for account approval.', 'success').then(() => {
            window.location.href = root.$route.query.redirect || '/'
          })
          root.$announcer.set(successMessage)
        } catch (e) {
          saveLoading.value = false
          serverErrors.value.push({ message: e.message })
          root.$nextTick(() => refs.alert.focus())
        }
      }
    }

    return {
      ...toRefs(state),
      saveLoading,
      serverErrors,
      register
    }
  }
}
</script>

<style lang="scss">
</style>
