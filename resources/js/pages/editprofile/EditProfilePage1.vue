<template>
  <div>
    <div class="form-avatar-group__container">
      <img class="edit-profile--img" :src="data.avatar" alt="">
      <div class=" form__file-container">
        <div>
          <label for="form2.file" class="btn btn--blue">Upload Photo</label>
          <input id="form2.file" class="form__input-file" name="form2.file" type="file" @change="uploadAvatar">
        </div>
        <button class="btn btn--grey" @click="deleteAvatar">
          Delete
        </button>
      </div>
    </div>

    <has-error :form="form2" field="file" />
    <p class="form-group__input-info mb-2">
      Max avatar size is 516KB
    </p>

    <form @submit.prevent="saveProfile" @keydown="form.onKeydown($event)">
      <div class="">
        <div class="form__input--group">
          <div class="form-group__container">
            <h4 class="form-group__input-name">
              First Name
            </h4>
            <div class="">
              <input v-model="form.user.first_name" class="form-group__input-text">
            </div>
          </div>

          <div class="form-group__container">
            <h4 class="form-group__input-name">
              Last Name
            </h4>
            <div class="">
              <input v-model="form.user.last_name" class="form-group__input-text">
            </div>
          </div>
        </div>

       

        <div class="form-group__container">
          <h4 class="form-group__input-name">
             ID Number
          </h4>
          <div class="">
            <input v-model="form.user.identity_number" class="form-group__input-text" placeholder="e.g., 205150200111042">
          </div>
        </div>

        

        <div class="form-group__container">
          <h4 class="form-group__input-name">
            Function
          </h4>
          <div class="">
            <input v-model="form.user.faculty" class="form-group__input-text" placeholder="e.g., Faculty of Computer Science">
          </div>
        </div>

        

        <div class="form-group__container">
          <h4 class="form-group__input-name">
            Location
          </h4>
          <div class="">
            <input v-model="form.user.location" class="form-group__input-text" placeholder="e.g., Malang, Indonesia">
          </div>
        </div>

        <!-- Tell me about yourself! -->
        <div class="form-group__container">
          <h4 class="form-group__input-name">
            Biography
          </h4>
          <div class="">
            <textarea v-model="form.user.biography" class="form-group__input-textarea" placeholder="Max. 300 words" rows="5" />
          </div>
        </div>

        <hr class="form--hr">

        <div>
          <h2 class="social-media__heading">
            Social Media
          </h2>
          <div class="social-media__edit--container">
            <div class="social-media__edit-input--container">
              <span class="iconify social-media__edit--icon" data-icon="ant-design:behance-outlined" />
              <input v-model="form.user.behance" type="url" class="social-media__input" :placeholder="`e.g., behance.net/${firstName}`">
            </div>

            <div class="social-media__edit-input--container">
              <span class="iconify social-media__edit--icon" data-icon="ant-design:github-filled" />
              <input v-model="form.user.github" type="url" class="social-media__input" :placeholder="`e.g., github.com/${firstName}`">
            </div>

            <div class="social-media__edit-input--container">
              <span class="iconify social-media__edit--icon" data-icon="bx-bxl-linkedin" />
              <input v-model="form.user.linkedin" type="url" class="social-media__input" :placeholder="`e.g., linkedin.com/in/${firstName}`">
            </div>

            <div class="social-media__edit-input--container">
              <span class="iconify social-media__edit--icon" data-icon="whh:dribbblealt" />
              <input v-model="form.user.dribbble" type="url" class="social-media__input" :placeholder="`e.g., dribbble.com/${firstName}`">
            </div>

            <div class="social-media__edit-input--container">
              <span class="iconify social-media__edit--icon" data-icon="whh:website" />
              <input v-model="form.user.website" type="url" class="social-media__input" :placeholder="`e.g., ${firstName}.github.io`">
            </div>
          </div>
        </div>

        <hr class="form--hr">

        <div class="form-group__container mb-5">
          <h4 class="form-group__input-name ">
            Tag Name
          </h4>
          <div class=" form-tag__group">
            <input id="form.user.tagname" v-model="form.user.tagname" class="form-tag__input ">
            <label for="form.user.tagname" class="form-tag"><span class="iconify" data-icon="entypo:email" /></label>
          </div>

          <has-error :form="form" field="user.tagname" />
        </div>

        <div class="mb-1_5 mt-5 edit-profile__buttons">
          <v-button :loading="form.busy" class="btn btn--blue">
            Save Changes
          </v-button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import { serialize } from 'object-to-formdata'
import { mapGetters } from 'vuex'

export default {
  name: 'EditProfile1Page',

  metaInfo () { return { title: 'Edit Profile Page 1' } },

  data: () => ({
    form: new Form({
      user: {
        first_name: ''
      }
    }),

    form2: new Form({
      file: null
    })
  }),

  computed: {
    ...mapGetters({
      data: 'auth/user',
      snackbar: 'notification/snackbar'
    }),

    firstName () {
      return this.data.first_name.toLowerCase()
    }
  },

  mounted: function () {
    this.getUser()
  },

  methods: {
    async getUser () {
      this.form.user = this.data
    },

    async uploadAvatar (e) {
      const file = e.target.files[0]

      // Do some client side validation...

      this.form2.file = file

      this.form2.submit('post', '/api/user/avatar', {
        transformRequest: [function (data, headers) {
          return serialize(data)
        }]
      })
        .then(({ data }) => {
          this.$store.dispatch('auth/updateAvatar', {
            avatar: data.avatar
          })

          this.snackbar.open(data.message)
        })
        .catch(e => {
          this.snackbar.open(e.response.data.message)
        })
    },

    async deleteAvatar (e) {
      this.form.submit('delete', '/api/user/avatar')
        .then(({ data }) => {
          this.$store.dispatch('auth/updateAvatar', {
            avatar: data.avatar
          })

          this.snackbar.open(data.message)
        })
    },

    async saveProfile (e) {
      // this.form.user.biography = snarkdown(this.form.user.biography)

      await this.form.post('/api/user/saveprofile/1')
        .then(({ data }) => {
          this.$store.dispatch('auth/updateUser', {
            user: data.user
          })

          this.snackbar.open(data.message)
        })
    }
  }

}
</script>
