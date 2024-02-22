<template>
  <div class="login-page--container" :class="{ 'lecturer-bg': lecturerRole }">
    


    <div class="login-form--container" style="margin: auto;">
      <div class="desktop-nav__link--container" style="justify-content: center;">
        <router-link :to="{ name: 'index' }" class="desktop-nav__link" active-class="desktop-nav__active-link">
          <span class="nav-title">SwiftServe</span>
        </router-link>
      </div>

      <h1 class="login--h1">
        Who are you?
      </h1>
      <div class="login-role--container">
        <div>
          <input id="login-student" v-model="form.role" class="login-radio" type="radio" value="Student">
          <label class="login-radio--label" for="login-student" @click="chooseStudent">User</label>
        </div>
        <div>
          <input id="login-lecturer" v-model="form.role" class="login-radio" type="radio" value="Lecturer">
          <label class="login-radio--label" for="login-lecturer" @click="chooseLecturer">Helper</label>
        </div>
      </div>

      <div v-if="!$matchMedia.xl" class="role--choose-effect"
        :class="{ 'role--student': studentRole, 'role--lecturer': lecturerRole }" />
      <div v-else class="separator mt-1_5 mb-2">
        Sign In
      </div>

      <form @submit.prevent="login" @keydown="form.onKeydown($event)">
        <!-- Email -->
        <div class="login-input--container">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="login-input" type="email"
            name="email" placeholder="Email" autocomplete="username" required>
          <has-error :form="form" field="email" />
        </div>

        <!-- Password -->
        <div class="login-input--container">
          <div class="right-tag__group ">
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }"
              class="right-tag__input login--left-border" :type="passwordType" name="password" placeholder="Password"
              autocomplete="current-password" required>
            <div v-show="hidePassword" class="pointer right-tag" @click="togglePassword">
              <span class="iconify password__hide-icon" data-icon="carbon:view-off-filled" width="20" height="20" />
            </div>
            <div v-show="!hidePassword" class="pointer right-tag" @click="togglePassword">
              <span class="iconify password__hide-icon " data-icon="carbon:view-filled" width="20" height="20" />
            </div>
          </div>
          <has-error :form="form" field="password" />
        </div>

        <!-- Remember Me -->
        <div class="login-input--container">
          <label class="checkbox-container checkbox-container--post">Remember Me
            <input v-model="remember" name="remember" type="checkbox">
            <span class="checkbox-checkmark checkbox-checkmark-remember" />
          </label>
        </div>

        <div class="">
          <!-- Submit Button -->
          <v-button :loading="form.busy" class="login-submit--button" :class="{ 'is-lecturer': lecturerRole }">
            Sign In
          </v-button>
        </div>
      </form>
      <div class="login-extra">
        <p>
          Don't have an account?
          <router-link :to="{ name: 'register' }" class="login-link">
            <b>Sign Up</b>
          </router-link>
        </p>
      </div>

    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  name: 'LoginPage',
  layout: 'wide',
  middleware: 'guest',

  metaInfo() { return { title: 'Sign In' } },

  data: () => ({
    studentRole: false,
    lecturerRole: false,
    hidePassword: true,
    passwordType: 'password',

    form: new Form({
      role: 'Student',
      email: '',
      password: ''
    }),
    remember: false
  }),

  computed: {
    ...mapGetters({
      snackbar: 'notification/snackbar'
    }),

    role() {
      if (this.form.role === 'Student') {
        return {
          img: {
            top: '/images/login-top-student.png',
            midLeft: '/images/login-mid-left-1-student.png',
            midRight: '/images/login-mid-right-student.png'
          },
          class: {
            midImage: ''
          },
          text: 'Lets make it easy!'
        }
      }

      return {
        img: {
          top: '/images/login-top-lecturer.png',
          midLeft: '/images/login-mid-left-1-lecturer.png',
          midRight: '/images/login-mid-right-lecturer.png'
        },
        class: {
          midImage: 'row-reverse'
        },
        text: 'Help for Everyone'
      }
    }
  },

  methods: {
    async login() {
      const isLecturer = this.form.email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@(?!.*(student)).*.ac.id.*$/)

      if (this.form.role === 'Lecturer' && !isLecturer) {
        this.snackbar.open('You are likely not using a lecturer identity.')
        this.chooseStudent()
        this.form.role = 'Student'
        return
      } else if (this.form.role === 'Student' && isLecturer) {
        this.snackbar.open('You are likely using a lecturer identity. ')
        this.chooseLecturer()
        this.form.role = 'Lecturer'
        return
      }

      this.form.post('/api/login')
        .then(({ data }) => {
          this.$store.dispatch('auth/saveToken', {
            token: data.token,
            remember: this.remember
          })
          this.$router.back()
        })
        .catch(e => {
          // console.log(e.response.data.message)
        })
    },

    chooseStudent() {
      this.studentRole = true
      this.lecturerRole = false
    },

    chooseLecturer() {
      this.lecturerRole = true
      this.studentRole = false
    },
    togglePassword() {
      this.hidePassword = !this.hidePassword
      this.passwordType = this.hidePassword ? 'password' : 'text'
    }
  }
}
</script>
