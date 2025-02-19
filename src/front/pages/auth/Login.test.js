import { shallowMount } from '@vue/test-utils'

import Login from '@/pages/auth/Login'

const wrapper = shallowMount(Login)

describe('Login page', () => {
  test('is a Vue instance', () => {
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
