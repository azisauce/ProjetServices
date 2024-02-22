<template>
  <div class="backwards">
    <div class="slide slide-1__background">
      <div>
        <img v-if="$matchMedia.xl" class="slide-1__left-dashed moveInRightDash duration--2"
          src="/images/left-dashed-desktop.svg" alt="">
      </div>
      <div class="slide-1__container">
        <div class="slide-1__first-block ">
          <h2 class="slide-1__heading moveInTop duration--1">
            Enhance <br>
            Your Reach <br>
            by Leveraging<br>
            SwiftServe.
          </h2>
          <div v-if="$matchMedia.xl" class="slide-1__ornament">
            <img class="slide-1__triangle fadeIn duration--2" src="/images/triangle.svg" alt="">
          </div>
          <div v-else class="slide-1__ornament">
            <img class="slide-1__triangle fadeIn duration--2" src="/images/triangle.svg" alt="">
            <img class="slide-1__left-dashed moveInRightDash duration--2" src="/images/left-dashed.svg" alt="">
            <img class="slide-1__right-dashed moveInBottomLeft duration--2" src="/images/right-dashed.svg" alt="">
          </div>
          <p class="slide-1__paragraph moveInTop duration--1_5">
            Dive into the thrilling possibilities that SwiftServe adds to your experience </p>
          <router-link :to="{ name: 'explore' }" class="slide-1__button moveInTop duration--2" tag="button">
            <span>Get Started</span>
            <span class="iconify" data-icon="ion:arrow-forward-outline" />
          </router-link>
        </div>
        <div class="slide-1__image-container moveInTop duration--2">
          <img class="slide-1__dot-1" src="/images/dot-blue.svg" alt="">
          <img v-if="!$matchMedia.xl" class="slide-1__dot-2" src="/images/dot-blue.svg" alt="">


        </div>
      </div>
      <div>
        <img class="slide-1__right-dashed moveInBottomLeft duration--2" src="/images/right-dashed-desktop.svg" alt="">
      </div>
    </div>
    <div class="slide slide-2__container">
      <div v-if="$matchMedia.xl" class="slide-2__left">

      </div>
      <div class="slide-2__right">
        <h2 class="slide-2__heading">
          Discover The <br>
          Available <br>
          Professionals on <br>
          The Platform
        </h2>
        <p class="slide-2__paragraph">
          Staying updated on the active tasks listed on SwiftServe and the successfully completed ones will ignite your
          enthusiasm!
        </p>
        <div class="slide-2__facts">
          <div class="slide-2__fact-item">
            <span class="iconify slide-2__fact--icon" data-icon="bx:bxs-brain" />
            <div class="slide-2__fact--number">
              {{ projectByStatusCount.hiring }}
            </div>
            <div class="slide-2__fact--name">
              Active Tasks
            </div>
          </div>
          <div class="slide-2__fact-item">
            <span class="iconify slide-2__fact--icon" data-icon="entypo:paper-plane" />
            <div class="slide-2__fact--number">
              {{ projectByStatusCount.ongoing }}
            </div>
            <div class="slide-2__fact--name">
              Ongoing Tasks
            </div>
          </div>
          <div class="slide-2__fact-item">
            <span class="iconify slide-2__fact--icon" data-icon="ant-design:check-circle-outlined" />
            <div class="slide-2__fact--number">
              {{ projectByStatusCount.finished }}
            </div>
            <div class="slide-2__fact--name">
              Finished Tasks
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import TopBoardList from '~/components/TopBoardList'

export default {
  name: 'HomePage',

  middleware: ['newcomer'],
  components: { TopBoardList },

  metaInfo() {
    return {
      title: 'Home',
      meta: [
        { name: 'description', content: 'PHive: Freelancer Platform for Students. Expand your career by doing projects.' }
      ]
    }
  },

  data: () => ({
    projectByStatusCount: '',
    topLeaderboards: {},
    debouncedScroll: ''
  }),

  computed: {
    ...mapGetters({
      authenticated: 'auth/check',
      snackbar: 'notification/snackbar'
    })
  },

  mounted() {
    this.appendNavBg()
    this.getHomeData()

    this.$nextTick(function () {
      document.querySelector('.desktop-nav', '.nav-base').style.boxShadow = 'unset'
      let app = document.querySelector('html')
      window.onscroll = () => {
        clearTimeout(this.debouncedScroll)
        this.debouncedScroll = setTimeout(() => {
          if (app.scrollTop > 0) {
            document.querySelector('.desktop-nav', '.nav-base').style.boxShadow = '0 0.2rem 0.4rem 0 rgba(0, 0, 0, 0.1)'
          } else {
            document.querySelector('.desktop-nav', '.nav-base').style.boxShadow = 'unset'
          }
        }, 50)
      }
    })
    // this.addProximity()
  },

  beforeDestroy() {
    this.removeNavBg()

    window.onscroll = null

    document.querySelector('.desktop-nav', '.nav-base').style.boxShadow = '0 0.2rem 0.4rem 0 rgba(0, 0, 0, 0.1)'
  },

  methods: {
    appendNavBg() {
      let sheet = document.createElement('style')
      sheet.setAttribute('id', 'tempNavBg')
      sheet.innerHTML = '.nav-base { background: #F2F4F6 } .desktop-nav { background: #F2F4F6 }'
      document.body.appendChild(sheet)
    },

    removeNavBg() {
      const sheetToBeRemoved = document.getElementById('tempNavBg')
      let sheetParent = sheetToBeRemoved.parentNode
      sheetParent.removeChild(sheetToBeRemoved)
    },

    async getHomeData() {
      await axios.get(`/api/home`)
        .then(({ data }) => {
          this.projectByStatusCount = data.project_count
          this.topLeaderboards = data.top_boards
        })
    }

    // addProximity () {
    //   const app = document.querySelector('html')
    //   const footer = document.querySelector('footer')
    //   app.classList.add('slide-container')
    //   footer.classList.add('slide', 'pt-5')
    // },

    // removeProximity () {
    //   const app = document.querySelector('html')
    //   const footer = document.querySelector('footer')
    //   app.classList.remove('slide-container')
    //   footer.classList.remove('slide', 'pt-5')
    // }
  }
}
</script>

<style lang="scss" scoped>
@import './resources/sass/abstract/_mixins.scss';

.backwards {
  margin: -6rem -3rem -3rem;

  @include respon(xl) {
    margin-top: calc(-1 * var(--desktop-nav-height));
  }
}
</style>

