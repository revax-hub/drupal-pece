<template>
  <nav
    :class="{
      'main-menu__mobile': mobile,
      'main-menu__mobile--expanded': showMenuMobile,
    }"
    class="main-menu relative overflow-hidden"
    aria-labelledby="mainmenu"
  >
    <h2 id="mainmenu" class="sr-only">
      {{ $t('a11y.main_navigation') }}
    </h2>
    <ul
      class="main-menu__list flex mt-4"
    >
      <li
        v-for="menu in menuHeader"
        :key="menu.label"
        data-pece="menuHeader-items"
        class="py-2"
      >
        <nuxt-link :to="{ name: `${menu.routeName}___${$i18n.locale}` }" class="px-6 md:px-4 lg:px-6 cursor-pointer hover:text-accent">
          {{ $t(menu.label) }}
        </nuxt-link>
      </li>
    </ul>
  </nav>
</template>

<script>
import { menuHeader } from '@/utils/fake'

export default {
  name: 'Navigation',
  props: {
    mobile: {
      type: Boolean,
      default: false
    },
    showMenuMobile: {
      type: Boolean,
      default: false
    }
  },
  setup () {
    return {
      menuHeader
    }
  }
}
</script>

<style lang="scss">
.main-menu {
  &__mobile {
    @apply absolute shadow-xl bg-white;
    width: 98%;
    top: 80px;
    left: 5px;
    ul {
      @apply flex-wrap;
    }
    li {
      @apply w-full;
    }
  }
}
</style>
