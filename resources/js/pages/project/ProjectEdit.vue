<template>
  <div class="edit-profile__container">
    <TopImage :type="2" />

    <h2 class="post__h1">
      Edit
    </h2>

    <div class="form-group__container mb-2_5">
      <h4 class="form-group__input-name">
        Service Thumbnail
      </h4>
      <div class="form-avatar-group__container">
        <img class="edit-profile--img" :src="form.thumbnail ? form.thumbnail : `/images/post-placeholder-img.png`" alt="">
        <div class="form__file-container">
          <div>
            <label for="form2.thumbnail" class="btn btn--blue">Upload Photo</label>
            <input id="form2.thumbnail" class="form__input-file" name="form2.thumbnail" type="file" @change="uploadThumbnail">
          </div>
          <button class="btn btn--grey" @click="deleteThumbnail">
            Delete
          </button>
        </div>
      </div>
      <has-error :form="form2" field="file" />
      <p class="form-group__input-info mb-2">
        Max thumbnail size is 516KB
      </p>
    </div>

    <form @submit.prevent="``">
      <div class="">
        <div class="form-group__container">
          <h4 class="form-group__input-name">
            Service Name
          </h4>
          <div class="">
            <input v-model="form.title" class="form-group__input-text" placeholder="Type your project title">
          </div>
          <has-error :form="form" field="title" />
        </div>

        <div class="form-group__container">
          <h4 class="form-group__input-name">
            Location
          </h4>
          <div class="">
            <input v-model="form.location" class="form-group__input-text" placeholder="Type your location">
          </div>
        </div>

        

        <div class="form-group__container">
          <h4 class="form-group__input-name">
            How many people works on this service?
          </h4>
          <div class="select">
            <select v-model="form.max_person">
              <option value="99">
                Not Specified
              </option>
              <option value="1">
                1 Person
              </option>
              <option value="2">
                2 Persons
              </option>
              <option value="3">
                3 Persons
              </option>
              <option value="4">
                4 Persons
              </option>
              <option value="5">
                5 Persons
              </option>
              <option value="6">
                6 Persons
              </option>
              <option value="7">
                7 Persons
              </option>
              <option value="8">
                8 Persons
              </option>
              <option value="9">
                9 Persons
              </option>
            </select>
            <span class="focus" />
          </div>
        </div>
      </div>

      

      

      <hr class="form--hr">

      <div class="form-group__container">
        <h4 class="form-group__input-name">
          Service Description
        </h4>
        <div class="">
          <textarea v-model="form.description" class="form-group__input-textarea" placeholder="Max. 500 words" rows="5" />
        </div>
      </div>

      <div class="form-group__container mb-3">
        <div class="flex-row space-between">
          <h4 class="form-group__input-name">
            Requirements needed
          </h4>
        </div>
        <div class="">
          <p v-if="form.requirements && form.requirements.length === 0" class="info__p">
            Let's add some detailed requirements
          </p>
          <ul class="post__requirements">
            <RequirementItem v-for="(requirement, index) in form.requirements" :key="`requirements-${index}`" :data="requirement" :deletable="true" :index="index" @click="deleteRequirement" />
          </ul>

          <div class="flex-center unselectable post__add-skill pointer" @click="showAddRequirement">
            <span class="iconify button__add-skill--icon mr-0_5" data-icon="ic:round-add-circle" />
            <span class="button__add-skill--text">Add Requirements</span>
          </div>

          <Modal ref="addRequirementModal" :type="`medium`">
            <template v-slot:header>
              <h4 class="post__modal--h4 my-0">
                Add Requirements
              </h4>
            </template>

            <template v-slot:body>
              <div>
                <hr class="my-0 mb-2_5">
                <div class="">
                  <textarea v-model="anotherRequirements" class="form-group__input-textarea" placeholder="Max. 500 words" rows="5" />
                  <p class="info__p">
                    You can add multiple requirements separated by dot (<span class="iconify" data-icon="carbon:dot-mark" width="12" height="12" />)
                  </p>
                </div>
              </div>
            </template>

            <template v-slot:footer>
              <div class="btn btn--blue ml-auto" @click="addRequirement">
                Add Requirements
              </div>
            </template>
          </Modal>
        </div>
      </div>


      <div class="form-group__container">
        <h4 class="form-group__input-name">
          Payement methods
        </h4>
        <div class=" checkbox-group">
          <div class="">
            <label class="checkbox-container checkbox-container--post">Card
              <input v-model="form.salary" type="checkbox">
              <span class="checkbox-checkmark" />
            </label>
            <div v-show="form.salary" class="post__form--parent post-salary__group">
              
              <div class="form-group__container">
                <h4 class="form-group__input-name">
                  Compatible cards
                </h4>
                <div class="">
                  <input v-model="form.salary_amount" class="form-group__input-text" placeholder="Give your best offer" type="number" min="0">
                </div>
              </div>

              
            </div>
            <has-error :form="form" field="salary_amount" />
          </div>

          <label class="checkbox-container checkbox-container--post">Cash
            <input v-model="form.certificate" type="checkbox">
            <span class="checkbox-checkmark" />
          </label>
        </div>
      </div>

      <div class="mt-5">
        <!-- Submit Button -->
        <div v-if="form.status === 'Draft'" class="btn--group">
          <button class="btn btn--large btn--grey mb-1_5" @click="saveProject('Draft')">
            Save as Draft
          </button>
          <button class="btn btn--large btn--blue ml-auto" @click="saveProject('Publish')">
            Post Project
          </button>
        </div>

        <div v-else class="btn btn--large btn--blue ml-auto" @click="saveProject('Save Changes')">
          Save Changes
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import { serialize } from 'object-to-formdata'
import { mapGetters } from 'vuex'
import RequirementItem from '~/components/RequirementItem'

export default {
  name: 'EditPostedProject',
  layout: 'back',
  middleware: ['auth', 'lecturer'],
  components: { RequirementItem },

  metaInfo () { return { title: 'Edit Posted Project' } },

  data: () => ({
    form: new Form({
      title: '',
      location: 'Malang, Indonesia',
      level_applicant: 'Easy',
      max_person: 4,
      ui_ux_designer: false,
      front_end_engineer: false,
      back_end_engineer: false,
      data_expert: false,
      applicant_type: 'Individual & Team',
      description: '',
      interest: '',
      min_points: '',
      skills: [],
      requirements: [],
      salary: false,
      currency: 'IDR',
      salary_amount: '',
      payment_type: 'person',
      certificate: false,
      thumbnail: null
    }),

    form2: new Form({
      file: null
    }),

    salary: false,
    skillLength: 0,
    anotherSkills: '',
    anotherRequirements: ''
  }),

  computed: {
    ...mapGetters({
      snackbar: 'notification/snackbar',
      project: 'visit/project'
    }),

    heading () {
      if (this.form.status === 'Draft') return 'Post Your Project!'
      else return 'Edit Posted Project'
    }
  },

  mounted () {
    this.getDetails()
  },

  methods: {

    async getDetails () {
      await this.$store.dispatch('visit/fetchVisitedProject', {
        id: this.$route.params.id
      })

      this.form = new Form({ ...this.form, ...this.project })

      if (this.project.thumbnail_url.includes('storage')) {
        this.form.thumbnail = this.project.thumbnail_url
      }
    },

    async uploadThumbnail (e) {
      const file = e.target.files[0]

      this.form2.file = file

      this.form2.submit('post', '/api/project/' + this.project.project_url + '/thumbnail', {
        transformRequest: [function (data, headers) {
          return serialize(data)
        }]
      })
        .then(({ data }) => {
          this.form.thumbnail = data.thumbnail

          this.snackbar.open(data.message)
        })
    },

    async deleteThumbnail () {
      this.form2.file = null

      this.form2.submit('delete', '/api/project/' + this.project.project_url + '/thumbnail')
        .then(({ data }) => {
          this.form.thumbnail = data.thumbnail

          this.snackbar.open(data.message)
        })
    },

    showAddSkill () {
      this.$refs.addSkillModal.openModal()
      this.skillLength = this.form.skills.length
    },

    showAddRequirement () {
      this.$refs.addRequirementModal.openModal()
    },

    addSkill () {
      let oldSkills = this.form.skills.map(skill => skill.name)
      oldSkills.push(...this.anotherSkills.split(',').map(skill => skill.trim()).filter(skill => skill !== ''))

      let skillSet = new Set(oldSkills)

      if (skillSet.size > 20) {
        this.snackbar.open('Can\'t add more than 20 skills')
        return
      }

      let anotherSkills = [...skillSet].map(skill => {
        return { name: skill }
      })

      this.form.skills = anotherSkills
      this.$refs.addSkillModal.closeModal()
      this.anotherSkills = ''
    },

    async addRequirement () {
      let requirementSet = new Set(this.anotherRequirements.split('.'))

      let anotherRequirements = [...requirementSet].map(requirement => {
        return { requirement: requirement }
      }).filter(e => e.requirement !== '')

      this.form.requirements.push(...anotherRequirements)
      this.$refs.addRequirementModal.closeModal()
      this.anotherRequirements = ''
    },

    async saveProject (status) {
      this.form.status = status

      this.form.submit('post', '/api/project/' + this.project.project_url + '/save')
        .then(({ data }) => {
          this.snackbar.open(data.message)
          this.$router.push({ name: 'projectbox' })
        }).catch(e => {
          this.snackbar.open(e.response.data.message)
        })
    },

    deleteSkill (e) {
      let abc = this.form.skills.filter(a => a.name !== e)
      this.form.skills = abc
    },

    deleteRequirement (index) {
      this.form.requirements.splice(index, 1)
    }
  }
}
</script>
