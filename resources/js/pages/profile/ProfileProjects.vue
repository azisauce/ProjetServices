<template>
  <div>
    Go to infos
  </div>
</template>

<script>
import ProjectCard from '~/components/ProjectCard'
import { mapGetters } from 'vuex'

export default {
  name: 'UserProfileProjectsPage',
  scrollToTop: false,

  components: { ProjectCard },

  metaInfo () { return { title: 'Profile Projects' } },

  computed: {
    ...mapGetters({
      user: 'auth/user',
      data: 'auth/data'
    }),

    projects () {
      if (this.user.role === 'Student') {
        return this.data.projects.map(e => e.project)
      }

      return this.data.projects
    }
  }
}
</script>
