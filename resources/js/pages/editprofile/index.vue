<template>
  <div class="edit-profile__container">
    

    <div>
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>

export default {
  name: 'EditProfileIndex',

  middleware: ['auth'],

  data: () => ({
    applicant_type: ''
  })
}
</script>
