<template>
  <div class="footer-section">
      <div class="container">
        <div class="footer-content">
          <div class="row">

            <!-- CTA section ipad時出現 -->
            <div class="cta-section col-12 col-md-8">
              <h4 class="mb-16">{{$t('home.newsNfTotal')}}</h4>
              <div class="cta-email-subscribe">
                <div class="cta-email-submit-content">
                  <input type="email" placeholder="請輸入您的 Email">
                  <button>{{$t('home.delivery')}}</button>
                </div>
              </div>
            </div>
            <!-- links section ipad時出現 -->
            <div class="community-link-section col-12 col-md-4">
              <h4>{{$t('home.community')}}</h4>
              <nav>
                <ul class="community-link-wrap">
                  <!-- twitter -->
                  <li class="community-link">
                    <a href="#">
                      <div class="community-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"/></svg>
                      </div>
                    </a>
                  </li>
                  <!-- discord -->
                  <li class="community-link">
                    <a href="#">
                      <div class="community-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path d="M14.82 4.26a10.14 10.14 0 0 0-.53 1.1 14.66 14.66 0 0 0-4.58 0 10.14 10.14 0 0 0-.53-1.1 16 16 0 0 0-4.13 1.3 17.33 17.33 0 0 0-3 11.59 16.6 16.6 0 0 0 5.07 2.59A12.89 12.89 0 0 0 8.23 18a9.65 9.65 0 0 1-1.71-.83 3.39 3.39 0 0 0 .42-.33 11.66 11.66 0 0 0 10.12 0q.21.18.42.33a10.84 10.84 0 0 1-1.71.84 12.41 12.41 0 0 0 1.08 1.78 16.44 16.44 0 0 0 5.06-2.59 17.22 17.22 0 0 0-3-11.59 16.09 16.09 0 0 0-4.09-1.35zM8.68 14.81a1.94 1.94 0 0 1-1.8-2 1.93 1.93 0 0 1 1.8-2 1.93 1.93 0 0 1 1.8 2 1.93 1.93 0 0 1-1.8 2zm6.64 0a1.94 1.94 0 0 1-1.8-2 1.93 1.93 0 0 1 1.8-2 1.92 1.92 0 0 1 1.8 2 1.92 1.92 0 0 1-1.8 2z"/>
                        </svg>
                      </div>
                    </a>
                  </li>
                  <!-- instagram -->
                  <li class="community-link">
                    <a href="#">
                      <div class="community-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                          <path d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z"/>
                          <circle cx="11.994" cy="11.979" r="3.003"/></svg>
                      </div>
                    </a>
                  </li>
                  <!-- youtube -->
                  <li class="community-link">
                    <a href="#">
                      <div class="community-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                          <path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"/></svg>
                      </div>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>


            <!-- footer logo和介紹文字 -->
            <div class="col-12 col-xl-5">
              <div class="row">
                <div class="col-12 col-xl-10">
                  <h2 class="mb-12">
                    <a href="#" class="footer-logo">
                      <svg width="113" height="19" viewBox="0 0 113 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.856 1.2V11.208L6.224 1.2H0.2V18H5.888V8.016L13.52 18H19.544V1.2H13.856ZM39.014 5.088V1.2H22.43V18H28.142V11.784H38.342V7.896H28.142V5.088H39.014ZM59.3536 1.2H40.9456V5.088H47.3056V18H52.9936V5.088H59.3536V1.2ZM67.4913 4.872C63.5313 4.872 59.1153 6.672 59.1153 11.616C59.1153 16.56 63.5313 18.36 67.4913 18.36C71.4273 18.36 75.8433 16.56 75.8433 11.616C75.8433 6.672 71.4273 4.872 67.4913 4.872ZM67.4913 14.952C65.0433 14.952 64.1313 13.344 64.1313 11.616C64.1313 9.888 65.0433 8.28 67.4913 8.28C69.9153 8.28 70.8273 9.888 70.8273 11.616C70.8273 13.344 69.9153 14.952 67.4913 14.952ZM88.1739 8.16V5.208H84.4299V1.896H79.1979V5.208H76.8219V8.16H79.1979V12.888C79.1979 16.704 80.3499 18.216 85.1739 18.216C86.1579 18.216 87.2859 18.144 88.1739 18.024V14.472C85.6059 14.688 84.4299 14.688 84.4299 12.888V8.16H88.1739ZM97.43 4.872C93.278 4.872 90.71 5.976 90.254 9.096H95.03C95.198 8.304 95.582 7.824 97.43 7.824C99.662 7.824 99.878 8.592 99.878 9.816V9.984C91.166 9.504 89.63 11.664 89.63 14.544C89.63 17.064 91.67 18.36 95.294 18.36C97.478 18.36 99.11 17.472 99.878 16.632V18H105.11V9.816C105.11 5.52 101.558 4.872 97.43 4.872ZM99.878 14.352C99.182 15.168 97.958 15.72 96.614 15.72C95.438 15.72 94.718 15.384 94.718 14.424C94.718 12.888 96.686 12.744 99.878 12.888V14.352ZM107.512 0.287999V18H112.744V0.287999H107.512Z" fill="white"/>
                      </svg>
                    </a>
                  </h2>
                  <p>
                    NFTotal{{$t('home.description')}}
                  </p>
                </div>
              </div>
            </div>            
            <!-- footer 導覽列表 -->
            <div class="col-12 col-xl-7">
              <div class="footer-nav-list">
                <!-- sitemap -->
                <div class="footer-nav-item">
                  <h4>Sitemap</h4>
                  <nav>
                    <a href="#">{{$t('home.search')}}</a>
                    <a href="#">{{$t('home.mint')}}</a>
                    <a href="#">{{$t('home.overview')}}</a>
                    <a href="#">{{$t('home.tool')}}</a>
                    <a href="#">{{$t('home.news')}}</a>
                    <a href="#">{{$t('home.blog')}}</a>
                  </nav>
                </div>
                <!-- Links -->
                <div class="footer-nav-item">
                  <h4>Links</h4>
                  <nav>
                    <a href="https://opensea.io/zh-TW">Opensea</a>
                    <a href="https://rarible.com/">Rarible</a>
                    <a href="https://superrare.com/">Super Rare</a>
                    <a href="https://icy.tools/">icy.tools</a>
                    <a href="https://nftgo.io/">NFTGO</a>
                    <a href="https://etherscan.io/">Etherscan</a>
                  </nav>
                </div>
                <!-- Support -->
                <div class="footer-nav-item">
                  <h4>Support</h4>
                  <nav>
                    <a href="#">Company</a>
                    <a href="#">語系切換</a>
                  </nav>
                </div>
                <!-- 加入社區 -->
                <div class="footer-nav-item community-link">
                  <h4>{{$t('home.community')}}</h4>
                  <nav>
                    <ul class="community-link-wrap">
                      <!-- twitter -->
                      <li class="community-link">
                        <a href="https://twitter.com/nftotal_atlser?s=21&t=SOxK-6ZvWIGHV6QmgZ5ANQ">
                          <div class="community-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"/></svg>
                          </div>
                        </a>
                      </li>
                      <!-- discord -->
                      <li class="community-link">
                        <a href="https://discord.gg/atlser">
                          <div class="community-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14.82 4.26a10.14 10.14 0 0 0-.53 1.1 14.66 14.66 0 0 0-4.58 0 10.14 10.14 0 0 0-.53-1.1 16 16 0 0 0-4.13 1.3 17.33 17.33 0 0 0-3 11.59 16.6 16.6 0 0 0 5.07 2.59A12.89 12.89 0 0 0 8.23 18a9.65 9.65 0 0 1-1.71-.83 3.39 3.39 0 0 0 .42-.33 11.66 11.66 0 0 0 10.12 0q.21.18.42.33a10.84 10.84 0 0 1-1.71.84 12.41 12.41 0 0 0 1.08 1.78 16.44 16.44 0 0 0 5.06-2.59 17.22 17.22 0 0 0-3-11.59 16.09 16.09 0 0 0-4.09-1.35zM8.68 14.81a1.94 1.94 0 0 1-1.8-2 1.93 1.93 0 0 1 1.8-2 1.93 1.93 0 0 1 1.8 2 1.93 1.93 0 0 1-1.8 2zm6.64 0a1.94 1.94 0 0 1-1.8-2 1.93 1.93 0 0 1 1.8-2 1.92 1.92 0 0 1 1.8 2 1.92 1.92 0 0 1-1.8 2z"/></svg>
                          </div>
                        </a>
                      </li>
                      <!-- instagram -->
                      <li class="community-link">
                        <a href="https://instagram.com/nftotal.atlser?igshid=NzNkNDdiOGI=">
                          <div class="community-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z"/><circle cx="11.994" cy="11.979" r="3.003"/></svg>
                          </div>
                        </a>
                      </li>
                      <!-- youtube (尚未建立連結) -->
                      <li class="community-link">
                        <a href="#">
                          <div class="community-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"/></svg>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </nav>
                  <h4 class="mb-16">{{$t('home.newsNfTotal')}}</h4>
                  <div class="cta-email-subscribe">
                    <div class="cta-email-submit-content">
                      <input type="email" placeholder="請輸入您的 Email">
                      <button>{{$t('home.delivery')}}</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- footer copyright -->
      <div class="footer-copyright-section">
        <div class="container">
          <div class="footer-copyright-content">
            <div class="row">
              <div class="col-12 col-md-6">
                <!-- footer copyright -->
                <p class="footer-copyright">&copy; NFTotal, Inc. All rights reserved.</p>
              </div>
              <div class="col-12 col-md-6">
                <!-- privacy link -->
                <div class="privacy-link-wrap">
                  <div class="a">Terms</div>
                  <div class="a">Privacy Policy</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
</template>

<script lang='ts' setup>
import { ref } from 'vue'
const input = ref('')
</script>
<style scoped lang="less">
// @import "./footer.less";
</style>
