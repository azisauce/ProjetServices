<template>
  <footer class="footer">
    <div class="footer__container">
      <div class="footer__description">

        <p v-if="$matchMedia.xl">
          &copy; 2024
        </p>
        <p v-if="$matchMedia.xl">
          With SwiftServe, everyone will be connected online! Our web application serves as the bridge between clients
          and repair service providers, streamlining the process of service requests and interventions for an optimal user
          experience </p>
      </div>

      <div class="footer__right">
        <div class="footer__right--top">
          <div class="footer-nav__section">
            <div class="footer-nav__menu">
              <div class="flex-row space-between w-100">
                <span>Our Team</span>
                <div v-if="!$matchMedia.xl">
                  <span class="iconify footer-nav__icon" data-icon="entypo:chevron-small-down" />
                </div>
              </div>
              <div v-if="$matchMedia.xl" class="footer-nav__menu--items">
                <div>Marwen Rhaiem</div>
                <div>Mohamed Aziz Turki</div>
                <div>Arij Ezzahi</div>
                <div>Baha Ben Slema </div>
                <div>Ghada ElAmri</div>
                <div>Adam Ben Hassan </div>
              </div>
            </div>
            <div class="footer-nav__menu">
              <div class="flex-row space-between w-100">
                <span>Further Information</span>
                <div v-show="!$matchMedia.xl">
                  <span class="iconify footer-nav__icon" data-icon="entypo:chevron-small-down" />
                </div>
              </div>
              <div v-show="$matchMedia.xl" class="footer-nav__menu--items">
                <div>Terms & Conditions</div>
                <div>Privacy Policy</div>
              </div>
            </div>
          </div>
          <div class="footer-icon__section">
            <div>Connect with us</div>
            <div class="footer-icon__container">
              <div>
                <span class="iconify footer-icon__item" data-icon="ant-design:instagram-outlined" />
              </div>
              <div>
                <span class="iconify footer-icon__item" data-icon="ant-design:twitter-outlined" />
              </div>
              <div>
                <span class="iconify footer-icon__item" data-icon="la:linkedin-in" />
              </div>
              <div>
                <span class="iconify footer-icon__item" data-icon="la:facebook-f" />
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </footer>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    wishlists: '',
    searchQuery: ''
  }),

  computed: {
    ...mapGetters({
      // user: 'auth/user',
      // data: 'auth/data'
    })
  },

  mounted() {
    // this.getWishlist()
  },

  methods: {
    // async getWishlist () {
    //   this.wishlists = this.data.wishlists
    // }
  }
}
</script>
